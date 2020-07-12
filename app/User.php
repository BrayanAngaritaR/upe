<?php

namespace App;

use App\Models\File;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'type',
        'email',
        'password',
        'avatar',
        'user_role',
        'dni',
        'last_name',
        'mother_last_name',
        'residence_address',
        'residence_reference',
        'residence_department',
        'province_of_residence',
        'district_of_residence',
        'command_team',
        'institutional_mail',
        'birthdate',
        'blood_type',
        'sex',
        'marital_status',
        'pension_scheme',
        'cuss_number',
        'personal_mail',
        'mobile_number',
        'phone_number',
        'passport_number',
        'brief_number',
        'brief_type',
        'expire_brief_date',
        'higher_income_earner',
        'type_of_disability',
        'conadis_registration',
        'parent_id',
        'lang',
        'plan_expire_date',
        'plan_id',
        'is_active',
        'user_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function currentLanguage()
    {
        return $this->lang;
    }

    /*public function filteredInstitutionalMail()
    {
        $email = $this->institutional_mail;

        return substr($email, 0, strpos($email, "@"));
    }*/

    public function getAllergiesDiseases()
    {
        $result = DB::table('users_allergies_diseases')->where('user_id', $this->id)->get()->toJson();
        return $result;
    }

    public function getEmergencyNumbers()
    {
        $result = DB::table('users_emergency_numbrers')->where('user_id', $this->id)->get()->toJson();
        return $result;
    }
    public function getFamilyData()
    {
        $result = DB::table('users_family_data')->where('user_id', $this->id)->get()->toJson();
        return $result;
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    // public function priceFormat($price)
    // {
    //     $settings = Utility::settings();

    //     return (($settings['site_currency_symbol_position'] == "pre") ? $settings['site_currency_symbol'] : '') . number_format($price, 2) . (($settings['site_currency_symbol_position'] == "post") ? $settings['site_currency_symbol'] : '');
    // }

    // public function currencySymbol()
    // {
    //     $settings = Utility::settings();

    //     return $settings['site_currency_symbol'];
    // }

    // public function dateFormat($date)
    // {
    //     $settings = Utility::settings();

    //     return date($settings['site_date_format'], strtotime($date));
    // }

    // public function timeFormat($time)
    // {
    //     $settings = Utility::settings();

    //     return date($settings['site_time_format'], strtotime($time));
    // }

    // public function datetimeFormat($datetime)
    // {
    //     $settings = Utility::settings();

    //     return date($settings['site_date_format'], strtotime($datetime)) . ' ' . date($settings['site_time_format'], strtotime($datetime));
    // }

    public function getCreatedBy()
    {
        return ($this->parent_id == '0' || $this->parent_id == '1') ? $this->id : $this->parent_id;
    }

    public function isSuperAdmin()
    {
        return $this->parent_id === 0;
    }

    public function isCompany()
    {
        return $this->parent_id === 1;
    }

    public function isUser()
    {
        return $this->parent_id !== 0 && $this->parent_id !== 1;
    }
}
