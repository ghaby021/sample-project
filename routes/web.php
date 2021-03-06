<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\User;

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

Route::get('/home', function () {
    echo "this is homepage";
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');


Route::get('/contact',[ContactController::class, 'index']); 
//Cateogry Controller
Route::get('/category/all',[CategoryController::class, 'AllCat'])->name('all.category'); 
Route::post('/category/add',[CategoryController::class, 'AddCat'])->name('store.category'); 
Route::get('/category/edit/{id}',[CategoryController::class, 'Edit']); 
Route::post('/category/update/{id}',[CategoryController::class, 'UpdateCat']); 
Route::get('/softdelete/category/{id}',[CategoryController::class, 'SoftDelete']); 
Route::get('/category/restore/{id}',[CategoryController::class, 'Restore']); 
Route::get('pdelete/category/{id}',[CategoryController::class, 'Pdelete']); 




//Brand Controller
Route::get('/brand/all',[BrandController::class, 'AllBrand'])->name('all.brand'); 
Route::post('/brand/add',[BrandController::class, 'StoreBrand'])->name('store.brand');  
Route::get('/brand/edit/{id}',[BrandController::class, 'Edit']); 
Route::post('/brand/update/{id}',[BrandController::class, 'Update']); 
Route::get('/brand/delete/{id}',[BrandController::class, 'Delete']); 


//Multi Image Route
Route::get('/multi/image',[BrandController::class, 'Multipic'])->name('multi.image'); 
Route::post('/multi/add',[BrandController::class, 'StoreImg'])->name('store.image'); 


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all(); 
    return view('dashboard', compact('users'));
})->name('dashboard');
 