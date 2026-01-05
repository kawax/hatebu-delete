<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Revolution\Hatena\Bookmark\Bookmark;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'access_token',
        'token_secret',
        'key',
        'fails',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token',
        'token_secret',
        'key',
        'remember_token',
    ];

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
