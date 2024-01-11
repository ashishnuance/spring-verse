<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Profiletype;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Models\MemberShip;

use App\Models\PaymentsModel;

// use Stripe;

use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient('sk_live_hE7CeLY4QGONIvKej0hFLxvQ');
    }

    public $STRIPE_SECRET = 'pk_live_jU8iKscpyZ0NiIjRTpjFDWqJ';
    
    function payment_savstrip(Request $request){
        
        $charge = $request->all();
        
        $billing_detail = explode('&',$charge['billing_detail']);
        $postdata_arr = [];
        for($b=0;$b<count($billing_detail);$b++){
            $postdata = explode('=',$billing_detail[$b]);
            $postdata_arr[$postdata[0]] = str_replace('+',' ',$postdata[1]);
        }
        
        $post_payment['paid_amount'] =  $charge['amount']/100;
        $post_payment['plan_price'] =  $charge['amount']/100;
        $post_payment['member_id'] =  $request->user()->id;
        $post_payment['txn_id'] =  $charge['stripeToken'];
        $post_payment['currency'] =  $charge['currency'];
        $post_payment['plan_id'] =  $charge['plan_id'];
        $post_payment['card_type'] =  $charge['stripeTokenType'];
        $post_payment['payment_status'] =  'success';

        $post_payment['billing_name'] =  $postdata_arr['fullName'];
        $post_payment['billing_email'] =  $charge['stripeEmail'];
        // $post_payment['billing_phone'] =  $postdata_arr['phone'];
        $post_payment['billing_address'] = $postdata_arr['address'];
        $post_payment['billing_city'] = $postdata_arr['city'];
        $post_payment['billing_state'] = $postdata_arr['state'];
        $post_payment['billing_zipcode'] = $postdata_arr['pincode'];
        $post_payment['billing_country'] = $postdata_arr['country'];
        $post_payment['payment_json'] = json_encode($charge);
        
        PaymentsModel::create($post_payment);
        
        if (1) {
            $request->session()->flash('success', 'Payment completed.');
            $request->session()->flash('paid_amount', $post_payment['paid_amount']);
            return response()->redirectTo('/payment-success');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
            return redirect()->back()->with('error','Payment Failed');
        }
    }
    public function index(){
        return view('frontend.payments.index');
    }

    public function payment_popup(){
        return view('frontend.payments.paymentpage');
    }

    public function stripePost(Request $request)
    {
        
        //print_r($request->all()); exit();
        Stripe\Stripe::setApiKey($this->STRIPE_SECRET);
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }

    function payment_save(Request $request){
        // print_r($request->all()); exit();
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);

        if ($validator->fails()) {
            // $request->session()->flash('danger', $validator->errors()->first());
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            // $request->session()->flash('danger', $token['error']);
            return redirect()->back()->with('error', $token['error']);
            // return response()->redirectTo('payment');
        }
        if (empty($token['id'])) {
            return redirect()->back()->with('error', 'Payment failed');
            // $request->session()->flash('danger', 'Payment failed.');
            // return response()->redirectTo('payment');
        }

        $charge = $this->createCharge($token['id'], 2000);
        
        $post_payment['paid_amount'] =  $charge->amount;
        $post_payment['member_id'] =  $request->user()->id;
        $post_payment['txn_id'] =  $charge->balance_transaction;
        $post_payment['currency'] =  $charge->currency;
        $post_payment['card_type'] =  $charge->payment_method_details->card->brand;
        $post_payment['payment_status'] =  $charge->outcome->seller_message;
        $post_payment['billing_name'] =  $charge->billing_details->name;
        $post_payment['billing_email'] =  $charge->billing_details->email;
        $post_payment['billing_phone'] =  $charge->billing_details->phone;
        $post_payment['billing_address'] = $charge->billing_details->address->line1;
        $post_payment['billing_city'] = $charge->billing_details->address->city;
        $post_payment['billing_state'] = $charge->billing_details->address->state;
        $post_payment['billing_zipcode'] = $charge->billing_details->address->postal_code;
        $post_payment['billing_country'] = $charge->billing_details->address->country;
        $post_payment['payment_json'] = json_encode($charge);
        PaymentsModel::create($post_payment);
        
        if (!empty($charge) && $charge['status'] == 'succeeded') {
            $request->session()->flash('success', 'Payment completed.');
            return response()->redirectTo('/payment-success');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
            return redirect()->back()->with('error','Payment Failed');
        }
        return response()->redirectTo('/');
    }

    function payment_status(){
        
        $payment_ref_id = $statusMsg = ''; 
        $status = 'error'; 
        
        // Check whether the payment ID is not empty 
        if(!empty($_GET['pid'])){ 
            echo $_GET['pid']; exit();
            // $payment_txn_id  = base64_decode($_GET['pid']); 
            
            // // Fetch transaction data from the database 
            // $sqlQ = "SELECT id,txn_id,paid_amount,paid_amount_currency,payment_status,customer_name,customer_email FROM transactions WHERE txn_id = ?"; 
            // $stmt = $db->prepare($sqlQ);  
            // $stmt->bind_param("i", $payment_txn_id); 
            // $stmt->execute(); 
            // $stmt->store_result(); 
        
            // if($stmt->num_rows > 0){ 
            //     // Get transaction details 
            //     $stmt->bind_result($payment_ref_id, $txn_id, $paid_amount, $paid_amount_currency, $payment_status, $customer_name, $customer_email); 
            //     $stmt->fetch(); 
                
            //     $status = 'success'; 
            //     $statusMsg = 'Your Payment has been Successful!'; 
            // }else{ 
            //     $statusMsg = "Transaction has been failed!"; 
            // } 
        }else{ 
            echo 'else';
            exit();
        } 

        if(!empty($payment_ref_id)){
            print_r($payment_ref_id); exit();
            
        }else{
            echo 'Your Payment been failed!';
        }
    }


    public function payment_details(Request $request,$id=''){
        $user_id = $request->user()->id;
        if($id!=''){
            $this->data['id'] = $id;
            $id = base64_decode($id);
           $plan_detail = MemberShip::select('id','plan_period','title','main_price','offer_price','membership_type','description','additional_option')->where(['status'=>1,'trash'=>0,'id'=>$id]);
           if($plan_detail->count()>0){
            $this->data['plan_detail'] = $plan_detail->first();
            }
        }
        $billing_detail_check = PaymentsModel::select(['billing_name as first_name','billing_address as address','billing_country as country','billing_city as city','billing_state as state','billing_zipcode as postal_code'])->where('member_id',$user_id)->orderBy('id','DESC');
        if($billing_detail_check->count()>0){
            $this->data['user_info'] = $billing_detail_check->first();
        }else{
            $this->data['user_info'] = UserMeta::where('user_id',$user_id)->first();
        }
        // echo '<pre>';print_r($this->data['user_info']); exit();
        return view('frontend.payments.payment_details', $this->data);
    }

    public function payment_successful(){
        if(session()->get('paid_amount')){
            return view('frontend.payments.payment_successful');
        }else{
            return redirect()->route('home');
        }
    }

    function payment_page(){
        return view('frontend.payments.index');
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    public function billing(){

        $user_id = Auth::user()->id;
        $user_billing_list =[];

        $user_billing = PaymentsModel::with('member')->select(['id','member_id','billing_name','plan_id','plan_price','created_at','updated_at'])->where('member_id','=',$user_id)->orderBy('updated_at','Desc');

        
        if($user_billing->count()>0){
            $this->data ['user_billing_listall'] =  $user_billing->get();
            $this->data ['user_billing_list'] =  $user_billing->first();
        }
        // echo"<pre>"; print_r($this->data ['user_billing_list']); die;


        return view('frontend.payments.billing', $this->data);
    }

}