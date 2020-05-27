<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class Car extends Model{

    protected $fillable = [
        'name',
        'description',
        'model',
        'date'
    ];

    protected $casts = [
        'date' => 'timestamp'
    ];
    
    protected $dateFormat = 'Y-m-d H:i:s';
}