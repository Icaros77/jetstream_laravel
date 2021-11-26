<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;
use Nette\Utils\Random;

trait PlaceOrderTrait
{
    public function generateOrderNumber()
    {
        $today = new DateTime("now", new DateTimeZone("Europe/Rome"));
        $number = Random::generate(12, '0-9');
        return $today->format("Ymd") . "-" . $number;
    }
}