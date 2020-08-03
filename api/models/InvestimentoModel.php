<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class InvestimentoModel extends Model
{
    protected $fillable=[
        'meta_value',
        'name',
        'description',

    ];
    protected $table= 'investimento';
    protected $timestamps = false;

    public function extract()
    {
        return $this->hasMany('Api\Models\ExtractModel');
    }
}
