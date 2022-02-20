<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camv extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'orderDay',
        'price',
    ];

    public function feature()
    {
        return $this->hasMany(FeatureCamv::class, 'camvs_id');
    }
}
