<?php

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

Route::get('/', function () {
    return view('welcome');
});


// required parameter

Route::get('/show', function () {
    return ('hello welcome');
});

Route::get('show_number/{id}', function ($id) {
    return ($id);
})->name('a');

Route::get('show_string/{id}', function () {
    return ('welcome');
})->name('b');

//Route::namespace('Front')->group(function (){
//  Route::get('users' ,'UserController@showAdaminName');
//});


////////////////////////////////////
//Route::prefix('users')->group(function (){
//    Route::get('show','UserController@showAdaminName');
//    Route::delete('delete','UserController@showAdaminName');
//    Route::get('edit','UserController@showAdaminName');
//    Route::put('update','UserController@showAdaminName');
//});
///////////////////////////////////
//Route::group(['prefix' => 'users','middleware' => 'auth'],function(){
////set of routes
//
//    Route::get('/',function(){
//        return'work';
//    });

//    Route::get('offers/show','UserController@showAdaminName');
//    Route::delete('offers/delete','UserController@showAdaminName');
//    Route::get('offers/edit','UserController@showAdaminName');
//    Route::put('offers/update','UserController@showAdaminName');
//});
//
//Route::get('check',function (){
//   return'middleware';
//})->middleware('auth');
//
//
//////////////////////////////////////
//Route::get('offers/show','UserController@showAdaminName');
//Route::delete('offers/delete','UserController@showAdaminName');
//Route::get('offers/edit','UserController@showAdaminName');
//Route::put('offers/update','UserController@showAdaminName');

////////////////////////////////////

//Route::get('second','Admin\SecondController@show');
//Route::group(['namespace' => 'Admin'],function (){
//   Route::get('second1','SecondController@showString1')->middleware('auth');
//    Route::get('second2','SecondController@showString2');
//    Route::get('second3','SecondController@showString3');
//    Route::get('second4','SecondController@showString4');
//});
//
//Route::get('login',function (){
//    return'you shoud be login';
//})->name('login');

//////////MIDLLEWARE
//Route::get('users','UserController@showAdaminName')->middleware('auth');
//////////////////////////////////
//Route::group(['middleware' => 'auth'],function (){
//  Route::get('users','UserController@showAdaminName');
//});
///////////////////////////////
Route::resource('news', 'NewsController');

//Route::group('news',function(){
//    Route::resource('news','NewsController@index');
//    Route::resource('news','NewsController@create');
//    Route::resource('news','NewsController@store');
//    Route::resource('news','NewsController@show');
//    Route::resource('news','NewsController@edit');
//    Route::resource('news','NewsController@apdate');
//    Route::resource('news','NewsController@destory');
//
//});

//Route::get('/',function (){
//    $date=[];
//    $data['id'] = 5;
//    $data['name']= 'abdalrhman mohmed';
//    $obj = new \stdClass();
//    $obj->id = 6;
//    $obj->name = 'hamada mohemd';
//    $obj->gender = 'male';
//    return view('welcome',$data,compact('obj'));
//});

Route::get('/dashboard', function () {
    return 'not adult';
})->name('not.adult');

Route::get('/', 'Front\UserController@getIndex');

////////////route landing /////////
Route::get('landing', function () {
    return view('landing');
});

Route::get('about', function () {
    return view('about_us');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

Route::get('fillabel', 'CrudController@getOffer');


//Route::get('store','CrudController@store');
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    //  Route::get('store','CrudController@store')
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offers.delete');
        Route::get('all', 'CrudController@getAllOffer');
    });
    Route::get('youtuber', 'CrudController@getVideo')->middleware('auth');
});

/////////////////////////////Begin ajax routes///////////////////////////

Route::group(['prefix' => 'ajax-offer'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offer.store');
    Route::get('all', 'OfferController@all')->name('ajax.offer.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offer.delete');
    Route::get('edit\{offer_id}', 'OfferController@edit')->name('ajax.offer.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offer.update');
});

////////////////////////////End ajax routes/////////////////////////////

//////////////////////////Begin Authentication && Guard ////////////////////////
Route::group(['middleware' => 'CheckAge', 'namespace' => 'auth'], function () {
    Route::get('adult', 'CustomAuthController@adult')->name('adult');
});

Route::get('site', 'auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin', 'auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');


Route::get('admin/login', 'auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login', 'auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');
///////////////////////// End Authentication && Guard ////////////////////////


###################### BENGIN RELATIONS ROUTES ########################

Route::get('has-one', 'Relation\RelationsController@hasOnRelation');
Route::get('has-one-reverse', 'Relation\RelationsController@hasOnRelationReverse');
Route::get('get-user-has-phone', 'Relation\RelationsController@getUserHasPhone');
Route::get('get-user-has-phone-with-condition', 'Relation\RelationsController@getUserWhereHasPhoneWithCondition');
Route::get('get-user-not-has-phone', 'Relation\RelationsController@getUserNotHasPhone');

###################### BEGIN ONE TWO MANY RELATIONS ROUTES ########################

Route::get('hospital-has-many','Relation\RelationsController@getHospitalDoctors');


Route::get('hospitals','Relation\RelationsController@hospitals')-> name('hospital.all');

Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')-> name('hospital.doctors');

Route::get('hospitals/{hospital_id}','Relation\RelationsController@deleteHospital')-> name('hospital.delete');

Route::get('hospital_has_doctors','Relation\RelationsController@hospitalHasDoctor');

Route::get('hospital_has_doctors_male','Relation\RelationsController@hospitalHasOnlyMale');

Route::get('hospital_Not_has_doctors','Relation\RelationsController@hospitalNotHasDoctor');

###################### END ONE TWO MANY RELATIONS ROUTES ########################


###################### END RELATIONS ROUTES ########################

