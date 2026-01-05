<?php

namespace App\Console\Commands;

use App\Jobs\DeleteAllJob;
use App\Models\User;
use Illuminate\Console\Command;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hatena:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
