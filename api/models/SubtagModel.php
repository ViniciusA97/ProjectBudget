<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class SubtagModel extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $fillable=[
        'name',
        'tag_id'
    ];
    protected $table= 'subtag';
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(TagModel::class);
    }
    
}
