<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    

    public function user() {
        return $this->bilongsTo('App\Models\User');
    }

    public function tags() {
        return $this->bilongsTo('App\Models\Tag');
    }

    
}