<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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
Route::get('/home/{id}/authors', 'AuthorController@index')->name('authors');
Route::middleware([AdminAuth::class])->group(function () {  //Only admins can pass here
    Route::get('/home/{id}/categories', 'CategoryController@index')->name('categories');//We see the categ and add them in the same file
    Route::get('/home/{id}/countries', 'CountryController@index')->name('countries');
});

/*
    Url for getting the images
 */
Route::get('image/user/{img}', function($image_name){
    $image = Storage::disk('images')->get($image_name);
    return new Response($image, 200);
})->name('get_avatar');

Route::get('image/post/{img}', function($image_name){
    $image = Storage::disk('images')->get($image_name);
    return new Response($image, 200);
})->name('get_post_img');

/*Routes wich go to the form for add content in new post
*/
Route::get('forms/{id}/posts/new-post', 'PostController@forms_add')->name('post_form_create');

/*Routes for administration
    Routes for adding new content of the forms in the database
*/
Route::post('/home/{id}/posts/added-post', 'PostController@add')->name('post_add');
Route::middleware([AdminAuth::class])->group(function () {
    Route::post('/home/{id}/categories/add', 'CategoryController@add')->name('categories_add');//We see the categs and add them in the same file
});

/*Routes for administration
    Routes for deleting content
*/
Route::get('users/posts/delete/{post_id}', 'PostController@delete')->name('post_delete');
Route::get('users/authors/delete/{auth_id}', 'AuthorController@delete')->name('author_delete');
Route::middleware([AdminAuth::class])->group(function () {
    Route::get('users/categories/delete/{cat_id}', 'CategoryController@delete')->name('category_delete');
});

/*Routes to the forms for editing content
*/
Route::get('users/posts/edit_post/{post_id}', 'PostController@form_edit')->name('post_edit');
Route::get('users/authors/edit_author/{author_id}', 'AuthorController@author_edit')->name('author_edit');
Route::middleware([AdminAuth::class])->group(function () {
    Route::get('users/category/edit_category/{cat_id}', 'CategoryController@cat_edit')->name('cat_edit');
});

/*Routes to the forms for updating content
*/
Route::put('users/posts/save_edit/{post_id}', 'PostController@update')->name('post_update');
Route::put('users/authors/save_edit/{auth_id}', 'AuthorController@update')->name('author_update');
Route::middleware([AdminAuth::class])->group(function () {
    Route::put('users/categories/save_edit/{cat_id}', 'CategoryController@update')->name('cat_update');
});

/*
    Routes for making research
*/
Route::get('users/search/post/', 'PostController@search')->name('search_post');
Route::get('users/search/author/', 'AuthorController@search')->name('search_author');
Route::middleware([AdminAuth::class])->group(function () {
    Route::get('users/search/category/', 'CategoryController@search')->name('search_category');
});

/* --------------------------------------------------------------------------------------- */

/*Routes for normal pages for readers
 */
Route::get('/blog', function () {
    $posts = Post::orderBy('id', 'desc')
            ->paginate(4);

    $categories = Category::orderBy('id', 'desc')
            ->get();
    return view('blog', [
        'posts' => $posts,
        'categories' => $categories,
    ]);
})->name('blog')->withoutMiddleware([Authenticate::class]);

Route::get('/blog/category/{category}/{cat_id}', function ($category, $cat_id) {
    $posts = Post::where('category_id', '=', $cat_id)
            ->orderBy('id', 'desc')
            ->paginate(2);

    $posts_found = Post::where('category_id', '=', $cat_id)->get();
    $categories = Category::orderBy('id', 'desc')
            ->get();
    return view('blog_parts/post_cats', [
        'posts' => $posts,
        'posts_found' => $posts_found,
        'categories' => $categories,
        'id' => $cat_id,
        'name' => $category,
    ]);
})->name('blog_category')->withoutMiddleware([Authenticate::class]);

Route::get('/blog/research/{research?}', function (Request $research) {
    $posts = Post::where('id', 'like', '%'.$research->input('research').'%')
        ->orWhere('title', 'like', '%'.$research->input('research').'%')
        ->orWhere('status', 'like', '%'.$research->input('research').'%')
        /*->orWhere(function($query){
            $query->whereColumn('user_id', 'like', '%'.$research->input('research').'%');
        })
        ->orWhere(function($query){
            $query->whereColumn('category_id', 'like', '%'.$research->input('research').'%');
        })*/
        ->orWhere('created_at', 'like', '%'.$research->input('research').'%')
        ->orWhere('updated_at', 'like', '%'.$research->input('research').'%')
        ->paginate(1);

    $posts_found = Post::where('id', 'like', '%'.$research->input('research').'%')
        ->orWhere('title', 'like', '%'.$research->input('research').'%')
        ->orWhere('status', 'like', '%'.$research->input('research').'%')
        /*->orWhere(function($query){
            $query->whereColumn('user_id', 'like', '%'.$research->input('research').'%');
        })
        ->orWhere(function($query){
            $query->whereColumn('category_id', 'like', '%'.$research->input('research').'%');
        })*/
        ->orWhere('created_at', 'like', '%'.$research->input('research').'%')
        ->orWhere('updated_at', 'like', '%'.$research->input('research').'%')
        ->get();

    $categories = Category::orderBy('id', 'desc')
        ->get();

    return view('blog_parts/post_search', [
        'posts' => $posts,
        'posts_found' => $posts_found,
        'categories' => $categories,
        'req' => $research->input('research'),
    ]);
})->name('blog_search')->withoutMiddleware([Authenticate::class]);

Route::get('/blog/category/{category}/{cat_id}/{post_name}/{post_id}', function ($category, $cat_id, $post_name, $post_id) {
    $post = Post::find($post_id);
    $other_posts = Post::orderBy('id', 'desc')
            ->limit(6)
            ->get();
    return view('post', [
        'post' => $post,
        'other_posts' => $other_posts,
    ]);
})->name('post')->withoutMiddleware([Authenticate::class]);


Route::get('/world_map', function () {
    return view('world-map');
})->name('world_map');

Route::get('/covid_19', function () {
    return view('covid');
})->name('covid_map');