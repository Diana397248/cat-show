<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Video
 *
 * @property int $id
 * @property string $title
 * @property string $video
 * @property string $thumbnail
 * @property string $user
 * @property string $views
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Video newModelQuery()
 * @method static Builder|Video newQuery()
 * @method static Builder|Video query()
 * @method static Builder|Video whereCreatedAt($value)
 * @method static Builder|Video whereId($value)
 * @method static Builder|Video whereThumbnail($value)
 * @method static Builder|Video whereTitle($value)
 * @method static Builder|Video whereUpdatedAt($value)
 * @method static Builder|Video whereUser($value)
 * @method static Builder|Video whereVideo($value)
 * @method static Builder|Video whereViews($value)
 * @method static Builder|Video whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @mixin \Eloquent
 */
class Video extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
