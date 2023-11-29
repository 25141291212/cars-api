<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{
    use HasFactory;

    const FIELD_NAME = 'name';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @param string $color
     * 
     * @return self
     */
    private function findOrCreateColor(string $color) : self
    {
        try {
            $carColor = self::where(self::FIELD_NAME, $color)
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            $carColor = self::create([self::FIELD_NAME => $color]);
        } catch (RuntimeException $e) {
            throw new Exception('Error retrieving color');
        }

        return $carColor;
    }

    /**
     * @param string $color
     * 
     * @return int
     */
    public function retrieveColorId(string $color) : int
    {
        $carColor = self::findOrCreateColor($color);

        return $carColor->id;
    }
}
