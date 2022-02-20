<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinationGallery extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'destination_galleries';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'destinations_id',
        'photos',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destinations_id', 'id');
    }
}
