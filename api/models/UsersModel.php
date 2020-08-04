<?php

namespace Api\Models;

use App\Traits\Uuids;
use ExtractFixed;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $fillable=[
        'name',
        'email',
        'password'
    ];
    protected $table= 'users';
    protected $timestamps = false;

    public function extract()
    {
        return $this->hasMany(ExtractModel::class);
    }

    public function extractFixed()
    {
        return $this->hasMany(ExtractFixedModel::class);
    }
}
