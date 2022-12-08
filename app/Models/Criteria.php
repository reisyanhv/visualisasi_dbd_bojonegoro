<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['subdistrict_id','year_id','death','case','population_density','rainfall','desa_sbs','desa_stbm'];
}
