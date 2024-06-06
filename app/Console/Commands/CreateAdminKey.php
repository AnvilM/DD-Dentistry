<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateAdminKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin key';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = base64_encode(random_bytes(32));
        File::put(dirname(app_path()) . '/.env', File::get(dirname(app_path()) . '/.env') . "\n" . 'ADMIN_KEY=' . '"' . $key . '"');
    }
}
