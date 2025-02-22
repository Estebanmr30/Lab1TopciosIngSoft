<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
// bad practice
Route::get('/about', function () {
    $data1 = 'About us - Online Store';

    $data2 = 'About us';
    $description = 'This is an about page ...';

    $author = 'Developed by: Your Name';

    return view('home.about')->with('title', $data1)

        ->with('subtitle', $data2)

        ->with('description', $description)

        ->with('author', $author);
})->name('home.about');

Route::get('/contact', function () {
    $data1 = 'Contact us - Online Store';
    $email = 'contact@online_store.com';
    $address = 'Online Store';
    $phoneNumber = '123456789';

    return view('home.contact')->with('title', $data1)->with('email', $email)->with('address', $address)->with('phoneNumber', $phoneNumber);
})->name('home.contact');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
Route::get('/products/validation', 'App\Http\Controllers\ProductController@validation')->name('product.validation');
Route::post('/products/save', 'App\Http\Controllers\ProductController@save')->name('product.save');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
