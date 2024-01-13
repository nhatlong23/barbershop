<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hairdresser extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'hairdresser_name',
        'hairdresser_phone',
        'hairdresser_email',
        'hairdresser_images',
    ];
    protected $primaryKey = 'id';
    protected $table = 'hairdresser';
}
