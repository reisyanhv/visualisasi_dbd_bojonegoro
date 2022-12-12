<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionResult extends Model
{
    use HasFactory;

    protected $fillable = ['subdistrict_id','year_id','risk'];

    public function subdistrict(){
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id', 'id');
    }

    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    } 
}
