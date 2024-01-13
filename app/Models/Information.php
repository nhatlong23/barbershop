<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'information_name',
        'information_title',
        'information_phone',
        'information_email',
        'information_status',
        'information_opening_time',
        'information_closing_time',
        'information_images',
        'information_mission',
        'information_description',
        'information_maps',
    ];
    protected $primaryKey = 'id';
    protected $table = 'information';
}
