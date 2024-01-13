<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'booking_name',
        'booking_phone',
        'booking_times',
        'booking_days',
        'booking_quantity',
        'booking_branch',
        'booking_service',
        'booking_hairdresser',
        'booking_comment',
        'booking_status',
    ];
    protected $primaryKey = 'id';
    protected $table = 'booking';

    public function service()
    {
        return $this->belongsTo(Service::class, 'booking_service');
    }

    public function hairdresser()
    {
        return $this->belongsTo(Hairdresser::class, 'booking_hairdresser');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'booking_branch');
    }
}
