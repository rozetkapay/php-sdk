<?php

namespace RozetkaPay\Model\Payment;

use RozetkaPay\Model;

class Customer extends \RozetkaPay\Model\Customer
{
    public $color_mode = "light";

    public $locale = "";

    public $account_number = "";

    public $payment_method;

}
