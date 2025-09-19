<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizerType extends Model
{
    use HasFactory;

    protected $table = 'fertilizer_types';
    protected $guarded = [];
}
