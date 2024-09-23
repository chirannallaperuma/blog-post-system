<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('blogs.index');
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
