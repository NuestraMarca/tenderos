<?php

namespace Tenderos\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected function getFormatSelect2(array $items)
    {
    	$json = [];

        foreach ($items as $key => $value) {
            array_push($json, ['id' => $key, 'text' => $value]);
        }

        return $json;

    }
}
