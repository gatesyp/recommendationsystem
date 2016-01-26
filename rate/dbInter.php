<?php
require 'dbConnect.php';
if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "test": main(); break;
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
// test_function();

function main(){
  $return = $_POST;
  // $return = array("response"=>"Like", "url"=>"https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg");
  $success;
  if ($return["response"] == "1"){
    $success = insertResponse("1523412364", "1", $return["url"]);
  } else{
    $success = insertResponse("1523412364", "0", $return["url"]);
  }
    $return["url"] = giveResponse();
  // var_dump($return);
  $return["json"] = json_encode($return);
  echo json_encode($return);
}
// insertResponse("asdasd", 0, "zxcv");
function insertResponse($profile, $response, $url){
  global $conn;
  $id;
  $sql = "SELECT id FROM pictures WHERE url = '" . $url . "'";
  // var_dump($sql);
  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object()){
      $id = $row -> id;
    }
  }
//  var_dump($id);
  $sql = "INSERT INTO profile_data(profile, url, response) VALUES(123123," . $id . ", " . $response . ")";
  if($result = $conn -> query($sql)){
    return true;
  }
  // var_dump($sql);

  // return false;

}
function getRange(){
  global $conn;
  $sql = "SELECT id from pictures ORDER BY id DESC LIMIT 1";
  $array = array();

  if($result = $conn -> query($sql)){
  while($row = $result -> fetch_object())
  $array[0] = (int)$row -> id;
}
  $sql = "SELECT id from pictures ORDER BY id ASC LIMIT 1";

  if($result = $conn -> query($sql)){
  while($row = $result -> fetch_object())
  $array[1] = (int)$row -> id;
}
return $array;
}
// var_dump(getRange());
// var_dump(giveResponse());
function giveResponse(){
  global $conn;
  $url;
  $arr = getRange();
  $sql = "SELECT url FROM pictures WHERE id = ". rand($arr[1], $arr[0]);
  // var_dump($sql);
  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object()){
      $url = $row -> url;
    }
  }
  return $url;
}

mysqli_close($conn);
