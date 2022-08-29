<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes, Taggable;

    protected $fillable = [
        'content', 
        'user_id'
    ];

    protected $hidden = [
        'deleted_at',
        'commentable_type',
        'commentable_id',
        'user_id'
    ];    

    public function Commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }     

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT,'desc');
    }   
    

}
