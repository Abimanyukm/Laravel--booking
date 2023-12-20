<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $primaryKey ='id';
    protected $table = 'slots';
    protected $fillable = [
        'name',
        'date',
        'slot',
        'status',        
    ];
}
