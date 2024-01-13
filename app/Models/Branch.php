<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'branch_phone',
        'branch_email',
        'branch_address',
        'branch_status'
    ];
    protected $primaryKey = 'id';
    protected $table = 'branch';
}
