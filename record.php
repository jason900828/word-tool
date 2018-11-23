<?php
header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");

$sort = explode(',',$_GET['sort']);

$json_string= file_get_contents("name.json");

$content = json_decode($json_string,true);

$new_arr = array();
for($i=0;$i<count($sort);$i++)
{
    $sort[$i] = (int)str_replace('ogbkddg:','',$sort[$i]);
}

for ($i=0;$i<count($sort);$i++)
{
    array_push($new_arr,$content['button'][$sort[$i]]);

}
print_r($new_arr);
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

file_put_contents( './name.json' , $new_content);
if($_GET['action']==1)
{
    header("Location: ./button_infor.html?name=".$_GET['name']);
}
else
{
    header("Location: ./index.html");
}

?>