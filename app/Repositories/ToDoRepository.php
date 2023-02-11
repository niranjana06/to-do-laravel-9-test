<?php

namespace App\Repositories;

use App\Http\Requests\ToDoRequest;
use App\Interfaces\ToDoInterface;
use App\Models\Todo;
use App\Traits\APIResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToDoRepository implements ToDoInterface
{
//    use APIResponse;

    private Todo $model;

    /**
     * @param Todo $model
     */
    public function __construct(Todo $model)
    {
        $this->model = $model;
    }

    public function getAllToDos()
    {
        $params = ['group_bya' => 'status'];
        try {
            $resQuery = $this->model::query();

            if (isset($params['group_by'])){
                $resQuery->groupBy($params['group_by']);
            }

            $res = $resQuery->paginate(5);

            return $this->model::paginate(5);
        } catch(\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function search($pram)
    {
        try {
            return $this->model::where('status', $pram['status'])->paginate(5);
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getToDoById($id)
    {
        return $this->model::find($id);
    }

    public function createOrUpdateToDos(ToDoRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            // If task is exists when we find it and update task
            $task = $id ? $this->model::find($id) : new $this->model;

            // Check the task
            if($id && !$task) return  ['status'=> false, 'message' => "No Task with ID $id"];

            $params = $request->post();
            $params['user_id'] = Auth::user()->id;;

            $task->fill($params)->save();

            DB::commit();

            $message = !is_null($id) ? 'Task Updated' : 'Task created successfully';
            return ['status'=> true, 'message' => $message];

        } catch(\Exception $e) {
            DB::rollBack();
            // exception log - $e->getMessage();
            //return ['status'=> false , 'message' => $e->getMessage()];
            return ['status'=> false , 'message' => 'Oops! Task not created.'];
        }
    }

    public function deleteToDos($id)
    {
        DB::beginTransaction();
        try {
            $task = $this->model::find($id);

            // Check task
            if(!$task) return  ['status'=> false, 'message' => "No Task with ID $id"];

            // Delete task
            $task->delete();

            DB::commit();
            return ['status'=> true, 'message' => 'Task Deleted'];
        } catch(\Exception $e) {
            DB::rollBack();
            return ['status'=> false , 'message' => 'Oops! Something went wrong.'];
        }

    }
}
