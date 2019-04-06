<?php

namespace Tests;

use App\User;
//use Illuminate\Support\Facades\Session;

//use Illuminate\Contracts\Console\Kernel;

trait TestsHelper
{
    protected $defaultUser;

    public function defaultUser(array $attributes = [])
    {
        return $this->defaultUser = factory(User::class)->create($attributes);
    }

}
