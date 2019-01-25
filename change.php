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

$json= file_get_contents("./edit.json");
$content = json_decode($json,true);

$txt_org = $_POST["buttom_org"];
$txt_n = $_POST["buttom_name"];
$txt_n = str_replace(' ', '_', $txt_n);
$txt_u = $_POST["buttom_url"];
$txt_i = str_replace(' ', '_',$_FILES["my_image"]['name']);

if($txt_i){
    if(uploadfile('my_image',"./picture/",$txt_i))
    {
        echo '上傳成功!!';
        $i=0;
        foreach ($content['button'] as $key)
        {
            if ($key['name']==$txt_org)
            {
                if($key['image']!=$txt_i)
                {
                    unlink('./picture/'.$key['image']);
                    $content['button'][$i]['image'] = $txt_i;
                    $complete = 1;
                }
            }
            $i+=1;
        }  
    }
}
else
{
    $complete = 1;
}

$i=0;

foreach ($content['button'] as $key) 
{
    if(($txt_n=='')||($txt_u==''))
    {
        echo '有格子為空值';
        break;
    }
    else if($key['name']==$txt_org)
    {
        if(($key['name']!=$txt_n)||($key['url']!=$txt_u))
        {
            $content['button'][$i]['name'] = $txt_n;
            $content['button'][$i]['url'] = $txt_u;
            $complete = $complete + 2;
        }
        else if(($key['name']==$txt_n)&&($key['url']==$txt_u))
        {
            $complete = $complete + 2;
        }
    }
    
    
    $i+=1;
}
$data = json_encode($content);
file_put_contents( './edit.json' , $data);
if ($complete == 3)
{
    header("Location: ./index.html");
}


?>