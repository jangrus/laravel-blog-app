<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'content',
        'topic_id',
        'user_id',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function topic()
    {
        return $this->belongsTo(Category::class, 'topic_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function html(): Attribute
    {
        return Attribute::get(fn () => str($this->content)->markdown());
    }

    public function likesCount(): Attribute
    {
        $count = 0;

        $likes = Like::where('post_id', $this->id)->get();
        foreach ($likes as $like) {
            $count += $like->value;
        }
        return Attribute::get(fn()=>$count);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
