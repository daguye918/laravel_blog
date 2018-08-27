<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlePraise extends Model
{
    public $timestamps = false;

    protected $fillable = ['article_id', 'user_id', 'ip'];

    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = ip2long($value);
    }
}
