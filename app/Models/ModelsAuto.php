<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsAuto extends Model
{
    public $timestamps = false;
    protected $table = 'models_auto';
    protected $primaryKey = 'id';
    protected $fillable = ['mark_id', 'name'];

    public function mark_auto(){
        return $this->belongsTo('App\Models\MarksAuto','id', 'mark_id');
    }
}
