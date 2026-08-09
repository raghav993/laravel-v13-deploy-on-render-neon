<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function careers() { return view('pages.careers'); }
    public function contact() { return view('pages.contact'); }
    public function help() { return view('pages.help'); }
    public function privacy() { return view('pages.privacy'); }
}
