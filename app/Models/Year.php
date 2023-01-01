<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = ['year'];

    public function criteria()
    {
        return $this->hasMany(Criteria::class, 'year_id', 'id');
    }

    public function result()
    {
        return $this->hasMany(Result::class, 'year_id', 'id');
    }

    public function predictionResult()
    {
        return $this->hasMany(PredictionResult::class, 'year_id', 'id');
    }

    public function predictionCriteria()
    {
        return $this->hasMany(PredictionCriteria::class, 'year_id', 'id');
    }

    public function kmeansResult()
    {
        return $this->hasMany(KmeansResult::class, 'year_id', 'id');
    }
}
