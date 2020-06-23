<?php


namespace Eiixy\WebOffice;


class File
{
    public $id;
    public $name;
    public $version;
    public $size;
    public $creator;
    public $create_time;
    public $modifier;
    public $modify_time;
    public $download_url;

    public function __construct(string $id, string $name, int $version, int $size, string $creator, int $create_time, string $modifier, int $modify_time, string $download_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->version = $version;
        $this->size = $size;
        $this->creator = $creator;
        $this->create_time = $create_time;
        $this->modifier = $modifier;
        $this->modify_time = $modify_time;
        $this->download_url = $download_url;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'version' => $this->version,
            'size' => $this->size,
            'creator' => $this->creator,
            'create_time' => $this->create_time,
            'modifier' => $this->modifier,
            'modify_time' => $this->modify_time,
            'download_url' => $this->download_url,
        ];
    }

}