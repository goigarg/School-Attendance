<?php

//Auto Load Classes Function

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});


date_default_timezone_set('Asia/Kolkata');