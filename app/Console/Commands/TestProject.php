<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class TestProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to initialize testing project';

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
     *
     * @return int
     */
    public function handle(): int
    {
        Config::set('database.connections.mysql.database', 'monkey_pox_test');

        Artisan::call('migrate:fresh --database=mysql_testing');

        $this->info('Database Was Migrated');

        User::create([
            'name' => 'ibrahim',
            'email' => 'ibrahim@test.com',
            'password' => Hash::make('123')
        ]);

        $this->info('User Test Was Created Successfully');

        return self::SUCCESS;
    }
}
