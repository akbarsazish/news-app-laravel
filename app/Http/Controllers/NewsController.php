<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
 
public function createNews(Request $request){
    return $request->all();
}

}
