<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use Uuids;
    public $incrementing = false;
    public $fillable=['name',];
    public $table= 'tag';
    public $timestamps = false;

    public function subtag()
    {
        return $this->hasMany('Api\Models\SubtagModel','tag_id','id');
    }

    
}
