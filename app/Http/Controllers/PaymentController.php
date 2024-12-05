<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function showPaymentForm()
    {
        $parent = Auth::user();
        $children = Student::where('parents_id', $parent->id)->get();

        return view('manage-payment.ParentPaymentView', compact('children'));
    }




    public function processPayment(Request $request)
    {
        // Set your Stripe API keys
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // Prepare session data
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'alipay', 'fpx', 'grabpay'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => 'Payment for ' . $request->payment_type,
                    ],
                    'unit_amount' => $request->payment_amount * 100, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
            'metadata' => [
                'payment_type' => $request->payment_type,
                'remarks' => $request->remarks,
                'user_id' => auth()->id(), // Store the user ID in the session metadata
                'child_id' => $request->child_id, // Store the child ID in the session metadata
            ],
        ]);

        return redirect()->away($session->url);
    }


    public function paymentSuccess(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session_id = $request->query('session_id');

        if (!$session_id) {
            return redirect()->route('payment.cancel')->withErrors(['message' => 'No session ID found.']);
        }

        // Retrieve the session details
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        // Save payment details in the database
        $payment = new Payment();
        $payment->user_id = $session->metadata->user_id; // Retrieve the user ID from the session metadata
        $payment->child_ID = $session->metadata->child_id; // Retrieve the child ID from the session metadata
        $payment->payment_type = $session->metadata->payment_type;
        $payment->remarks = $session->metadata->remarks ?? null;
        $payment->payment_amount = $paymentIntent->amount_received / 100; // Convert from cents to ringgit
        $payment->payment_method = $paymentIntent->payment_method_types[0]; // Get the first payment method used
        $payment->payment_status = 'completed';
        $payment->save();

        return view('manage-payment/Success');
    }


    public function paymentCancel()
    {
        return view('manage-payment/ParentPaymentView');
    }


    public function receivePayment()
    {
        // Retrieve payments for the authenticated user along with associated child's name
        $userId = Auth::id();
        $payments = Payment::with('child')->where('user_id', $userId)->get();

        // Pass the payments to the view
        return view('manage-payment.PaymentHistoryView', compact('payments'));
    }

    public function adminPaymentDashboard()
{
    // Fetch all users to display in the select dropdown
    $users = User::all();
    $payments = Payment::with(['user', 'student'])->get();
    return view('manage-payment.AdminPaymentDashboardView', compact('payments','users'));
}



    public function updatePayment(Request $request)
{
    $request->validate([
        'payment_id' => 'required|exists:payments,id',
        'payment_type' => 'required|string',
        'payment_amount' => 'required|numeric',
        'remarks' => 'nullable|string',
    ]);

    $payment = Payment::findOrFail($request->payment_id);
    $payment->payment_type = $request->payment_type;
    $payment->payment_amount = $request->payment_amount;
    $payment->payment_status = $request->payment_status;
    $payment->remarks = $request->remarks;
    $payment->save();

    return redirect()->route('payment.dashboard')->with('success', 'Payment updated successfully');
}


// Controller method to store new payment
public function storePayment(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'user_id' => 'required', // Assuming user ID is required
        'child_id' => 'required', // Assuming child ID is required
        'payment_type' => 'required',
        'payment_amount' => 'required|numeric',
        'remarks' => 'nullable|string',
        // Add more validation rules as needed
    ]);

    // Set default payment status to 'complete'
    $paymentStatus = 'complete';

    // Determine payment status based on payment type and amount
    if ($validatedData['payment_type'] === 'tuition_fee') {
        if ($validatedData['payment_amount'] < 60) {
            $paymentStatus = 'incomplete';
        } else {
            $paymentStatus = 'completed';
        }
    }

    // Create a new payment
    Payment::create([
        'user_id' => $validatedData['user_id'],
        'child_id' => $validatedData['child_id'], // Store the child ID
        'payment_type' => $validatedData['payment_type'],
        'payment_amount' => $validatedData['payment_amount'],
        'payment_method' => 'cash', // Set payment method as 'cash'
        'payment_status' => $paymentStatus, // Set payment status based on logic
        'remarks' => $validatedData['remarks'],
        // Add more fields as needed
    ]);
    return redirect()->route('payment.dashboard')->with('success', 'Payment updated successfully');
}






public function getChildren($userId)
{
    // Fetch children belonging to the specified user
    $children = Student::where('parents_ID', $userId)->get();

    // Generate HTML options for children
    $options = '<option value="">Select Child</option>';
    foreach ($children as $child) {
        $options .= '<option value="' . $child->id . '">' . $child->name . '</option>';
    }

    // Return the HTML options
    return $options;
}

    public function showReport()
    {
        $paymentStatusData = Payment::selectRaw('payment_status, count(*) as total')
                               ->groupBy('payment_status')
                               ->pluck('total', 'payment_status');

        $paymentMethodData = Payment::selectRaw('payment_method, count(*) as total')
                               ->groupBy('payment_method')
                               ->pluck('total', 'payment_method');

        $paymentTypeData = Payment::selectRaw('payment_type, count(*) as total')
                               ->groupBy('payment_type')
                               ->pluck('total', 'payment_type');

        return view('manage-payment.AdminPaymentReportView', compact('paymentStatusData', 'paymentMethodData', 'paymentTypeData'));
    }

}
