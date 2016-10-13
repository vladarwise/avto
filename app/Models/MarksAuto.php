<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarksAuto extends Model
{
    public $timestamps = false;
    protected $table = 'marks_auto';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name'];

    public function models_auto(){
        return $this->hasMany('App\Models\ModelsAuto', 'mark_id', 'id');
    }
}
