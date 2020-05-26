<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function getAll()
    {
        return 'getAll';
    }

    public function get($id)
    {
        return "get $id";
    }

    public function store(Request $request)
    {
        dd($request->all());
        return 'store';
    }
    
    
    public function update($id, Request $request)
    {
        dd($id, $request->all());
        return "update $id";
    }

    public function destroy($id)
    {
        return "destroy $id";
    }

    //
}
