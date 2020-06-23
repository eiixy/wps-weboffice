<?php

namespace Eiixy\WebOffice;

use Illuminate\Support\Collection;

class Users
{
    public $users;

    public function __construct()
    {
        $this->users = new Collection();
    }

    public function push(User $user)
    {
        $this->users->push($user);
    }

    public function first($default = null)
    {
        return $this->users->first(null,$default);
    }
}
