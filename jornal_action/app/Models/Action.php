<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Action extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['userId', 'actionKey', 'created_at','date', 'info'];
    protected $casts = [
        'info' => 'array',
    ];
}
