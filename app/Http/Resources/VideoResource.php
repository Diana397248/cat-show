<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        Carbon::setLocale('ru');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'video' => $this->video,
            'thumbnail' => $this->thumbnail,
            'user' => $this->user,
            'views' => $this->views,
            'category' => $this->category,
            'likes' => $this->likes,
            'restrictions' => $this->restrictions,
            'video_type' => $this->video_type,
            'dislikes' => $this->dislikes,
            'description' => $this->description,
            'created_time' => $this->created_at->diffForHumans(),
        ];
    }


}
