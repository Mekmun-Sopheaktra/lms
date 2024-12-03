<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\PaymentGateway;
use App\Repositories\EnrollmentRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;


class PaymentController extends Controller
{
    public function index()
    {
        $transactions = TransactionRepository::query()->where('user_id', '=', auth()->user()->id)->where('is_paid', true)->get();

        return $this->json('Transaction list found', [
            'transactions' => TransactionResource::collection($transactions),
        ], 200);
    }

    public function paypalPaymentSuccess(Request $request, string $identifier)
    {
        if ($identifier) {
            return $this->enroll($identifier);
        } else {
            return $this->json('Purchase failed', null, 400);
        }
    }

    public function paypalPaymentCancel()
    {
        return $this->json('Payment cancelled', null, 400);
    }

    public function stripePaymentSuccess(string $identifier)
    {
        return $this->enroll($identifier);
    }

    public function stripePaymentCancel()
    {
        return $this->json('Payment cancelled', null, 400);
    }

    public function aamarpayPaymentSuccess(Request $request)
    {
        // Extract the transaction ID from the request
        $request_id = $request->mer_txnid;

        // Construct the URL to check the transaction status
        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php"
            . "?request_id=$request_id"
            . "&store_id=aamarpaytest"
            . "&signature_key=dbb74894e82415a2f7ff0ec3a97e4183"
            . "&type=json";

        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            )
        );

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Close the cURL session
        curl_close($curl);

        return $this->enroll($request->mer_txnid);
    }

    public function aamarpayPaymentCancel()
    {
        return $this->json('Payment cancelled', null, 400);
    }

    public function razorPaySuccess(string $identifier)
    {

        if (!$identifier) {
            return $this->json('Payment failed', null, 400);
        }

        $this->enroll($identifier);
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);

        return Response()->json($arr);
    }

    public function razorpayPaymentFail(Request $request)
    {
        return $this->json('Payment failed', null, 400);
    }


    public function aamarpayPaymentFail(Request $request)
    {
        return $this->json('Payment failed', null, 400);
    }

    public function enroll(string $identifier)
    {
        $transaction = TransactionRepository::query()->where('identifier', '=', base64_decode($identifier))->first();

        if (!$transaction) {
            return $this->json('Invalid transaction', null, 400);
        }

        // Create enrollment
        $enrollment = EnrollmentRepository::create([
            'user_id' => $transaction->user->id,
            'course_id' => $transaction->course->id,
            'coupon_id' => $transaction->coupon?->id,
            'course_price' => $transaction->course->price ? $transaction->course->price : $transaction->course->regular_price,
            'discount_amount' => $transaction->coupon ? $transaction->coupon->discount : 0,
        ]);

        $transaction->update(['is_paid' => true, 'paid_at' => now(), 'enrollment_id' => $enrollment->id]);

        return $this->json('Course purchased successfully', [
            'enrollment_id' => $enrollment->id
        ]);
    }
}
