<?php

require_once '../src/setup.php';        //Session starts here

session_destroy();
header('Location: product_list.php');
die;