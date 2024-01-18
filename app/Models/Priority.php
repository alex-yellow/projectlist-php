<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';
    protected $guarded = false;
    public $timestamps = false;

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
