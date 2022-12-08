<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->withCount('likes')->orderedByLike();
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'like');
    }

    public function scopeOrdered(Builder $builder)
    {
        return $builder->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeOrderedByLike(Builder $builder)
    {
        return $builder->withCount('likes')->orderBy('likes_count', 'desc');
    }
}
