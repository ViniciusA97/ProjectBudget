<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

trait Uuids
{
    public static function boot()
    {
        
        parent::boot();

        static::creating(function ($post) {
            $post->id = Uuid::uuid4();
        });
     
        
    }
}

?>