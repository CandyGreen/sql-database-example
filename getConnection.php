<?php

function getConnection($options) {
    $host = $options['host'];
    $dbname = $options['dbname'];
    $user = $options['user'];
    $pass = $options['pass'];

    return new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
}