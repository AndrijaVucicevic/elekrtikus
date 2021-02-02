<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\UserController;
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

/*Route::get('/aaa', function () {
    return view('elektrikus');
});*/

Route::get('/',[IndexController::class, 'index'])->name('welcome');

Route::post('/change_trending',[IndexController::class, 'change_trending']);

Route::post('/email_subscribe',[IndexController::class, 'email_subscribe']);

Route::post('/subcategory',[IndexController::class, 'search_subcategory']);



Route::get('/shop',[ShopController::class,'index'])->name('store');
//Route::post('/shop/{category}',[ShopController::class,'index']);

Route::post('/change_price_filter',[ShopController::class,'change_price_filter']);
Route::post('/price_filter_shop',[ShopController::class,'price_filter_shop']);

Route::post('/pagination',[ShopController::class,'pagination']);
Route::post('/new_page',[ShopController::class,'new_page']);
Route::post('/sponsored_category',[ShopController::class,'sponsored']);




Route::get('/registracija',function (){
return view('register');
})->name('register');

Route::post('/register',[RegisterController::class,'register']);

Route::get('/verify',[RegisterController::class,'verifyEmail'])->name('verify');

Route::post('/login',[LoginController::class,'login'])->name('login');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/user',[UserController::class,'index'])->name('user');

Route::post('/more_products',[UserController::class,'more_products'])->name('more_user');

Route::post('/changeUserCategory',[UserController::class,'changeUserCategory'])->name('category_user');

Route::post('/delete_product_user',[UserController::class,'delete_product']);

Route::post('/insert_product_user',[UserController::class,'insert_product']);

//get subcategory and ppk
Route::post('/get_subcategory',[UserController::class,'get_subcategory']);
Route::post('/get_ppk',[UserController::class,'get_ppk']);
//


Route::get('/product/{product_id}',[ProductController::class,'index_product'])->name('product');

Route::get('/blog/{blog_name}',[BlogController::class,'index_blog'])->name('blog');