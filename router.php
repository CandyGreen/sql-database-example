<?php

function isMethod($method) {
    return isset($_POST['_method']) && $_POST['_method'] === $method;
}