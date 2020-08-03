<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $fillable=[
        'name',
        'email',
        'password'
    ];
    protected $table= 'users';
    protected $timestamps = false;

    public function extract()
    {
        return $this->hasMany('Api\Models\ExtractModel');
    }

    public function extractFixed()
    {
        return $this->hasMany('Api\Models\ExtractFixedModel');
    }
}
