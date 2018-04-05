<?php

$task = new class extends Thread {
    private $response;

    public function run()
    {
        $content = file_get_contents("http://google.com");
        preg_match("~<title>(.+)</title>~", $content, $matches);
        $this->response = $matches[1];
    }
};

$task->start() && $task->join();

var_dump($task->response); // string(6) "Google"
