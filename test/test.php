<?php

$clave = "123456";

$claveEncriptada = password_hash($clave, PASSWORD_BCRYPT);

var_dump($claveEncriptada);