<?php

namespace App\Console\Commands;

use App\Imports\OrdersImport;
use App\Imports\TMCImport;
use App\Imports\GrayFrtImport;
use Illuminate\Console\Command;

class ImportSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the sales xls';

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
        $this->output->title('Starting orders import');
        (new OrdersImport)->withOutput($this->output)->onlySheets('Orders')->import(storage_path('exports/SALES.xlsx'));
        $this->output->success('Imported orders successful');
        $this->output->title('Starting tmc import');
        (new TMCImport)->withOutput($this->output)->onlySheets('TMC')->import(storage_path('exports/SALES.xlsx'));
        $this->output->success('Imported tmc successful');
        $this->output->title('Starting gray frt import');
        (new GrayFrtImport)->onlySheets('gray frt (3)')->import(storage_path('exports/SALES.xlsx'));
        $this->output->success('Imported gray frt successful');
    }
}
