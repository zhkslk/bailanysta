<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Notifications extends Component
{
    public $perPage = 10;
    public $page = 1;

    public function loadMore(): void
    {
        $this->page++;
    }

    public function markAllAsRead(): void
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function markAsRead(string $notificationId): void
    {
        $notification = auth()->user()->unreadNotifications()->find($notificationId);
        $notification?->markAsRead();
    }

    public function render(): View
    {
        return view('livewire.notifications', [
            'notifications' => auth()->user()->notifications()->latest()->paginate($this->perPage * $this->page),
            'unreadCount' => auth()->user()->unreadNotifications()->count(),
        ])->title(__('Notifications'));
    }
}
