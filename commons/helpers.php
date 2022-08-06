<?php

session_start();
const BASE_URL = "http://localhost/php2/Assignment_1/";
const CONTROLLER_URL = BASE_URL . "app/controllers/";
const MODEL_URL =  BASE_URL . "app/models/";
const VIEW_URL =  BASE_URL . "app/views/";
const ADMIN_LITE = BASE_URL ."public/adminlite/";
define("IMAGE_DIR",$_SERVER['DOCUMENT_ROOT'] ."/Assignment_1/public/image/") ;

$MSG_ERROR ;
$VIEW ;

function dd($value){
	var_dump($value);
	die;
}
?>