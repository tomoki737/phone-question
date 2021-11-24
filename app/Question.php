<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

   public function answer(): HasMany
   {
       return $this->hasMany('App\Answer');
   }
}
