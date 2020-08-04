<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class InvestimentoModel extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $fillable=[
        'meta_value',
        'name',
        'description',

    ];
    protected $table= 'investimento';
    protected $timestamps = false;

    public function extract()
    {
        return $this->hasMany(ExtractModel::class);
    }
}
