<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'destinations';

    protected $fillable = [
        'categories_id',
        'name',
        'price',
        'description',
        'location',
        'orderDay',
        'slug',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(DestinationGallery::class, 'destinations_id');
    }
}
