<?php

namespace Lemaur\Toolbox\Commands;

use Illuminate\Console\Command;

class ToolboxCommand extends Command
{
    public $signature = 'toolbox';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
