<?php

namespace App\Providers;

use App\Interfaces\ToDoApiInterface;
use App\Interfaces\ToDoInterface;
use App\Repositories\ToDoAPIRepository;
use App\Repositories\ToDoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register custom Interfaces and Repositories
        $this->app->bind(ToDoInterface::class, ToDoRepository::class);
        $this->app->bind(ToDoApiInterface::class, ToDoAPIRepository::class);
    }
}
