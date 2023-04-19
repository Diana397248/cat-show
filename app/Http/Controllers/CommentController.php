<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        return Comment::with('user', 'video')->get();

        return Comment::where('video_id', $request->query('id'))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
// Поля которые нужно обязательно заполнить
    public function store(Request $request)
    {
        $attributes = $request->validate([

            'text' => 'required|string',

            'parent_id' => 'exists:comments,id',

            'video_id' => 'required_without:parent_id|exists:videos,id'

        ]);

        $attributes['user_id'] = $request->user()->id;

        if ($request->parent_id) {

            $attributes['video_id'] = Comment::find($request->parent_id)->video_id;
        }

        return Comment::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
