<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientPaymentsExport;
use Illuminate\Support\Facades\Storage;

class ExportClientPaymentsCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:client-latest-payments {days=30}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports all the clients with their latest payment in the last 30 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $days = $this->argument('days');

        $filename = "client-last-$days-days-payment.csv";

        Excel::store(new ClientPaymentsExport($days), $filename, 'exports', \Maatwebsite\Excel\Excel::CSV);

        $this->info("Created csv file: " . Storage::disk('exports')->path($filename));
    }
}
