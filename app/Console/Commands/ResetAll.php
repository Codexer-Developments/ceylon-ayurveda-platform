<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ceylon:reset-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset All Details';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:refresh');
        $this->call('db:seed');
    }
}
