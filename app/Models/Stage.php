<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'name',
        'status',
        'completionDate',
    ];

    public function users() {
        return $this->belongTo(user::class);
    
    }
    public function applications() {
        return $this->hasMany(Application::class);
    
    }


}
