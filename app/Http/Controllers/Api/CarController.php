<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class CarController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $cars = Car::all();

        return self::jsonResponse($cars, 200);
    }

    /**
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $data = null;

        try {
            $car = Car::findOrFail($id);

            return self::jsonResponse($car, 201);
        } catch (RuntimeException $e) {
            // in the real world, this shouldn't be a catch all, and we'd determine 
            // whether to return this message, or a more generic one depending on the
            // error, while logging the actual error somewhere
            $data = $e->getMessage();
        }

        return self::jsonResponse($data, 404);
    }

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $data = null;

        try {    
            $validated = $request->validate(self::validationRules());

            $car = Car::create($validated);
    
            return self::jsonResponse($car, 201);
        } catch (RuntimeException $e) {
            $data = $e->getMessage();
        }

        return self::jsonResponse($data, 404);
    }

    /**
     * @param Request $request
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function update(Request $request, int $id) : JsonResponse
    {
        $data = null;

        try {    
            $validated = $request->validate(self::validationRules());
    
            $car = Car::findOrFail($id);
    
            $car->update($validated);
    
            return self::jsonResponse($car, 200);
        } catch (RuntimeException $e) {
            $data = $e->getMessage();
        }

        return self::jsonResponse($data, 404);
    }

    /**
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function delete(int $id) : JsonResponse
    {
        $data = null;

        try {
            $car = Car::findOrFail($id);
            $car->delete();

            return response()->json(null, 204);
        } catch (RuntimeException $e) {
            $data = $e->getMessage();
        }

        return self::jsonResponse($data, 404);
    }

    /**
     * @param mixed|null $data
     * @param int $status
     * 
     * @return JsonResponse
     */
    private static function jsonResponse(mixed $data = null, int $status = 200) : JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * @return array
     */
    private static function validationRules() : array
    {
        $maxDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d') . ' -4 year'));
        
        return [
            'make' => 'required',
            'model' => 'required',
            'build_date' => 'required|date|after_or_equal:' . $maxDate,
            'color' => 'required'
        ];
    }
}