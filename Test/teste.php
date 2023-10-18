<?php 
$path='/Test/teste.php';

//recherche la derniere occurence de '/' utilissé et retourne tou ce qu'il y a après
strrchr($path, '/');//resultat: /teste.php

//enleve '/' dans le strrchr($path, '/')
trim(strrchr($path, '/'),'/');//resultat: teste.php

//decomposer les chaines de caractères en com delimiter '/' 
explode('/', $path);

//retourne le dernier element de explode('/', $path)
array_pop(explode('/', $path));//resultat: teste.php


var_dump($_SERVER);
die();

current_timestamp