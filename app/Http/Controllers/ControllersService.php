<?php

namespace App\Http\Controllers;

use App\Helpers\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ControllersService
{

    public static function responseSuccess($responseArray, $statusCode = 200)
    {
        return response()->json($responseArray, $statusCode);
    }
    public static function responseErorr($responseArray, $statusCode = 200)
    {
        return response()->json($responseArray, $statusCode);
    }
}
