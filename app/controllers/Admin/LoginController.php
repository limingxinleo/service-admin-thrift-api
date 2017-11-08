<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class LoginController extends Controller
{

    public function loginAction()
    {
        return static::success();
    }

}

