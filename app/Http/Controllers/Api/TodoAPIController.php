<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToDoRequest;
use App\Interfaces\ToDoApiInterface;
use Illuminate\Http\Request;

class TodoAPIController extends Controller
{
    private ToDoApiInterface $toDoRepository;

    /**
     * @param ToDoApiInterface $toDoRepository
     */
    public function __construct(ToDoApiInterface $toDoRepository)
    {
        $this->toDoRepository = $toDoRepository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoRequest $request)
    {
        //store or update task
        return $this->toDoRepository->createOrUpdateToDos($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ToDoRequest $request, $id)
    {
        //store or update task
        return $this->toDoRepository->createOrUpdateToDos($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->toDoRepository->deleteToDos($id);
    }

    public function search(Request $request)
    {
        return $this->toDoRepository->search($request->all());
    }
}
