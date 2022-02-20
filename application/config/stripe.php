<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 
$config['stripe_api_key']         = 'sk_test_51H7MV4AzkAx4xKlt97IC60W7w7AKyn4qPSbG8n9ehFWF7kuel0a0Vxfy8BIS6vyX5Yy5paJmD1vlCNAjalIkBFie00EB3BKOFj'; 
$config['stripe_publishable_key'] = 'pk_test_51H7MV4AzkAx4xKltdrxQKEXjFy4T5DlozTgFGw8lbauBMOuqB42nhqToo4w0FSfWRA0kynJ5NMQLpiFd2xT2kg9g00KouYJlMg'; 
$config['stripe_currency']        = 'usd';