<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_description',
        'service_price',
        'service_images',
    ];
    protected $primaryKey = 'id';
    protected $table = 'services';
}
