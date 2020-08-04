<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ExtractFixedModel extends Model
{
    use Uuids;
    public $incrementing = false;
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
        return $this->belongsTo(UsersModel::class);
    }

}
