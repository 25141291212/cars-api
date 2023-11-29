<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\CarController;
use Tests\TestCase;

class CarTest extends TestCase
{
    public function test_car_not_found()
    {
        $controller = new CarController();

        $id = 9999;

        $response = $controller->show($id);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(
            sprintf("No query results for model [App\\Models\\Car] %s", $id),
            json_decode($response->getContent(), true)
        );
    }

    public function test_incorrect_build_date()
    {
        $data = [
            'make' => 'Audi', 
            'model' => 'A3', 
            'build_date' => '1970-01-01', 
            'color' => 'Green'
        ];

        $maxDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d') . ' -4 year'));

        $this->post('/api/cars', $data)
            ->assertStatus(422)
            ->assertJsonPath('message', 'The build date field must be a date after or equal to ' . $maxDate . '.');
    }

    public function test_correct_build_date()
    {
        $date = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 year'));

        $data = [
            'make' => 'Audi', 
            'model' => 'A3', 
            'build_date' => $date, 
            'color' => 'Green'
        ];

        $this->post('/api/cars', $data)
            ->assertStatus(201);
    }
}
