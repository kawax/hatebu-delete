<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Revolution\Hatena\Bookmark\Bookmark;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

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

    /**
     * @return Bookmark
     */
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
}
