<?php

header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");


$json= file_get_contents("./name.json");
$content = json_decode($json,true);

$txt_n = $_GET["del_name"];
$i=0;

foreach ($content['button'] as $key) 
{
    if($key["name"]==$txt_n)
    {
    	echo $key["image"];
    	if(file_exists("./picture/".$key["image"])){ 
    		echo "img刪除";
            unlink("./picture/".$key["image"]);//將檔案刪除
        }
        array_splice($content['button'],$i,1);
        break;
        
    }
    echo $key["name"]."exist";
    $i+=1;
}
$data = json_encode($content);
file_put_contents( './name.json' , $data);

header("Location: ./index.html");

?>