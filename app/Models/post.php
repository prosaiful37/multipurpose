<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Categories(){
        return $this    -> belongsToMany('App\Models\Category');
    }

    public function author(){
        return $this ->belongsTo('App\Models\User');
    }

}
