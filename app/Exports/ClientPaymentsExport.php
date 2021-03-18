<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientPaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $dayRange;

    public function __construct($dayRange)
    {
        $this->dayRange = $dayRange;
    }

    public function collection()
    {
        return Client::with(['payments' => function($query) {
            return $query->whereDate('created_at', '>', Carbon::now()->subDays($this->dayRange));
        }])->orderBy('created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Surname',
            'Latest Payment Amount',
            'Latest Payment Date'
        ];
    }

    public function map($client): array
    {
        return [
            $client->name,
            $client->surname,
            optional($client->payments->last())->amount ?? '-',
            optional(optional($client->payments->last())->created_at)->format('d/m/Y H:i:s') ?? '-'
        ];
    }

}
