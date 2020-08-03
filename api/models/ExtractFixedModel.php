<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractFixedModel extends Model
{
    protected $fillable=[
        'day_repeat',
        'description',
        'active',
        'value',
        'user_id'
    ];
    protected $table= 'extract_fixed';
    protected $timestamps = false;

    public function users()
    {
        return $this->belongsTo('Api\Models\UsersModel');
    }

}
