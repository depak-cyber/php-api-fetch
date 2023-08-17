<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Table;
use Illuminate\Http\Request;

class FetchData extends Controller
{
    public function index(){
       // $data= Table::all();
        $data= Table::orderBy('epc','desc')->get();
        //return $data;
        $posts=Table::paginate(5);
        return view('welcome',compact('data', 'posts'));
    }
}
