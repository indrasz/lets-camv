<?php

namespace App\Models;

use App\Models\Camv;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public $table = 'transactions';

    protected $fillable = [
        'destinations_id',
        'camvs_id',
        'users_id',
        'transaction_total',
        'transaction_status',
        'booking_date',
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
