<?php

namespace App\Console\Commands;

use App\Events\OrderUpdate;
use Illuminate\Console\Command;

class TestPusherEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ZRB:TestPusherEvent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Pusher Event';

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
        event(new OrderUpdate(1, 123, ['title' => 'MYSQL 从入门到精通']));
    }
}
