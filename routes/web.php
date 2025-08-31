<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Feed;
use App\Livewire\Friends;
use App\Livewire\Notifications;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Posts;
use App\Livewire\Settings\Profile;
use App\Livewire\UserProfile;
use App\Livewire\ViewPost;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('', Feed::class)->name('index');
    Route::get('notifications', Notifications::class)->name('notifications');

    Route::get('/u/{username}', UserProfile::class)->name('profile');
    Route::get('/p/{postId}', ViewPost::class)->name('post');

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
