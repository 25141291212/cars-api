<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    const FIELD_COLOR_ID = 'color_id';

    /**
     * @var array
     */
    protected $fillable = ['make', 'model', 'build_date', 'color_id'];
}
