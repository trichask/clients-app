<div>
    <div class="card card-body bg-light" style="margin: 40px 0">
        <form action="" method="get">
            <div class="form-group">
                <label for="client">Client</label>
                <input id="client" name="date_range" type="text" class="form-control" placeholder="Search" wire:model="search">
            </div>
        </form>
    </div>


    <table class="table">
        <thead>
            <th>Client</th>
            <th>Payment Amount</th>
            <th>Payment Date</th>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->client->full_name }}</td>
                    <td class="text-info">{{ $payment->amount }}</td>
                    <td>{{ $payment->created_at->format('d/m/y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
