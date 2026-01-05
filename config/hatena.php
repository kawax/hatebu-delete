<?php

declare(strict_types=1);

use function Revolution\Illuminate\Support\env;

return [
    'delete_days' => (int) env('DELETE_DAYS', 3),
    'analytics' => env('GOOGLE_ANALYTICS'),

    'users' => explode(',', env('USERS')),
];
