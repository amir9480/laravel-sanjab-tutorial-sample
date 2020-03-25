<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'reply_id',
        'text',
    ];

    protected $casts = [
        'approved' => 'bool'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('approved', function ($query) {
            $query->where('approved', true);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replyTo()
    {
        return $this->belongsTo(Comment::class, 'reply_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id');
    }
}
