<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="x-icon" href="{{ asset('kafa-logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Payment History</title>
</head>

<body>
    <x-app-layout>

        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">My Payments</h4>
                                <p class="mb-0">List of all payments you have made.</p>
                            </div>
                            <div class="card-body">
                                @if($payments->isEmpty())
                                <p>No payments found.</p>
                                @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Child Name</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Remarks</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->payment_type }}</td>
                                            <td>{{ $payment->child->name }}</td>
                                            <td>{{ $payment->payment_amount }}</td>
                                            <td>{{ $payment->payment_method }}</td>
                                            <td>{{ $payment->remarks }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
</body>

</html>