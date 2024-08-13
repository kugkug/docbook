<?php

declare(strict_types=1);

namespace App\Helpers;

class StripeHelper {
    
    private $stripe;

    function __construct() {

        // $this->stripe = new \Stripe\StripeClient(env('STRIPE_SK_TEST_KEY'));
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SK_TEST_KEY'));
    }

    public function createPaymentMethod() {

        return $this->stripe->paymentIntents->create([
            'amount' => 1099,
            'currency' => 'usd',
          ]);
    }

    public function listPaymentMethod() {

        return $this->stripe->paymentMethods->all([
            'type' => 'card',
            'limit' => 3,
        ]);
    }
    
    public function createChargeAmount() {
        $this->stripe->create([
            'amount' => 10,
            'currency' => 'usd',
            'source' => 'tok_visa'
        ]);
    }
}