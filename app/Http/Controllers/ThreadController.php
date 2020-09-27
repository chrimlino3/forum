<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index()
    {
        $thread = Thread::all();

        return response()->json($thread);
    }

    public function store(ThreadRequest $threadRequest)
    {
        $thread = Thread::firstOrCreate([
            'user_id' => Auth::user(),
            'title' => $threadRequest->title,
            'body'  => $threadRequest->body,
        ]);

        return new ThreadResource($thread);
    }

    public function show(Thread $thread)
    {
        return new ThreadResource($thread);
    }

    public function update(ThreadRequest $threadRequest, Thread $thread)
    {
        if (Auth::user() !== $thread->user_id) {
            return response()->json(['error' => 'You can only edit your own comments.'], 403);
        }

        $thread->update($threadRequest->only(['title', 'body']));

        return new ThreadResource($thread);
    }

    public function destroy(Thread $thread)
    {
        if (Auth::user() !== $thread->user_id) {
            return response()->json(['error' => 'You can only delete your own comments.'], 403);
        }

        $thread->destroy($thread);

        return redirect()->route('api.v2.threads');
    }
}
