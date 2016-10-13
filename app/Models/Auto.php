<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    public $timestamps = true;
    protected $table = 'auto';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','user_id','mark_id','model_id','number','year','date_kont','date_rem','rem_kil','devices','comments','devise_bool'];

    public function model(){
        return $this->hasOne('App\Models\ModelsAuto', 'id', 'model_id');
    }
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function mark(){
        return $this->hasOne('App\Models\MarksAuto', 'id', 'mark_id');
    }
}
