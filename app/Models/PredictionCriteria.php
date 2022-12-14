<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['subdistrict_id','year_id','death','case','population_density','rainfall','desa_sbs','desa_stbm'];

    public function subdistrict(){
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id', 'id');
    }

    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    } 
}
