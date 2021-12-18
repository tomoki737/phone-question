<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\Boolean;

class Question extends Model
{
    protected $fillable = [
        'title',
        'body'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function answers(): HasMany
    {
        return $this->hasMany('App\Answer');
    }

    public function getCoucntAnswersAttribute():int
    {
        return $this->answers->count();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute():int
    {
        return $this->likes->count();
    }
}
