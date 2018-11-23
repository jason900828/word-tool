<?php

header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");

$infor = array();
$getname = $_GET['getName'];

$json_string= file_get_contents("name.json");

$content = json_decode($json_string,true);
foreach ($content["button"] as $key) 
{
	if ($getname == $key["name"])
	{
		echo $key["url"]."\t";
	    echo $key["name"]."\t";
	    echo $key["image"]."\t";
    }
}


?>