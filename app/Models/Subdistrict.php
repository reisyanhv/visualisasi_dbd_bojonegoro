<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function criteria()
    {
        return $this->hasMany(Criteria::class, 'subdistrict_id', 'id');
    }

    public function result()
    {
        return $this->hasMany(Result::class, 'subdistrict_id', 'id');
    }

    public function predictionResult()
    {
        return $this->hasMany(PredictionResult::class, 'subdistrict_id', 'id');
    }

    public function predictionCriteria()
    {
        return $this->hasMany(PredictionCriteria::class, 'subdistrict_id', 'id');
    }

    public function kmeansResult()
    {
        return $this->hasMany(KmeansResult::class, 'subdistrict_id', 'id');
    }
}
