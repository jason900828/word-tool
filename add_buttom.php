<?php

header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");

$url = array();
$name = array();
$image = array();

$json_string= file_get_contents("name.json");

$content = json_decode($json_string,true);
foreach ($content["button"] as $key) {
	array_push($url, $key["url"]);
	array_push($name, $key["name"]);
	array_push($image, $key["image"]);
}

for ($i=0;$i<count($name);$i++){
	
   echo "<il class=\"gb_T\"  id=\"ogbkddg:".$i."\" ><a target=\"_blank\" href=".$url[$i]." class=\"card ".$name[$i]." show\" \"=\"\"  data-blink-id=\"zd7ltzskulbvaaw7wypi8\" style=\"background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url(./picture/".$image[$i]."); position:relative; \"><p class=\"card-param-1\"></p><div class=\"info\"><h2 class=\"card-title\" >".$name[$i]."</h2><p class=\"card-description\"></p></div><div><input class=\"card-param-2\" type=\"button\" id = ".$name[$i]."  onclick=\"clickBtn(event,this)\"></div></a></il>";

}



?>

