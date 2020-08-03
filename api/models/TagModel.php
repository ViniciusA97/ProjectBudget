<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    protected $fillable=[
        'name',
    ];
    protected $table= 'tag';
    protected $timestamps = false;

    public function subtag()
    {
        return $this->hasMany('Api\Models\SubtagModel');
    }

    
}
