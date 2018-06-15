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


use App\Order;
use Carbon\Carbon;

foreach (\App\Blog::all() as $blog) {
    Route::get($blog->url, 'BlogController@show_page');
}

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        Auth::logout();

        return redirect('/');
    });
    Route::get('/profile/info', 'ProfileController@info');
    Route::post('/profile/save_info', 'ProfileController@save_info');
    Route::get('/profile/password', 'ProfileController@change_password');
    Route::post('/profile/save_password', 'ProfileController@save_password');
    Route::get('/profile/wishlist', 'SearchController@wish_list');
    Route::get('/products/{product}/add_to_wishlist', 'ProductController@add_to_wishlist');
    Route::get('/products/{product}/remove_from_wishlist', 'ProductController@remove_from_wishlist');

    Route::get('/orders/{id}/dispose', 'OrderController@dispose');
    Route::get('/orders', 'OrderController@all');
    Route::get('/orders/{id}', 'OrderController@show');
    Route::post('/products/{product}/save_review', 'ProductController@save_comment');

});

Route::redirect('/home', '/')->name('home');


Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{product}/{number}', 'CartController@add_to_cart');
Route::get('/cart/remove/{product}', 'CartController@remove_from_cart');
Route::get('/cart/update', 'CartController@update_cart');
Route::get('/checkout', 'CartController@checkout');
Route::post('/save_checkout', 'CartController@save_checkout');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/manage/orders', 'OrderController@manage');

    Route::get('/manage', 'AdminController@dashboard');

    Route::resource('/products', 'ProductController')->except(['show']);
    Route::get('/products/{id}/delete', 'ProductController@destroy');
    Route::get('/manage/products', 'ProductController@manage')->middleware('admin');
    Route::get('/manage/categories', 'CategoryController@manage');
    Route::get('/manage/discounts', 'DiscountController@manage');
    Route::get('/manage/ads', 'AdsController@manage');
    Route::get('/manage/blogs', 'BlogController@manage');

    Route::resource('/categories', "CategoryController")->except(['show']);
    Route::get('/categories/{id}/delete', "CategoryController@delete");

    Route::resource('/discounts', "DiscountController")->except(['show']);
    Route::get('/discounts/{id}/delete', "DiscountController@delete");

    Route::resource('/ads', "AdsController")->except(['show']);
    Route::get('/ads/{id}/delete', "AdsController@delete");

    Route::resource('/blogs', "BlogController")->except(['show', 'index']);
    Route::get('/blogs/{id}/delete', "BlogController@delete");

    Route::get('/manage/users', 'UserController@index');
    Route::get('/manage/users/{id}/delete', 'UserController@delete');
    Route::get('/manage/users/{id}/make_admin', 'UserController@make_admin');
    Route::get('/manage/users/{id}/unmake_admin', 'UserController@unmake_admin');

    Route::get('/orders/{id}/confirm', 'OrderController@confirm');
    Route::get('/orders/{id}/ship', 'OrderController@ship');
    Route::get('/orders/{id}/done', 'OrderController@done');

    Route::get('/manage/settings', 'SettingController@index');
    Route::post('/manage/settings', 'SettingController@save');
});
Route::resource('/products', 'ProductController')->only(['show']);

Route::resource('/categories', "CategoryController")->only(['show']);
Route::resource('/blogs', "BlogController")->only(['show', 'index']);
Route::get('/apply_discount', 'CartController@apply_discount');

Route::get('/sale_off', 'SearchController@sale_off');
Route::get('/search', 'SearchController@search');
Route::get('/all', 'SearchController@all');
Route::get('/category/{category}', 'SearchController@category');

Route::get('confirmation/resend', 'Auth\RegisterController@resend');
Route::get('confirmation/{id}/{token}', 'Auth\RegisterController@confirm');


Route::get('/', 'HomeController@index');
Route::get('/statistics', 'StatisticsController@index');

Route::get('/reset_admin', function () {
    $admin = \App\User::whereEmail('admin@gmail.com')->get()[0];
    $admin->is_admin = 1;
    $admin->save();
    return 'Set';
});


