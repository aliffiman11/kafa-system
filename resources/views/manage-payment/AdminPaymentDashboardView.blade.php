<x-app-layout>
    <div class="page-header min-vh-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0 text-start">
                            <h4 class="font-weight-bolder">Admin Payment Dashboard</h4>
                            <!-- Button to trigger the modal for adding new payment -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPaymentModal">
                                Add New Payment
                            </button>
                            <p class="mb-0">List of all payments made by users.</p>
                        </div>
                        <div class="card-body">
                            @if($payments->isEmpty())
                            <p>No payments found.</p>
                            @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Student Name</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->users->name }}</td>
                                        <td>{{ $payment->student ? $payment->student->name : 'No Student' }}</td>
                                        <td>{{ $payment->payment_type }}</td>
                                        <td>{{ $payment->payment_amount }}</td>
                                        <td>{{ $payment->payment_status }}</td>
                                        <td>{{ $payment->remarks }}</td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPaymentModal" data-id="{{ $payment->id }}" data-user-name="{{ $payment->users->name }}" data-student-name="{{ $payment->student ? $payment->student->name : '' }}" data-payment-type="{{ $payment->payment_type }}" data-payment-amount="{{ $payment->payment_amount }}" data-payment-status="{{ $payment->payment_status }}" data-remarks="{{ $payment->remarks }}">Edit</button>
                                        </td>
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

    <!-- Edit Payment Modal -->
    <div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.updatePayment') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit-payment-id" name="payment_id">
                        <div class="form-group">
                            <label for="edit-user-name">User Name</label>
                            <input type="text" class="form-control" id="edit-user-name" name="user_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit-student-name">Student Name</label>
                            <input type="text" class="form-control" id="edit-student-name" name="student_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit-payment-type">Payment Type:</label>
                            <select id="edit-payment-type" name="payment_type" class="form-control">
                                <option value="tuition_fee">Tuition Fee</option>
                                <option value="activity_fee">Activity Fee</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-payment-amount">Amount</label>
                            <input type="number" class="form-control" id="edit-payment-amount" name="payment_amount">
                        </div>
                        <div class="form-group">
                            <label for="edit-payment-status">status</label>
                            <input type="text" class="form-control" id="edit-payment-status" name="payment_status">
                        </div>
                        <div class="form-group">
                            <label for="edit-remarks">Remarks</label>
                            <textarea class="form-control" id="edit-remarks" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Add Payment Modal -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">Add New Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.storePayment') }}" method="POST" id="addPaymentForm">
                    @csrf
                    <div class="modal-body">
                        <!-- User selection -->
                        <div class="form-group">
                            <label for="user_id">Select User:</label>
                            <select id="user_id" name="user_id" class="form-control">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Child selection (dynamically updated based on selected user) -->
                        <div class="form-group">
                            <label for="child_id">Select Child:</label>
                            <select id="child_id" name="child_id" class="form-control" disabled>
                                <option value="">Select Child</option>
                            </select>
                        </div>
                        <!-- Payment fields -->
                        <div class="form-group">
                            <label for="payment_type">Payment Type:</label>
                            <select id="payment_type" name="payment_type" class="form-control">
                                <option value="tuition_fee">Tuition Fee</option>
                                <option value="activity_fee">Activity Fee</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_amount">Amount:</label>
                            <input type="number" class="form-control" id="payment_amount" name="payment_amount">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitPayment">Submit Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    jQuery(document).ready(function($) {
        // When user selection changes
        $('#user_id').change(function() {
            var userId = $(this).val();
            if (userId) {
                $('#child_id').prop('disabled', false);
                $.ajax({
                    url: '/admin/getChildren/' + userId,
                    type: 'GET',
                    success: function(response) {
                        $('#child_id').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#child_id').prop('disabled', true);
                $('#child_id').html('<option value="">Select Child</option>');
            }
        });

        // Submit payment form
        $('#addPaymentForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var childId = $('#child_id').val();
            var paymentType = $('#payment_type').val();
            var paymentAmount = $('#payment_amount').val();
            var paymentMethod = $('#payment_method').val(); // Assuming this is your payment method field
            var paymentStatus = 'complete'; // Default to 'complete'

            if (paymentType === 'tuition_fee' && paymentAmount < 60) {
                paymentStatus = 'incomplete';
            } else if (paymentType === 'tuition_fee' && paymentAmount >= 60) {
                paymentStatus = 'completed';
            }

            formData += '&child_id=' + childId + '&payment_method=' + paymentMethod + '&payment_status=' + paymentStatus;

            $.ajax({
                url: '{{ route("admin.storePayment") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    window.location.href = '{{ route("payment.dashboard") }}';
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Update modal content when opening
        $('#editPaymentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var userName = button.data('user-name');
            var studentName = button.data('student-name');
            var paymentType = button.data('payment-type');
            var paymentAmount = button.data('payment-amount');
            var paymentStatus = button.data('payment-status');
            var remarks = button.data('remarks');

            var modal = $(this);
            modal.find('#edit-payment-id').val(id);
            modal.find('#edit-user-name').val(userName);
            modal.find('#edit-student-name').val(studentName);
            modal.find('#edit-payment-type').val(paymentType);
            modal.find('#edit-payment-amount').val(paymentAmount);
            modal.find('#edit-payment-status').val(paymentStatus);
            modal.find('#edit-remarks').val(remarks);
        });
    });
</script>



</x-app-layout>