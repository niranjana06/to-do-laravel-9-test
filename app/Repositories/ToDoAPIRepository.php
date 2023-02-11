<?php

namespace App\Repositories;

use App\Http\Requests\ToDoRequest;
use App\Interfaces\ToDoApiInterface;
use App\Models\Todo;
use App\Traits\APIResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToDoAPIRepository implements ToDoApiInterface
{
    Use APIResponse;

    private Todo $model;

    /**
     * @param Todo $model
     */
    public function __construct(Todo $model)
    {
        $this->model = $model;
    }

    public function search($pram)
    {
        try {
            $tasks = $this->model::where('status', $pram['status'])->paginate(5);
            return $this->successResponse("Filtered Tasks", $tasks);

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function getToDoById($id)
    {
        try {
            $task = $this->model::find($id);

            // Check the $task
            if(!$task) return $this->error("No task with ID $id", 404);

            return $this->successResponse("Task Detail", $task);
        } catch(\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function createOrUpdateToDos(ToDoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            // If task is exists when we find it and update task
            $task = $id ? $this->model::find($id) : new $this->model;

            // Check the task
            if($id && !$task) return $this->errorResponse("No task with ID $id", 404);

            $params = $request->post();
            //$params['user_id'] = Auth::user()->id; // todo: implement api level authentication

            $task->fill($params)->save();

            DB::commit();

            return $this->successResponse($id ? "Task updated" : "Task created", $task,
                $id ? 200 : 201);

        } catch(\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function deleteToDos($id)
    {
        DB::beginTransaction();
        try {
            $task = $this->model::find($id);

            // Check task
            if(!$task) return $this->errorResponse("No task with ID $id", 404);

            // Delete task
            $task->delete();

            DB::commit();
            return $this->successResponse("Task deleted", $task);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
