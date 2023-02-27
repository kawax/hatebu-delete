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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $users = User::where('key', config('hatena.key'))
                     ->where('fails', '<=', 10)
                     ->get();

        foreach ($users as $user) {
            info(class_basename(self::class).' : '.$user->name);
            DeleteAllJob::dispatch($user);
        }

        return 0;
    }
}
