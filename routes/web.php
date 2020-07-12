<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.layouts.app');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





Route::get('/', 'HomeController@index')->name('home')->middleware(['auth']);



Route::resource('roles', 'Admin\RoleController')->middleware(['auth']);
Route::resource('permissions', 'Admin\PermissionController')->middleware(['auth']);




Route::get('profile', 'Admin\UserController@displayProfile')->name('profile.display')->middleware(['auth']);
Route::post('upload', 'Admin\UserController@uploadProfile')->name('profile.upload')->middleware(['auth']);
Route::post('update-password', 'Admin\UserController@updatePassword')->name('update.password')->middleware(['auth']);
Route::delete('delete-profile-image', 'Admin\UserController@deleteProfileImage')->name('delete.profile.image')->middleware(['auth']);
Route::patch('changeuserstatus/{id}', 'Admin\UserController@changeUserStatus')->name('user.status')->middleware(['auth']);

Route::get('user/{id}/plan', 'Admin\UserController@upgradePlan')->name('plan.upgrade')->middleware(['auth']);
Route::get('user/{id}/plan/{pid}', 'Admin\UserController@activePlan')->name('plan.active')->middleware(['auth']);

Route::get('get-province-residence', 'Admin\UserController@getProvinceOfResidence')->name('get.province.of.residence')->middleware(['auth']);
Route::get('get-district-residence', 'Admin\UserController@getDistrictOfResidence')->name('get.district.of.residence')->middleware(['auth']);

Route::get('/file-upload','Admin\UserController@uploadTXTFileView')->name('users.file.upload')->middleware(['auth']);
Route::post('/uploadtxtfile','Admin\UserController@uploadTXTFile')->name('upload.txt.file')->middleware(['auth']);

Route::resource('users', 'Admin\UserController')->middleware(['auth']);


Route::resource('calendars', 'Admin\CalendarController')->middleware(['auth']);


Route::patch('change-news-status/{id}', 'Admin\NewsController@changeNewsStatus')->name('update.news.status')->middleware(['auth']);
Route::resource('news', 'Admin\NewsController')->middleware(['auth']);

// Route::group(
//     [
//         'middleware' => [
//             'auth',
//             'xss',
//         ],
//     ], function () {

//     Route::get('change-language/{lang}', 'LanguageController@changeLanguage')->name('change.language');
//     Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
//     Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
//     Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
//     Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');
// }
// );





// Route::group(
//     [
//         'middleware' => [
//             'auth',
//             'xss',
//         ],
//     ], function () {

//     Route::resource('systems', 'SystemController');
//     Route::post('system-settings', 'SystemController@saveSystemSettings')->name('system.settings');
//     Route::post('general-settings', 'SystemController@saveGeneralSettings')->name('general.settings');
//     Route::post('template-settings', 'SystemController@saveTemplateSettings')->name('template.settings');
// }
// );




Route::get('archivos', 'Admin\FilesController@index')->name('admin.files.index');


Route::get('/clear-cache', function () {
    \Artisan::call('cache:clear');
    return redirect()->back()->with('success', 'Cache is cleared');
});
