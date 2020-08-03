<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractModel extends Model
{
    protected $fillable=[
        'value',
        'date',
        'description',
        'user_id',
        'subtag_id',
        'investimento_id'
    ];
    protected $table= 'extract';
    public $timestamps = false;

    public function users(){
        return $this->belongsTo('Api\Models\UsersModel','user_id');
    }

    public function subtag(){
        return $this->belongsTo('Api\Models\SubtagModel','subtag_id');
    }

    public function investimento(){
        return $this->belongsTo('Api\Models\investimentoModel','investimento_id');
    }
}
