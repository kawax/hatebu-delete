<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Revolution\Hatena\Bookmark\Bookmark;

#[Fillable(['name', 'access_token', 'token_secret', 'key', 'fails'])]
#[Hidden(['access_token', 'token_secret', 'key', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public function hatenaBookmark(): Bookmark
    {
        $config = [
            'consumer_key' => config('services.hatena.client_id'),
            'consumer_secret' => config('services.hatena.client_secret'),
            'token' => $this->access_token,
            'token_secret' => $this->token_secret,
        ];

        return app(Bookmark::class)->withHatena($config);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }
}
