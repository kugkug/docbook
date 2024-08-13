<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Helpers\StripeHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RawStripeController extends Controller {
    public function create_payment_method(StripeHelper $stripe_helper) {
        $create_payment_method =  $stripe_helper->createPaymentMethod();

        return GlobalHelper::response($create_payment_method);
    }

    public function list_payment_method(StripeHelper $stripe_helper) {
        $list_payment_method =  $stripe_helper->listPaymentMethod();

        return GlobalHelper::response($list_payment_method);
    }
}