<?php

namespace App\Traits\Models;


use App\Models\General\Comment;

trait HasComment
{


    /**
     * Define a polymorphic one-to-many relationship to Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    /**
     * Define a polymorphic one-to-many relationship to Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publishedComments()
    {
        return $this->comments()->where('status', 'published');
    }

    /**
     * Define a polymorphic one-to-many relationship to Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function pendingComments()
    {
        return $this->comments()->where('status', 'pending');
    }


    public function getCommentUrlAttribute()
    {
        return route('comments.index', ['commentable_id' => $this->id, 'commentable_type' => self::class]);
    }

    public function getAllCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function getPendingCommentsCountAttribute()
    {
        return $this->pendingComments()->count();
    }

    public function getPublishedCommentsCountAttribute()
    {
        return $this->publishedComments()->count();
    }
}
