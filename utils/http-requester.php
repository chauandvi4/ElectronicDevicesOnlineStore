<?php
$url = 'https://jsonplaceholder.typicode.com/todos/1';
$data = array();

$options = array(
    'http' => array(
        // 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'GET',
        // 'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// var_dump(json_decode($result)[0]->price);
