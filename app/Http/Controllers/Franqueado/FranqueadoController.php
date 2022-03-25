<?php

namespace App\Http\Controllers\Franqueado;

use App\Http\Controllers\Controller;
use App\Models\Tray\Affiliate;
use Illuminate\Http\Request;

class FranqueadoController extends Controller
{
    public function index(Request $request){
        $slug = $request->slug;
        $affiliate = Affiliate::where('name',$slug)->first();
        return view('franqueados.index',['afiliate'=>$affiliate]);
    }
}
