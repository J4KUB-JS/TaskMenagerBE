<?php

namespace App\Http\Controllers;
use Exception;

use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        return ['data' => Task::where('name', 'LIKE', '%'.$request['search'].'%')->orderBy('dueDate', $request['order'])->get()];
    }

    public function show(string $id)
    {
        $task = Task::where('id', $id)->first();
        $task->done = !$task->done;
        $task->save();
        return ['data' => $task ];
    }

    public function store(Request $request)
    {   
        try{
            $newTask = new Task();
            $newTask->name = $request->name;
            $newTask->desc = $request->desc;
            $newTask->dueDate = $request->dueDate;
            $newTask->done = false;
            $newTask->save();
        } catch (Exception $e) {
            return ['error' => 'smth went wrong'];
        }

        return ['data' => $newTask];
    }

    public function update(string $id, Request $request)
    {
        $task = Task::where('id', $id)->first();
        $task->name = $request->name;
        $task->desc = $request->desc;
        $task->dueDate = $request->dueDate;
        $task->done = $request->done;
        $task->save();

        return ['data' => $task];
    }

    public function destroy(string $id)
    {
        Task::where('id', $id)->delete();
        return ['message' => "task with id: $id removed"];
    }
}
