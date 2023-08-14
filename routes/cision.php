<?php

use Illuminate\Support\Facades\Route;

Route::get('/' . \config('cision.feed_base_slug', 'cision'), function () {
    return view('cision::feed');
});

Route::get('/' . \config('cision.feed_base_slug', 'cision') . '/{news}', function ($id) {
    return view('cision::article');
});
