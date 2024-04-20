<?php

use function Revolution\Illuminate\Support\env;

return [
    'key' => env('SPECIAL_KEY'),
    'delete_days' => env('DELETE_DAYS', 3),
    'analytics' => env('GOOGLE_ANALYTICS'),

    'users' => explode(',', env('USERS')),
];
