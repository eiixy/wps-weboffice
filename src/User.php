<?php


namespace Eiixy\WebOffice;


class User
{
    public $id;
    public $name;
    public $avatar_url;
    public $permission;

    public function __construct(string $id, string $name, string $avatar_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->avatar_url = $avatar_url;
    }

    public function setPermission(string $permission = 'read')
    {
        $this->permission = $permission;
        return $this;
    }

    public function __toArray()
    {
        $res = [
            'id' => $this->id,
            'name' => $this->name,
            'avatar_url' => $this->avatar_url,
        ];
        if ($this->permission){
            $res['permission'] = $this->permission;
        }
        return $res;
    }

}