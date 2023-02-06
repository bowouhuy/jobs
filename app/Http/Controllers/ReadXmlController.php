<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
  
class ReadXmlController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $xmlString = file_get_contents(public_path('sample-course.xml'));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true); 
   
        dd($phpArray);
    }
}