<?php

//https://www.youtube.com/watch?v=JUMkbDhAFCw
namespace App\Http\Controllers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TableController extends Controller
{
    public function fetchInsert(){
      $response= Http::get('https://api.adgatemedia.com/v3/offers/?aff=48864&api_key=155efa664a706f295fb446570041d707&wall_code=o6qb',
      
      );
      $data= json_decode($response->body());
     
      echo '<pre>';
      $p=(array) $data;
        foreach($p as $item){
          $item = (array)$item;
          for($i=1; isset($item[$i]); $i++){
            foreach($item[$i] as $key => $options){
              
              $items=(array)$item[$i] ;
              //print_r($items);
              Table::updateOrCreate(
                ['id' => $items['id']],
                [
                  'id' => $items['id'],
                  'name'=> $items['name'],
                  'requirements'=>$items['requirements'],
                  'description'=>$items['description'],
                  'epc'=>$items['epc'],
                  'click_url'=>$items['click_url']
                  
                ]
                );
             
             
            }
          }
        }
       
      
        
     dd('data store');
      
      die;
      
      
    }

    public function show(){
        $data['tables']=Table::all();
        return view('welcome', $data);
    }
}
    