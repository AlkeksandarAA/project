<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['model_type', 'model_id', 'badge'];
    
    public function model()
    {
        return $this->morphTo();
    }
}
