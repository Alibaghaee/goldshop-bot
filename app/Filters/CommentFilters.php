<?php

namespace App\Filters;

use App\Filters\QueryFilters;
use App\Filters\Traits\GlobalFilters;
use App\Models\General\Content;
use Illuminate\Database\Eloquent\Builder;

class CommentFilters extends QueryFilters
{
    use GlobalFilters;


    /**
     * Filter by description.
     *
     * @param string $description
     * @return Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', '%' . $description . '%');
    }

    /**
     * Filter by user.
     *
     * @param string $user
     * @return Builder
     */
    public function user($user)
    {
        return $this->builder->whereHas('user', function (Builder $query) use ($user) {

            $query->where('name', 'like', '%' . $user . '%');
            $query->orWhere('family', 'like', '%' . $user . '%');
        });
    }

    /**
     * Filter by admin.
     *
     * @param string $admin
     * @return Builder
     */
    public function admin($admin)
    {
        return $this->builder->whereHas('admin', function (Builder $query) use ($admin) {

            $query->where('name', 'like', '%' . $admin . '%');
            $query->orWhere('family', 'like', '%' . $admin . '%');
        });
    }

    /**
     * Filter by status.
     *
     * @param string $status
     * @return Builder
     */
    public function statusJson($statusJson)
    {
        return $this->builder->where('status', 'like', '%' . json_decode($statusJson)->id . '%');
    }

    /**
     * Filter by title.
     *
     * @param string $title
     * @return Builder
     */
    public function title($title)
    {

        return $this->builder
            ->leftJoin('contents', 'comments.commentable_id', '=', 'contents.id')
            ->where('comments.commentable_type', '=', Content::class)
            ->where('contents.title', 'like', '%' . $title . '%');
    }


    /**
     * Filter by commentable_id.
     *
     * @param string $commentable_id
     * @return Builder
     */
    public function commentable_id($commentable_id)
    {

        return $this->builder->where('commentable_id', $commentable_id);
    }

    /**
     * Filter by commentable_type.
     *
     * @param string $commentable_type
     * @return Builder
     */
    public function commentable_type($commentable_type)
    {

        return $this->builder->where('commentable_type', $commentable_type);
    }

}
