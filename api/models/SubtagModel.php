<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class SubtagModel extends Model
{
    protected $fillable=[
        'name',
        'tag_id'
    ];
    protected $table= 'subtag';
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo('Api\Models\TagModel');
    }
    
}
