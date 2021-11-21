<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'title',
        'body'
    ];
    
   public function user():BelongsTo
   {
      return $this->belongsTo('App\User');
   }
}
