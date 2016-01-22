<?php
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require 'dbConnect.php';

function giveResponse(){
  global $conn;
  $url;
  $sql = "SELECT url FROM pictures WHERE id = ". rand(1, 2);
  // var_dump($sql);
  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object()){
      $url = $row -> url;
    }
  }
  return "<img src='" . $url . "'>";
}
$q = intval($_GET['q']);
// var_dump($q);
if($q == 9){
  echo giveResponse();
}
else{
  insertResponse($_GET['profile'], $_GET['response'], $_GET['url']);
  $url = giveResponse();
}
mysqli_close($con);
