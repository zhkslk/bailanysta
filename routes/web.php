<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Feed;
use App\Livewire\Friends;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Posts;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('', Feed::class)->name('index');
    Route::get('friends', Friends::class)->name('friends');
    Route::get('notifications', Feed::class)->name('notifications');

    Route::get('/u/{username}', Feed::class)->name('profile');

    Route::redirect('settings', 'settings/profile');
    Route::get('settings/posts', Posts::class)->name('settings.posts');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
