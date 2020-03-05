<?php

namespace App\Console\Commands;

use App\Models\Seo;
use Illuminate\Console\Command;

class PushUrl extends Command {

    protected $name = 'push_url';

    protected $description = '推送链接到百度';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        (new Seo())->pushUrl();

        return;

    }

}
