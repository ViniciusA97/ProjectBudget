<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Api\Models\TagModel;

class SubtagModel extends Model
{
    use Uuids;
    public $incrementing = false;
    public $fillable=[
        'name',
        'tag_id',
        'id'
    ];
    public $table= 'subtag';
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo('Api\Models\TagModel','tag_id','id');
    }

    public function extract()
    {
        return $this->hasMany('Api\Models\ExtractModel','id','subtag_id');
    }
    
}
