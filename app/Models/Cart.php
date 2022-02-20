<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $table = 'carts';

    protected $fillable = [
        'destinations_id',
        'camvs_id',
        'users_id',
    ];

    public function camv()
    {
        return $this->belongsTo(Camv::class, 'camvs_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destinations_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
