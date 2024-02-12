<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdatePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing passwords with bcrypt hashing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => bcrypt($user->password)]);
        }

        $this->info('Passwords updated successfully.');
    }
}
