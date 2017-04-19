<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public $danweiRates = [
        '千克' => 1,
        '件' => 1,
        '个' => 1,
        '吨' => 1000,
    ];

    public $selectDanweis = [
        '千克' => '千克',
        '件' => '件',
        '个' => '个',
        '吨' => '吨'
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function transferDanwei($num, $danwei) {

        return $num / $this->danweiRates[$danwei];
    }
}
