<?php

namespace App\Models;

use App\Models\Camv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeatureCamv extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'camvs_id',
        'feature',
    ];

    // one to many
    public function camv()
    {
        return $this->belongsTo(Camv::class, 'camvs_id', 'id');
    }
}
