<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="x-icon" href="{{ asset('kafa-logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Payment Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center alignment for form */
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form container */
        .container {
            margin-top: -100px;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <div class="container">
            <div class="center-form">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Parent Payment Form</h2>

                    <form id="payment-form" action="{{ route('session.store') }}" method="post">
                        @csrf <!-- Include CSRF token -->
                        <div class="form-group">
                            <label for="child_id">Select Child:</label>
                            <select id="child_id" name="child_id" class="form-control" {{ $children->isEmpty() ? 'disabled' : '' }} required>
                                @if($children->isEmpty())
                                    <option value="">No children available</option>
                                @else
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_type">Payment Type:</label>
                            <select id="payment_type" name="payment_type" class="form-control">
                                <option value="tuition_fee">Tuition Fee</option>
                                <option value="activity_fee">Activity Fee</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks (if others selected):</label>
                            <textarea id="remarks" name="remarks" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="payment_amount">Payment Amount:</label>
                            <input type="number" id="payment_amount" name="payment_amount" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.getElementById('payment_type').addEventListener('change', function() {
                var paymentType = this.value;
                var paymentAmountField = document.getElementById('payment_amount');

                if (paymentType === 'tuition_fee') {
                    paymentAmountField.value = 60;
                } else {
                    paymentAmountField.value = '';
                }
            });
        </script>
    </x-app-layout>
</body>

</html>
