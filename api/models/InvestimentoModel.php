<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class InvestimentoModel extends Model
{
    use Uuids;
    public $incrementing = false;
    public $fillable=[
        'meta_value',
        'name',
        'description',
        'user_id'
    ];
    public $table= 'investimento';
    public $timestamps = false;
    
    public function extract()
    {
        return $this->hasMany('Api\Models\ExtractModel','investimento_id','id');
    }
}
