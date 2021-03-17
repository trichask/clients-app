<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Payment;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::with(['payments' => function($query) use ($request) {
            return $query->when($request->date_range, function() use ($request, $query) {
                $dates = explode (' - ', $request->date_range);

                $from = Carbon::createFromFormat('d/m/Y', $dates[0]);
                $to = Carbon::createFromFormat('d/m/Y', $dates[1]);

                return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
            });
        }])->get();

        return view('clients', compact('clients'));
    }
}
