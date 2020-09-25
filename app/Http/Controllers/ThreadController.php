<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index()
    {
        $thread = Thread::all();

        return response()->json($thread);
    }

    public function store(Request $request)
    {
        $thread = Thread::firstOrCreate([
            'user_id' => Auth::user(),
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return new ThreadResource($thread);
    }

    public function show(Thread $thread)
    {
        return new ThreadResource($thread);
    }

    public function update(Request $request, Thread $thread)
    {
        if (Auth::user() !== $thread->user_id) {
            return response()->json(['error' => 'You can only edit your own comments.'], 403);
        }

        $thread->update($request->only(['title', 'body']));

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
