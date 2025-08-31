<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Notifications\Notification;

class NewComment extends Notification
{
    public function __construct(
        public Post $post,
        public User $user,
        public Comment $comment,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'comment_id' => $this->comment->id,
            'message' => $this->buildMessage(),
        ];
    }

    public function buildMessage(): string
    {
        $userRoute = route('profile', $this->user->username);
        $postRoute = route('post', $this->post->id);

        $message = "<a href='$userRoute'>{$this->user->username}</a> left a comment on <a href='$postRoute'>your post</a>: <br><br>";
        $message .= nl2br($this->comment->body);

        return $message;
    }
}
