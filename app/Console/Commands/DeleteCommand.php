<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\DeleteAllJob;
use App\Models\User;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('hatena:delete')]
class DeleteCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $users = User::whereIn('name', config('hatena.users'))->get();

        foreach ($users as $user) {
            DeleteAllJob::dispatch($user);
        }

        return 0;
    }
}
