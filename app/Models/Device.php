<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = true;
    protected $table = 'device';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'category', 'mark_id', 'model_id', 'version', 'year', 'date_kont', 'date_rem', 'rem_time', 'comments'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function model(){
        return $this->hasOne('App\Models\ModelsAuto', 'id', 'model_id');
    }
    public function mark(){
        return $this->hasOne('App\Models\MarksAuto', 'id', 'mark_id');
    }
}


