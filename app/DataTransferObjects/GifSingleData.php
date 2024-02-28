<?php

namespace App\DataTransferObjects;

class GifSingleData {

    private string $id;
    private string $url;
    private string $username;
    private string $source;
    private string $title;

    public function __construct($data) {
        $this->id       = $data->id;
        $this->url      = $data->url;
        $this->username = $data->username;
        $this->source   = $data->source;
        $this->title    = $data->title;
    }

    public function toArray() {
        return [
            "id"        => $this->id,
            "url"       => $this->url,
            "user_name" => $this->username,
            "source"    => $this->source,
            "title"     => $this->title,
        ];
    }
}
