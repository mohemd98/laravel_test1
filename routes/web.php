<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/dashboard', function () {

    return 'Not adualt';
}) -> name('not.adult');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'App\Http\Controllers\SocialController@redirect');

Route::get('/callback/{service}', 'App\Http\Controllers\SocialController@callback');

Route::get('/test git hub', 'App\Http\Controllers\SocialController@callback');

Route::get('/fillable', 'App\Http\Controllers\CrudController@getoffer');

//Route::group(['prefix'=>'offers'] , function (){
////    Route::get('store' , 'App\Http\Controllers\CrudController@store');
//    Route::get('create' , 'App\Http\Controllers\CrudController@create');
//    Route::post('store' , 'App\Http\Controllers\CrudController@store')->name('off.store');
//});

Route::group(['prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'App\Http\Controllers\CrudController@create');
        Route::post('store', 'App\Http\Controllers\CrudController@store')->name('off.store');

        Route::get('edit/{offer_id}', 'App\Http\Controllers\CrudController@editOffer');
        Route::post('update/{offer_id}', 'App\Http\Controllers\CrudController@UpdateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'App\Http\Controllers\CrudController@delete')->name('offers.delete');
        Route::get('all', 'App\Http\Controllers\CrudController@getAllOffers')->name('offers.all');

    });

    Route::get('youtube', 'App\Http\Controllers\CrudController@getVideo');


});


###################### Begin Ajax routes #####################
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'App\Http\Controllers\OfferController@create');
    Route::post('store', 'App\Http\Controllers\OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'App\Http\Controllers\OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'App\Http\Controllers\OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'App\Http\Controllers\OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'App\Http\Controllers\OfferController@Update')->name('ajax.offers.update');
});
###################### End Ajax routes #####################

##################### Begin Authentication && Guards ##############



Route::group(['middleware' => 'CheckAge', 'namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('adults', 'CustomAuthController@adualt')->name('adult')->middleware('auth');
});
//middleware('auth')
Route::get('site', 'App\Http\Controllers\Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin', 'App\Http\Controllers\Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('admin/login', 'App\Http\Controllers\Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login', 'App\Http\Controllers\Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');


##################### End Authentication && Guards ##############
