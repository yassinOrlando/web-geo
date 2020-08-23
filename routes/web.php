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

/*Routes for administration
    Root dashboard routes
*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}/posts', 'PostController@index')->name('posts');
Route::get('/home/{id}/categories', 'CategoryController@index')->name('categories');//We see the categ and add them in the same file
Route::get('/home/{id}/authors', 'AuthorController@index')->name('authors');
Route::get('/home/{id}/countries', 'CountryController@index')->name('countries');

/*Routes wich go to the form for add content
*/
Route::get('forms/{id}/posts/new-post', 'PostController@forms_add')->name('post_form_create');

/*Routes for administration
    Routes for adding content
*/
Route::post('/home/{id}/posts/added-post', 'PostController@add')->name('post_add');
Route::post('/home/{id}/categories', 'CategoryController@add')->name('categories_add');//We see the categ and add them in the same file