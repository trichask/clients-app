@extends('base')

@section('css')
    <!-- Date Range Picker css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('js')
    <!-- Date Range Picker js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('#payments-date-range').daterangepicker({
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });

        // This ensures that the datepicker will initialize with an empty value if the filter is not applied
        $('#payments-date-range').val('{{ request()->get("date_range", "") }}');
    </script>
@endsection

@section('content')
    <div class="card card-body bg-light" style="margin: 40px 0">
        <form action="" method="get">
            <div class="form-group">
                <label for="payments-date-range">Payments Date Range</label>
                <input id="payments-date-range" name="date_range" type="text" class="form-control">
                <small class="form-text text-muted">Date format: d/m/Y</small>
            </div>
            <input type="submit" class="btn btn-primary">
            <a href="{{ route('clients') }}" class="btn btn-secondary" style="margin-left: 5px">Clear</a>
        </form>
    </div>

    <table class="table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Last Payment Amount</th>
            <th>Last Payment Date</th>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->surname }}</td>
                    <td class="text-info">{{ optional($client->payments->last())->amount ?? '-' }}</td>
                    <td>{{ optional(optional($client->payments->last())->created_at)->format('d/m/Y H:i:s') ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
