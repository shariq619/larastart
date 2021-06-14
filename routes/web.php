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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace("Admin")->prefix('admin')->group(function () {


    Route::get('/', 'HomeController@index')->name('admin.home');

    Route::resource('permissions','PermissionController');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'AdminLoginController@login');
        Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');
    });
});

/*
function wc_shop_demo_button() {
    $product = get_product(get_the_ID());
    $category_id = $product->category_ids;
    $category_link = get_category_link( $category_id[0] );
    echo '<a class="button demo_button" style="padding-right: 0.75em;padding-left: 0.75em;margin-left: 8px; background-color: #0ebc30;" href="'.$category_link.'" target="_blank">View Demo</a>';
}
//add_action( 'woocommerce_after_shop_loop_item', 'wc_shop_demo_button', 20 );
add_action( 'woocommerce_after_add_to_cart_button', 'wc_shop_demo_button', 20 );*/
