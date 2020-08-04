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
    
    protected $fillable=[
        'value',
        'date',
        'description',
        'user_id',
        'subtag_id',
        'investimento_id'
    ];
    
    protected $table= 'extract';
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    public function users(){
        return $this->belongsTo(UsersModel::class,'user_id');
    }

    public function subtag(){
        return $this->belongsTo(SubtagModel::class,'subtag_id');
    }

    public function investimento(){
        return $this->belongsTo(InvestimentoModel::class,'investimento_id');
    }
}
