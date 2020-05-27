<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    
    private $model;
    
    public function __construct(Car $car)
    {
        $this->model = $car;
    }


    public function getAll()
    {
        $cars = $this->model->all();
        return response()->json($cars);
    }

    public function get($id)
    {
        $car = $this->model->find($id);
        return response()->json($car);
    }

    public function store(Request $request)
    {
        $car = $this->model->create($request->all());
        return response()->json($car);
    }
    
    
    public function update($id, Request $request)
    {
        $car = $this->model->find($id)
        ->update($request->all());

        return response()->json($car);
    }

    public function destroy($id)
    {
        $this->model->find($id)
        ->delete();

        return response()->json(null);
    }

    //
}
