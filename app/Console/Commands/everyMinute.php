<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Query\Builder;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'block:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This function update users that are no longer blocked';

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
     * @return mixed
     */
    public function handle()
    {
        //TODO: verify 
        User::whereNotNull('release_date')->where('release_date', '<', now())->insert(['release_date' => NULL])->insert(['role' => 'Member']);
    }
}
