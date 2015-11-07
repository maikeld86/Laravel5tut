<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about(){
        //$name = 'Maikel Doemges';

        $people = [
            'Kayleigh Gielen','Bonnie Wijnen', 'Semmy Goessens'
        ];
        //return view('pages.about')->with('name', $name);
        return view('pages.about',compact('people'));
    }

    public function contact (){
        return view('pages.contact');
    }
}
