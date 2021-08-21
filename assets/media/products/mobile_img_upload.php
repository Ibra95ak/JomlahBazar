<?php
    if (isset($_POST['image'])) {
      $image = $_POST['image'];
      $name = rand().".jpg";
      $realImage = base64_decode($image);
      file_put_contents($name, $realImage);
      echo $name;
    }else {
      echo "Missing parameters!";
    }
?>
