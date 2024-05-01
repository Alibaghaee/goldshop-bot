<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Admin\Admin;
use App\Http\Resources\User\User;
use App\Models\General\Content;
use App\Models\General\ProductItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_fa' => $this->status_fa,
            'shortRelatedTitle' => $this->short_related_title,
            'relatedTitle' => $this->RelatedTitle,
            'short_description' => Str::limit($this->description, 20, " ..."),
            'description' => $this->description,
            'commentable_type' => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'commentable' =>
                $this->when(false, function () {

                    return $this->whenLoaded('commentable', function () {

                        if (get_class($this->commentable) === Content::class) {

                            return new \App\Http\Resources\Content\Content($this->commentable);
                        } elseif (get_class($this->commentable) === ProductItem::class) {

                            return new \App\Http\Resources\ProductItem\ProductItem($this->commentable);
                        }

                        return $this->commentable;
                    });
                }),

            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user', function () {
                return new User($this->user);
            }),
            'admin_id' => $this->admin_id,
            'admin' => $this->whenLoaded('admin', function () {
                return new Admin($this->admin);
            }),

            'writer' => $this->when(true, function () {


                if ($this->user_id) {

                    return optional($this->user)->fullname;
                } elseif ($this->admin_id) {

                    return 'ادمین :' . optional($this->admin)->name;
                } elseif ($this->guest_name) {

                    return 'میهمان :' . $this->guest_name;
                }
                return '';
            }),

            'commentUrl' => $this->comment_url,
            'articleUrl' => $this->when(true, function () {


                if (get_class($this->commentable) === Content::class) {

                    return $this->commentable->admin_url;
                } elseif (get_class($this->commentable) === ProductItem::class) {

                    return $this->commentable->admin_url;
                }

                return '';

            }),
            'pendingCommentsCount' => $this->pending_comments_count,
            'publishedCommentsCount' => $this->published_comments_count,

            //
            'edit_uri' => $this->edit_uri,
            'delete_uri' => $this->delete_uri,
            'created_at_fa' => $this->created_at_fa,
            'updated_at_fa' => $this->updated_at_fa,
        ];
    }
}
