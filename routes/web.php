<?php

use Illuminate\Support\Facades\Route;
use App\Models\TechEvent;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/events', function () {
    $events = TechEvent::all();
    return view('events', ['events' => $events]);
});
