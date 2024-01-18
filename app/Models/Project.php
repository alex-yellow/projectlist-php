<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = false;
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
