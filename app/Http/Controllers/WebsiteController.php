<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Talk;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function homepage(Request $request)
    {
        $categories=Category::get();
        $talks=Talk::get();
        return view('welcome',compact('talks','categories'));
    }
    public function talks(Request $request)
    {
        $categories=Category::get();
        $talks=Talk::get();
        return view('talks',compact('talks','categories'));
    }
    public function purchasesPage(Request $request)
    {
        return view('puchasesPage');
    }
}
