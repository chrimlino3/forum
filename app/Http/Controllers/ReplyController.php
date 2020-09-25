<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Facade\FlareClient\Api;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Api
{
    public function index()
    {
        $reply = Reply::all();

        return response()->json($reply);
    }

    public function store(Request $request, Thread $thread)
    {
        $reply = Reply::firstOrCreate(
            [
                'user_id' => Auth::user(),
                'thread_id' => $thread->id,
                'body' => $request->body,
            ]
        );

        return new ReplyResource($reply);
    }

    public function show(Reply $reply)
    {
        return new ReplyResource($reply);
    }


    public function update(Request $request, Reply $reply)
    {
        if (Auth::user() !== $reply->user_id) {
            return response()->json(['error' => 'You can only edit your own comments.'], 403);
        }

        $reply->update($request->only(['body']));

        return new ReplyResource($reply);
    }

    public function destroy(Reply $reply)
    {
        if (Auth::user() !== $reply->user_id) {
            return response()->json(['error' => 'You can only delete your own comments.'], 403);
        }

        $reply->destroy($reply);

        return redirect()->route('api.v2.replies');
    }
}
