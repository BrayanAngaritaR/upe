<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCreate;
use App\Models\File;
use App\User;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('users.*', DB::raw("COUNT(cu.parent_id) users"))->leftjoin('users as cu', 'cu.parent_id', '=', 'users.id')->where('users.parent_id', '=', Auth::user()->getCreatedBy())->groupBy('users.id')->orderBy('users.id', 'DESC')->get();

        return view('admin.users.index')->with('users', $users);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $authuser = Auth::user();

        $validatorArray = [
            'name' => 'required|max:120',
            'institutional_mail' => 'required|email|max:100|unique:users,institutional_mail,NULL,id,parent_id,' . $authuser->getCreatedBy(),
        ];

        $validator = Validator::make(
            $request->all(), $validatorArray
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        /*if(User::where('institutional_mail', $request->institutional_mail)->where('parent_id', Auth::user()->getCreatedBy())->exists())
        {
            return redirect()->back()->with('error', __('This email address has already been used.'));
        }*/

        $userpassword                      = Utility::randomPassword();
        $userrequest['name']               = $request->input('name');
        $userrequest['type']               = 'user';
        $userrequest['email']              = $request->institutional_mail;
        $userrequest['institutional_mail'] = $request->institutional_mail;
        $userrequest['password']           = $userpassword;
        $userrequest['parent_id']          = $authuser->getCreatedBy();
        $userrequest['lang']               = 'en';
        $userrequest['is_active']          = 1;
        $userrequest['user_status']        = 1;

        $user = User::create($userrequest);

        try
        {
            $user->type         = 'User';
            $user->userpassword = $userpassword;
            Mail::to($user->institutional_mail)->send(new UserCreate($user));
        }
        catch(\Exception $e)
        {
            $smtp_error = "<br><span class='text-danger'>" . __('E-Mail has been not sent due to SMTP configuration') . '</span>';
        }

        return redirect()->route('users.edit', $user->id)->with('success', __('User added successfully.') . ((isset($smtp_error)) ? $smtp_error : ''));
    }

    public function show(User $user)
    {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    public function edit(User $user)
    {
        $residence_department = ['' => 'Select'] + DB::table('residence_department')->pluck('name', 'id')->toArray();

        $province_residence = ['' => 'Select'] + DB::table('province_of_residence')->where('department_id', $user->residence_department)->pluck('name', 'id')->toArray();
        $district_residence = ['' => 'Select'] + DB::table('district_of_residence')->where('province_id', $user->province_of_residence)->pluck('name', 'id')->toArray();

        return view('admin.users.edit', compact('user', 'residence_department', 'province_residence', 'district_residence'));
    }

    public function update(Request $request, User $user)
    {
        $validatorArray = [
            'institutional_mail' => 'required|email|max:100|unique:users,institutional_mail,' . $user->id . ',id,parent_id,' . Auth::user()->getCreatedBy(),
        ];

        $validator = Validator::make(
            $request->all(), $validatorArray
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        /*$request->institutional_mail = $request->institutional_mail . $request->institutional_mail_domain;

        if(User::where('institutional_mail', $request->institutional_mail)->where('parent_id', '!=', Auth::user()->getCreatedBy())->exists())
        {
            return redirect()->back()->with('error', __('This email address has already been used.'));
        }*/

        $authuser_id = Auth::user()->getCreatedBy();

        $user->name                  = $request->name;
        $user->dni                   = $request->dni;
        $user->last_name             = $request->last_name;
        $user->mother_last_name      = $request->mother_last_name;
        $user->residence_address     = $request->residence_address;
        $user->residence_reference   = $request->residence_reference;
        $user->user_role             = $request->user_role;
        $user->residence_department  = $request->residence_department;
        $user->province_of_residence = $request->province_of_residence;
        $user->district_of_residence = $request->district_of_residence;
        $user->command_team          = $request->command_team;
        $user->institutional_mail    = $request->institutional_mail;
        $user->birthdate             = $request->birthdate;
        $user->blood_type            = $request->blood_type;
        $user->sex                   = $request->sex;
        $user->marital_status        = $request->marital_status;
        $user->pension_scheme        = $request->pension_scheme;
        $user->cuss_number           = $request->cuss_number;
        $user->personal_mail         = $request->personal_mail;
        $user->mobile_number         = $request->mobile_number;
        $user->phone_number          = $request->phone_number;
        $user->passport_number       = $request->passport_number;
        $user->brief_number          = $request->brief_number;
        $user->brief_type            = $request->brief_type;
        $user->expire_brief_date     = $request->expire_brief_date;
        $user->higher_income_earner  = $request->higher_income_earner;
        $user->type_of_disability    = $request->type_of_disability;
        $user->conadis_registration  = $request->conadis_registration;
        $user->save();

        $allergyArray = $emergencyArray = $familyArray = [];

        if(isset($request->allergies) && count($request->allergies) > 0)
        {
            foreach($request->allergies as $allergys)
            {
                $allergyArray[] = [
                    'user_id' => $user->id,
                    'name' => $allergys['name'],
                    'special_attention' => $allergys['special_attention'],
                    'created_by' => $authuser_id,
                ];
            }
        }

        if(isset($request->emergencies) && count($request->emergencies) > 0)
        {
            foreach($request->emergencies as $emergencys)
            {
                $emergencyArray[] = [
                    'user_id' => $user->id,
                    'family_bond' => $emergencys['family_bond'],
                    'surnames_names' => $emergencys['surnames_names'],
                    'phones' => $emergencys['phones'],
                    'created_by' => $authuser_id,
                ];
            }
        }
        if(isset($request->families) && count($request->families) > 0)
        {
            foreach($request->families as $familys)
            {
                $familyArray[] = [
                    'user_id' => $user->id,
                    'family_bond' => $familys['family_bond'],
                    'surnames_names' => $familys['surnames_names'],
                    'age' => $familys['age'],
                    'dni' => $familys['dni'],
                    'email' => $familys['email'],
                    'phone' => $familys['phone'],
                    'social_networks' => $familys['social_networks'],
                    'medical_information' => $familys['medical_information'],
                    'created_by' => $authuser_id,
                ];
            }
        }

        DB::table('users_allergies_diseases')->where('user_id', $user->id)->delete();
        DB::table('users_allergies_diseases')->insert($allergyArray);

        DB::table('users_emergency_numbrers')->where('user_id', $user->id)->delete();
        DB::table('users_emergency_numbrers')->insert($emergencyArray);

        DB::table('users_family_data')->where('user_id', $user->id)->delete();
        DB::table('users_family_data')->insert($familyArray);

        if(Auth::user()->type == 'company')
        {
            return redirect()->route('users.index')->with('success', __('User successfully updated.'));
        }
        else if(Auth::user()->type == 'user')
        {
            return redirect()->route('users.edit', Auth::user()->id)->with('success', __('Profile successfully updated.'));
        }
    }

    public function changeUserStatus($id)
    {
        $user   = User::find($id);
        $status = '';
        if($user)
        {
            User::where('id', $id)->update(['user_status' => (int)!$user->user_status]);
            User::where('parent_id', $id)->update(['user_status' => (int)!$user->user_status]);
            $status = $user->user_status == '0' ? __('activated') : __('deactivated');
        }

        return redirect()->route('users.index')->with('success', __('User') . ' ' . $status . ' ' . __('successfully'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', __('User successfully deleted.'));
    }

    public function displayProfile(Request $request)
    {
        $user = Auth::user();

        return view('admin.users.profile', compact('user'));
    }

    public function uploadProfile(Request $request)
    {
        $user      = Auth::user();
        $validator = Validator::make(
            $request->all(), [
                               'name' => [
                                   'bail',
                                   'required',
                                   'string',
                                   'min:2',
                                   'max:255',
                                   'unique:users,name,' . $user->getCreatedBy() . ',id',
                               ],
                               'email' => 'required|email|unique:users,email,' . $user->getCreatedBy(),
                               'avatar' => 'dimensions: min_width = 100, max_height = 5000',
                           ]
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        if($request->hasFile('avatar'))
        {
            if(asset(Storage::exists($user->avatar)))
            {
                asset(Storage::delete($user->avatar));
            }

            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('avatar')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path            = $request->file('avatar')->storeAs('avatar', $fileNameToStore);
            $user['avatar']  = $path;
        }

        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
        $user->save();

        return redirect()->route('profile.display')->with('success', __('Profile updated successfully.'));
    }

    public function deleteProfileImage(Request $request)
    {
        $user = Auth::user();
        if(asset(Storage::exists($user->avatar)))
        {
            asset(Storage::delete($user->avatar));
        }
        $user->avatar = '';
        $user->save();

        return redirect()->route('profile.display')->with('success', __('Profile deleted successfully.'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|same:password',
                'confirm_password' => 'required|same:password',
            ]
        );
        $objUser          = Auth::user();
        $request_data     = $request->all();
        $current_password = $objUser->password;

        if(Hash::check($request_data['current_password'], $current_password))
        {
            $objUser->password = $request_data['password'];
            $objUser->save();

            return redirect()->route('profile.display')->with('success', __('Password updated successfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Please Enter Correct Current Password!'));
        }
    }

    public function getProvinceOfResidence(Request $request)
    {
        $department_id = $request->department_id;

        $residence_department = DB::table('province_of_residence')->where('department_id', $department_id)->pluck('id', 'name')->toArray();

        echo json_encode($residence_department);
    }

    public function getDistrictOfResidence(Request $request)
    {
        $province_id = $request->province_id;

        $district_residence = DB::table('district_of_residence')->where('province_id', $province_id)->pluck('id', 'name')->toArray();

        echo json_encode($district_residence);
    }

    public function uploadTXTFileView(Request $request) {
        return view('admin.users.file-upload');
    }

    public function uploadTXTFile(Request $request)
    {

        if($request->hasFile('uploadfile')){
            $request->validate([
                'uploadfile' => 'max:10240',
                'user_document' => 'required'
            ]);

            $file = $request->file('uploadfile');
            $filename = Str::slug($file->getClientOriginalName());

            //Obtener el número del documento ingresado
            $dni = $request->user_document;

            //Buscar el usuario con ese DNI ingresado
            $user = User::where('dni', $dni)->first();

            //Verificar si hay un documento que coincida con el ingresado
            if ($user != null) {
                //Guardar el documento en el storage
                $store = $file->storeAs('documents', $filename, 'public');

                //Crea el registro en la base de datos

                $file_in_database = File::create([
                    'filename'  => $filename,
                    'user_id'   => $user->id,
                    'url'       => $store,
                ]);

                //Mostrar el mensaje de que se ha subido la información
                toast('Se ha subido la información', 'success');
                return back();
            } else {
                Alert::error('El DNI es incorrecto. Vuelve a subir el documento');
                return back();
            }

        } else {
            toast('No subiste ningún documento', 'error');
            return back();
        }


      


        // $file = $request->file('uploadfile');
        // $fileName = trim(pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME));
        // $file_path = $file->getPathName();
        // $file_str = file($file_path);

        // $count = count($file_str) / 48;

        // if(!is_int($count)) {
        //     echo 'Not Valid Format';
        //     return;
        // }

        // $html = '';
        // $line_number = 8;

//         for($i = 0; $i < $count; $i++)
//         {
//             $dni = str_replace('Documento de Identidad       : (Lib.Electoral o D.N.) ', '', trim($file_str[$line_number]));
// //            echo $dni.'<br>';
// //            $html .= $file_str[$line_number].'<br>';

//             $start = $line_number - 8;
//             $stop  = $start + 48;
//             for($j = $start; $j < $stop; $j++)
//             {
//                 $html .= $file_str[$j].'<br>';
//             }

//             $line_number += 48;
//         }
//         dd($html);
//             $pdf = \App::make('dompdf.wrapper');
// //            $pdf->AddPage();
// //            $pdf->SetFont('Arial','',12);
//             $pdf->loadHTML($html);
//             $pdf->setOptions(['defaultFont', 'Courier']);
// //            $pdf->Output();
// //            $pdf->save('myfile.pdf');
//             return $pdf->stream();

    }
}
