<?php

use League\Glide\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Flowcms\Flowcms\Controllers\PageController;
use Flowcms\Flowcms\Controllers\Auth\LoginController;
use Flowcms\Flowcms\Controllers\Front\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes For Flowcms
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Glide - Http Image Manipulation
Route::group([
    'middleware' => ['web']
], function () {
    Route::get('/img/{path}', function (Server $server, $path) {
        $server->outputImage($path, $_GET);
    })->where('path', '.+');
    // Custom Login Page
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
});

Route::group(['as' => 'flowcms::', 'namespace' => '\Flowcms\Flowcms\Controllers', 'middleware' => ['web']], function () {
    // Home Page
    Route::get('/', function () {
        // get home page details from config
        $homePage = setting('site_homepage_url');
        if ($homePage === 'blog') return (new ArticleController)->index();
        return (new PageController)->show($homePage);
    })->name('default-page');

    // Blog Page
    Route::group(['middleware' => 'HtmlMinifier'], function () {
        Route::get('/blog', 'Front\ArticleController@index')->name('blog');
        Route::get('/blog/{article}', 'Front\ArticleController@show')->name('blog.show');
        Route::get('/partials/blog', 'Front\ArticleController@articles')->name('blog.partial');
    });

    // Contact us
    Route::post('/contact', 'ContactController@store')->name('contact.store')->middleware(\Spatie\Honeypot\ProtectAgainstSpam::class);

    Route::group(['middleware' => 'auth.flowcms'], function () {
        // Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Article
        Route::get('/articles/all', 'ArticleController@index')->name('articles.index');
        Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
        Route::post('/articles', 'ArticleController@store')->name('articles.store');
        Route::get('/articles/{article:uuid}/edit', 'ArticleController@edit')->name('articles.edit');
        Route::put('/articles/{article:uuid}', 'ArticleController@update')->name('articles.update');
        Route::delete('/articles/{article:uuid}', 'ArticleController@destroy')->name('articles.destroy');

        // Contact
        Route::get('/contacts', 'ContactController@index')->name('contacts');
        Route::delete('/contacts/{contact:uuid}', 'ContactController@destroy')->name('contacts.destroy');


        // Partial Views
        Route::get('/partials/articles', 'ArticleController@articles');
        Route::get('/partials/contacts', 'ContactController@contacts');

        // Page
        Route::get('/pages', 'PageController@index')->name('pages.index');
        Route::post('/pages', 'PageController@store')->name('pages.store');
        Route::get('/preview', 'PreviewController@show')->name('preview.show');
        Route::get('/pages/{page:slug}', 'PageController@edit')->name('pages.edit');
        Route::put('/pages/{page}/update', 'PageController@update')->name('pages.update');
        Route::delete('/pages/{page}', 'PageController@destroy')->name('pages.destroy');

        // Block
        Route::post('/block', 'BlockController@store')->name('blocks.store');
        Route::put('/block/{block}', 'BlockController@update')->name('blocks.update');
        Route::delete('/block/{block}', 'BlockController@destroy')->name('blocks.destroy');

        // Seo
        Route::get('/seo', 'SeoController@index')->name('seo.index');

        // Category
        Route::get('/categories', 'CategoryController@index')->name('categories.index');
        Route::post('/categories/create', 'CategoryController@store')->name('categories.store');
        Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
        Route::put('/categories/{category}', 'CategoryController@update')->name('categories.update');
        Route::delete('/categories/{category:uuid}', 'CategoryController@destroy')->name('categories.destroy');

        // Settings
        Route::get('/settings', 'SettingController@index')->name('settings');
        Route::post('/settings', 'SettingController@store')->name('settings.store');

        // Profile
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('/profile/update', 'ProfileController@update')->name('profile.update');

        // Media
        Route::get('/media', 'MediaController@index')->name('media');
        Route::get('/partials/media', 'MediaController@media');
        Route::post('/media/upload', 'MediaController@store')->name('media.store');
        Route::post('/media/image/delete', 'MediaController@destroy')->name('media.destroy');
    });

    // Route::get('/home', 'HomeController@index')->name('home');

    // Dynamic Page
    Route::get('{page:slug}', 'PageController@show')->name('pages.show');

    Route::mixin(new \Laravel\Ui\AuthRouteMethods());
    Auth::routes(['register' => false, 'reset' => false]);
});
