<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public $STATES = [
        'on'  => ['value' => 1, 'text' => '打开', 'color' => 'primary'],
        'off' => ['value' => 2, 'text' => '关闭', 'color' => 'default'],
    ];

    public function getComment($table_name,$attribute)
    {
        return trans($table_name.$attribute);
    }

}
