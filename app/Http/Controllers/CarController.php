<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as Response;

class CarController extends Controller
{

    private $model;

    public function __construct(Car $car)
    {
        $this->model = $car;
    }


    public function getAll()
    {
        try {
            $cars = $this->model->all();
        } catch (QueryException $exception) {
            return response()->json($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $data = $cars ? $cars : [];
        $responseStatusCode = count($cars) > 0 ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
        return response()->json($data, $responseStatusCode);
    }

    public function get($id)
    {
        try {
            $car = $this->model->find($id);
        } catch (QueryException $exception) {
            return response()->json($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $data = $car ? $car : null;
        $responseStatusCode = $car ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;
        return response()->json($data, $responseStatusCode);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:80'],
            'description' => ['required'],
            'model' => ['required', 'max:20', 'min:2'],
            'date' => ['required', 'date_format: "Y-m-d"']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $car = $this->model->create($request->all());
            } catch (QueryException $exception) {
                return response()->json($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        $data = $car;
        $responseStatusCode = Response::HTTP_CREATED;
        return response()->json($data, $responseStatusCode);
    }


    public function update($id, Request $request)
    {
        $rules = [
            'name' => ['required', 'max:80'],
            'description' => ['required'],
            'model' => ['required', 'max:20', 'min:2'],
            'date' => ['required', 'date_format: "Y-m-d"']
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $car = $this->model->find($id);
            } catch (QueryException $exception) {
                return response()->json($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            if (!$car) return response()->json(null, Response::HTTP_NOT_FOUND);

            $car = $car->update($request->all());

            $data = $car ? $car : null;
            $responseStatusCode = $car ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST;
            return response()->json($data, $responseStatusCode);
        }
    }

    public function destroy($id)
    {
        try {
            $car = $this->model->find($id);
        } catch (QueryException $exception) {
            return response()->json($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (!$car) return response()->json(null, Response::HTTP_NOT_FOUND);

        $car->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    //
}
