<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zapros extends Model
{
    public $timestamps = true;
    protected $table = 'zapros';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'object', 'zadanie', 'description', 'comments_tehnics','done'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->format('Y-m-d H:i');
    }
}
