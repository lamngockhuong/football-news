<?php

namespace App\Http\Controllers\Outside;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageNotFoundController extends Controller
{
    public function index()
    {
        return view('errors.404');
    }
}
