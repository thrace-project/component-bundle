<?php
namespace Thrace\ComponentBundle\Util;

class Math
{
    public static function calculatePercentage($amount, $total)
    {
        if(!$amount || !$total){
            return 0;
        }
    
        $diff = $amount / $total;
        $percent = $diff * 100;
        return number_format($percent, 2);
    }
}