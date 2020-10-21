<?php

namespace App\Console\Commands;

use App\Imports\TestImport;
use Illuminate\Console\Command;

class ImportTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the test xls';

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
     */
    public function handle()
    {
        $this->output->title('Starting import');
        (new TestImport)->withOutput($this->output)->import(storage_path('exports/TMC.xlsx'));
        $this->output->success('Import successful');
    }
}
