<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidyAllocation extends Model
{
    use HasFactory;

    protected $table = 'subsidy_allocations';
    protected $guarded = [];
}
