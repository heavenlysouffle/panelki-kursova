<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PayController;
use App\Models\Events;
use App\Models\Panel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $panel = new Panel();
    $catalog = $panel->all();
    return view('index', ['panels'=>$catalog]);
})->name('index');

Route::get('/about', function () {
    $panel = new Panel();
    $catalog = $panel->all();
    return view('about_us', ['panels'=>$catalog]);
})->name('about');

Route::get('/events', function () {
    $event = new Events();
    $catalog = $event->all()->sortByDesc('date');
    $panel = new Panel();
    $panels = $panel->all();
    return view('events', ['events'=>$catalog], ['panels'=>$panels]);
})->name('events');

Route::get('/pay', function () {
    $panel = new Panel();
    $catalog = $panel->all();
    return view('form_pay', ['errors' => null ,'panels'=>$catalog]);
})->name('pay');

Route::post('/pay/check', [PayController::class, 'pay_postValidator'])->name('pay.order');

Route::get('/issues', function () {
    $panel = new Panel();
    $catalog = $panel->all();
    return view('issues', ['panels'=>$catalog]);
})->name('issues');

Route::get('/issues/selected_issue/{id}', function ($id) {
    $catalog = new Panel();
    $panelObj = $catalog->all();
    foreach ($panelObj as $item) {
        if ($item->name == $id) {
            $panel = $item;
        }
    }
    return view('selected_issue', ['panel'=> $panel], ['panels' => $panelObj]);
})->name("selected_issue");

// Cart add route

Route::post('/issues/add', [cartController::class, 'cartAdd'])->name('cart.add');

// Cart remove route

Route::post('/issues/remove', [cartController::class, 'removeCart'])->name('cart.remove');

// Cart delete route

Route::post('/issues/delete', [cartController::class, 'deleteCart'])->name('cart.delete');
