<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VideosController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_file = null;
        $video_file = null;

        $video = new Video;

        $image_file = $request->file('image');
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'video' => 'required|mimes:mp4'
        ]);
        $video_file = $request->file('video');
        $request->validate(['video' => 'required|mimes:mp4']);

        $thumbPath = '/videos/Thumbnails/';
        $vidPath = '/videos/';

        $extension = $image_file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;

        $extension = $video_file->getClientOriginalExtension();
        $videoName = time() . '.' . $extension;

        $video->title = $request->input('title');
        $video->category = $request->input('category');
        $desc = $request->input('description');
        if ($desc === null) {
            $video->description = "";
        } else {
            $video->description = $desc;

        }
        $video->video = $vidPath . $videoName;
        $video->thumbnail = $thumbPath . $imageName;
        $video->user = $request->user()->name;
        $video->views = rand(10, 100) . 'k views - ' . rand(1, 6) . ' days ago';

        $image_file->move(public_path() . $thumbPath, $imageName);
        $video_file->move(public_path() . $vidPath, $videoName);

        if ($video->save()) {
            return redirect()->route('clips.show', $video['id']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inertia::render('Video', [
            'video' => VideoResource::make(Video::find($id))->resolve(),
            'comments' => Comment::where('video_id', $id)->get(),
            'recommendedVideos' => VideoResource::collection(
                Video::inRandomOrder()->limit(20)->get()
            )->collection,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        if (file_exists(public_path() . $video->video)) {
            unlink(public_path() . $video->video);
        }

        if (file_exists(public_path() . $video->thumbnail)) {
            unlink(public_path() . $video->thumbnail);
        }
        //todo change to ondelete

        Comment::where('video_id', $video->id)->delete();
        $video->delete();
        return redirect()->route('deleteVideo');
    }

    public function like($id)
    {
        $video = Video::find($id);
        $video->likes = $video->likes + 1;
        $video->save();
        return $video->likes;
    }

    public function dislike($id)
    {
        $video = Video::find($id);
        $video->dislikes = $video->dislikes + 1;
        $video->save();
        return $video->dislikes;
    }
}
