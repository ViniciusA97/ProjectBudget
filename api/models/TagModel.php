<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $fillable=[
        'name',
    ];
    protected $table= 'tag';
    protected $timestamps = false;

    public function subtag()
    {
        return $this->hasMany(SubtagModel::class);
    }

    
}
