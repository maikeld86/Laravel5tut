<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about(){
        $name = 'Maikel <span style="color:red;">Doemges</span>';
        return view('pages.about')->with('name', $name);
    }
}
