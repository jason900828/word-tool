<?php
header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");

$sort = explode(',',$_GET['sort']);

if(!file_exists("edit.json")){
    $json_string= file_get_contents("name.json");
    file_put_contents( './edit.json' , $json_string);

}
$json_string= file_get_contents("edit.json");

$content = json_decode($json_string,true);

$new_arr = array();
for($i=0;$i<count($sort);$i++)
{
    $sort[$i] = (int)str_replace('ogbkddg:','',$sort[$i]);
}

for ($i=0;$i<count($content['button']);$i++)
{
    if($i<count($sort)){
        array_push($new_arr,$content['button'][$sort[$i]]);
    }
    else{
        array_push($new_arr,$content['button'][$i]);
    }


}

$new_content = "{\"button\":[";
for ($i=0;$i<count($new_arr);$i++)
{
	if($i==count($new_arr)-1)
	{
		$new_content = $new_content."{\"name\":\"".$new_arr[$i]['name']."\",\"url\":\"".$new_arr[$i]['url']."\",\"image\":\"".$new_arr[$i]['image']."\"}]}";
		break;
	}
	$new_content = $new_content."{\"name\":\"".$new_arr[$i]['name']."\",\"url\":\"".$new_arr[$i]['url']."\",\"image\":\"".$new_arr[$i]['image']."\"},";
}

file_put_contents( './edit.json' , $new_content);
if($_GET['action']==1)
{
    //header("Location: ./button_infor.html?name=".$_GET['name']);
    echo 'yo';
}
else
{
    header("Location: ./index.html");
}

?>