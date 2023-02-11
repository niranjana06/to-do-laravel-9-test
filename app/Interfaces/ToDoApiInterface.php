<?php

namespace App\Interfaces;

use App\Http\Requests\ToDoRequest;

interface ToDoApiInterface
{
    /**
     * Get all search
     * @access  public
     */
    public function search($pram);

    /**
     * Get ToDos By ID
     * @param   integer     $id
     * @access  public
     */
    public function getToDoById($id);

    /**
     * Create | Update ToDos
     * @param   \App\Http\Requests\ToDoRequest    $request
     * @param   integer                           $id
     * @access  public
     */
    public function createOrUpdateToDos(ToDoRequest $request, $id = null);

    /**
     * Delete ToDos
     * @param   integer     $id
     * @access  public
     */
    public function deleteToDos($id);
}
