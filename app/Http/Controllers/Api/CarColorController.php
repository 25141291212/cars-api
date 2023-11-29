<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarColor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class CarColorController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $carColors = CarColor::all();

        return self::jsonResponse($carColors, 200);
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
            $carColor = CarColor::findOrFail($id);

            return self::jsonResponse($carColor, 201);
        } catch (RuntimeException $e) {
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
        
            $carColor = CarColor::create($validated);
    
            return self::jsonResponse($carColor, 201);
        } catch (RuntimeException $e) {
            $data = $e->getMessage();
        }

        return self::jsonResponse($data, 404);
    }

    public function update()
    {
        //
    }

    public function delete()
    {
       //
    }

    /**
     * @param mixed|null $data
     * @param int $status
     * 
     * @return JsonResponse
     */
    private static function jsonResponse(mixed $data = null, $status = 200) : JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * @return array
     */
    private static function validationRules() : array
    {        
        return [
            'name' => 'required',
        ];
    }
}