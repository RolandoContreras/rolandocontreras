<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include ("vendor/autoload.php");
class Stripegateway {
    public function __construct(){
        $stripe = array(
                 "secret_key" => "sk_test_twsziyeku7u7DcZGNCtCeDjs",
                 "public_key" => "pk_test_o0c1SIapQ0qxBEPnpdbESNtl"
                );
                \Stripe\Stripe::setApiKey($stripe["secret_key"]);
    }
    
    public function checkout($token,$type,$email,$amount){
        $message = ""; 
        try{
            $charge = \Stripe\Charge::create(array(
                'amount' =>$amount, 
                'currency' =>'eur',
                'description' =>'Compra de Criptomoneda', 
                'source' => $token,
                
            )); 
            $message = $charge->status;
            
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        }
        return $message;
    }
}

