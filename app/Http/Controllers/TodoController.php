<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoRequest;
use App\Interfaces\ToDoInterface;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private ToDoInterface $toDoRepository;

    /**
     * @param ToDoInterface $toDoRepository
     */
    public function __construct(ToDoInterface $toDoRepository)
    {
        $this->toDoRepository = $toDoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //getAllToDos
        $todos = $this->toDoRepository->getAllToDos();
        //dd($todos);
        return view('todos.dashboard')->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
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
        $status = $this->toDoRepository->createOrUpdateToDos($request);
        if ($status['status']){
            return redirect()->route('dashboard')->with('success', $status['message']);
        } else {
            return redirect()->back()->withErrors(['error' => $status['message']]);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->toDoRepository->getToDoById($id);
        return view('todos.edit')->with('todo', $task);
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
        $status = $this->toDoRepository->createOrUpdateToDos($request, $id);
        if ($status['status']){
            return redirect()->route('dashboard')->with('success', $status['message']);
        } else {
            return redirect()->back()->withErrors(['error' => $status['message']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->toDoRepository->deleteToDos($id);
        if ($status['status']){
            return redirect()->back()->with('success', $status['message']);
        } else {
            return redirect()->back()->withErrors(['error' => $status['message']]);
        }
    }

    public function search(Request $request)
    {
        $todos = $this->toDoRepository->search($request->all());
        return view('todos.dashboard')->with('todos', $todos);
    }
}
