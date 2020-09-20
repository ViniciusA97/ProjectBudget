<?php

namespace Api\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ExtractFixedModel extends Model
{
    use Uuids;
    public $incrementing = false;
    public $fillable=[
        'day_repeat',
        'description',
        'active',
        'value',
        'user_id'
    ];
    public $table= 'extract_fixed';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(UsersModel::class);
    }

}
