<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTaskRequest;
use App\Http\Resources\V1\TasksResouce;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpReponses;

class TaskController extends Controller
{
    use HttpReponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return TasksResouce::collection([
            Task::where('id', 5)->first()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'periority' => $request->periority
        ]);
        return new TasksResouce($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if (Auth::user()->id == $task->user_id) {
            return new TasksResouce($task);
        } else
            return $this->error('', 'unauth', 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::user()->id == $task->user_id) {
            $task->update($request->all());
            $task->save();
            return new TasksResouce($task);
        } else
            return $this->error('', 'unauth', 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (Auth::user()->id == $task->user_id) {
            $task->delete();
            return response(null, 204);
        } else
            return $this->error('', 'unauth', 401);
    }
}
