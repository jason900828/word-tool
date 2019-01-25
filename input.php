<?php

header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");

function uploadfile($file_id,$uploaddir,$file_name){

  if (!file_exists($uploaddir)){
    mkdir($uploaddir);
  }
  if ($_FILES[$file_id]['error'] === UPLOAD_ERR_OK){

    # 檢查檔案是否已經存在
    if (file_exists($uploaddir.$file_name)){
      echo '檔案已存在。<br/>';
      return 0;
    } else {
      $file = $_FILES[$file_id]['tmp_name'];
      $dest = $uploaddir . $file_name;
      # 將檔案移至指定位置
      rename($file, $dest);
      return 1;
    }
  } else {
   echo '錯誤代碼：' . $_FILES[$file_id]['error'] . '<br/>';
   return 0;

  }
}

$complete = 0;

$json = file_get_contents("./edit.json");
$content = json_decode($json,true);

$txt_n = $_POST["buttom_name"];
$txt_n = str_replace(' ', '_', $txt_n);
$txt_u = $_POST["buttom_url"];
$txt_i = str_replace(' ', '_',$_FILES["my_image"]['name']);

$check = 1;
foreach ($content['button'] as $key) 
{
    if($key['name']==$txt_n)
    {
        echo "命名重複!!<br/>";
        $check = 0;
        break;
    }
    if ($key['url']==$txt_u) {
        echo "url重複!!<br/>";
        $check = 0;
        break;
    }
    if ($key['image']==$txt_i)
    {
        echo "image name重複!!<br/>";
        $check = 0;
        break;
    }
}
if($check)
{
    if((uploadfile("my_image","./picture/",$txt_i)))
    {
        $new_button_str = ",{
            \"name\":\"$txt_n\",
            \"url\":\"$txt_u \",
            \"image\":\"$txt_i\"
        }";
        $data = substr($json,0,-2).$new_button_str."]}";
        file_put_contents( './edit.json' , $data);
        echo "成功!!<br/>";
        $complete = 1;
    }
    else
    {
        echo "新增失敗!!<br/>";
    }

    if($complete)
    {
        header("Location: ./index.html");
    }
}
?>