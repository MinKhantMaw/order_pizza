<?php

use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\UserCheckMiddleware;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::check()) {
        if(Auth::user()-> role == 'admin'){
            return redirect()->route('admin.index');
        }else if (Auth::user()->role == 'user'){} {
           return redirect()->route('user.index');
        }
    }
})->name('dashboard');

Route::prefix('admin')->middleware(AdminCheckMiddleware::class)->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/','AdminController@index')->name('index')->middleware(AdminCheckMiddleware::class);
    Route::post('/admin-update/{id}','AdminController@updateProfile')->name('admin-update');
    Route::get('/change-password/{id}','AdminController@changePassword')->name('change-password');
    Route::post('/change-password/{id}','AdminController@updatePassword')->name('update-password');
    // admin list
    Route::get('admin-create','AdminUserController@createAdmin')->name('admin-create');
    Route::post('admin-add','AdminUserController@addAdmin')->name('admin-add');
    Route::get('admin-list','AdminUserController@adminList')->name('admin-list');
    Route::get('admin-search','AdminUserController@adminSearch')->name('admin-search');
    Route::get('admin-delete/{id}','AdminUserController@adminDelete')->name('admin-delete');
    Route::get('admin-download','AdminUserController@adminDownload')->name('admin-download');
    // user list
    Route::get('/user-list','AdminUserController@userList')->name('user-list');
    Route::post('/user-search','AdminUserController@userSearch')->name('user-search');
    Route::get('/user-delete/{id}','AdminUserController@userDelete')->name('user-delete');
    // category route list
    Route::get('/category-list','CategoryController@categoryList')->name('category-list');
    Route::get('/category-add','CategoryController@addCategory')->name('add-category');
    Route::post('/category-add','CategoryController@createCategory')->name('create-category');
    Route::get('/category-delete/{id}','CategoryController@deleteCategory')->name('delete-category');
    Route::get('/category-edit/{id}','CategoryController@editCategory')->name('category-edit');
    Route::post('/category-update/{id}','CategoryController@updateCategory')->name('update-category');
    Route::post('/category-search','CategoryController@searchCategory')->name('search-category');
    // csv category download
    Route::get('/category-download','CategoryController@downloadCategory')->name('download-category');
    // pizza route list
     Route::get('/pizza-list','PizzaController@pizzaList')->name('pizza-list');
     Route::get('/pizza-create','PizzaController@pizzaCreate')->name('pizza-create');
     Route::post('/pizza-add','PizzaController@pizzaAdd')->name('pizza-add');
     Route::get('pizza-delete/{id}','PizzaController@pizzaDelete')->name('pizza-delete');
     Route::get('pizza-detail/{id}','PizzaController@pizzaDetail')->name('pizza-detail');
     Route::get('pizza-edit/{id}','PizzaController@pizzaEdit')->name('pizza-edit');
     Route::post('pizza-update/{id}','PizzaController@pizzaUpdate')->name('pizza-update');
     Route::post('/pizza-list','PizzaController@pizzaSearch')->name('pizza-search');
     Route::get('category-item/{id}','PizzaController@categoryItem')->name('category.item');
    // pizza csv download
    Route::get('pizza-download','PizzaController@downloadPizza')->name('download-pizza');
    //order controller
    Route::get('/order-list','OrderController@orderList')->name('order-list');
    Route::get('/order-search','OrderController@orderSearch')->name('order-search');

    // contact route
    Route::get('/contact-list','ContactController@contactList')->name('contact-list');
    Route::post('/contact-search','ContactController@contactSearch')->name('contact-search');
    Route::get('/contact-delete/{id}','ContactController@contactDelete')->name('contact-delete');
});
Route::prefix('user')->middleware(UserCheckMiddleware::class)->name('user.')->namespace('User')->group(function () {
    Route::get('/','UserController@index')->name('index');
    Route::get('pizza-detail/{id}','UserController@pizzaDetail')->name('pizza-detail');
    // category search
    Route::get('category-search/{id}','UserController@categorySearch')->name('category-search');
    // contact route
    Route::post('/contact-create','UserContactController@contactCreate')->name('contact-create');
    // search pizza
    Route::get('/pizza-search','UserController@pizzaSearch')->name('pizza-search');
    // search price
    Route::get('/price-search','UserController@priceSearch')->name('price-search');
    // order
    Route::get('/pizza-order/{id}','UserController@pizzaOrder')->name('pizza-order');
    Route::post('/order-create','UserController@orderCreate')->name('order-create');
     Route::post('','UserController@logout')->name('user.logout');
});
