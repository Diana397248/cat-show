<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        Carbon::setLocale('ru');
        return [
            "id" => $this->id,
            "text" => $this->text,
            "parent_id" => $this->parent_id,
            "user" => $this->user,
            "video_id" => $this->video_id,
            'updated_time' => $this->updated_at->diffForHumans(),
        ];
    }
}
