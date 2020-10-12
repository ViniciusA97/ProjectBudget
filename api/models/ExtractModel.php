<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ExtractModel extends Model
{
    use Uuids;
    protected $primaryKey = 'id';

    public $incrementing = false;
    
    public $fillable=[
        'value',
        'date',
        'description',
        'user_id',
        'subtag_id',
        'investimento_id'
    ];
    
    public $table= 'extract';
    
    public $keyType = 'string';
    
    public $timestamps = false;

    public function users(){
        return $this->belongsTo(UsersModel::class,'user_id');
    }

    public function subtag(){
        return $this->hasOne(SubtagModel::class,'id','subtag_id');
    }

    public function tag(){
        return $this->hasOneThrough(TagModel::class,SubtagModel::class,
        'id', // primary key do 2 pro where 
        'id', // clusula inner join 1. key 
        'subtag_id', // foreign key do model para ligar no where com o 2
        'tag_id' // clausula inner join 2. foreignkey
    );
    }

    public function investimento(){
        return $this->hasOne(InvestimentoModel::class,'id','investimento_id');
    }
}
