<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class FranqueadoController extends Controller
{
    public function getIdAndMail()
    {
        return User::retrieveMailAndId();
    }
}
