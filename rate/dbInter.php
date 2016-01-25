<?php
require 'dbConnect.php';
if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "test": test_function(); break;
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
// test_function();

function test_function(){
  $return = $_POST;
  // $return = array("response"=>"Like", "url"=>"https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg");
  $success;
  if ($return["response"] == "1"){
    $success = insertResponse("1523412364", "1", $return["url"]);
  } else{
    $success = insertResponse("1523412364", "0", $return["url"]);
  }
  if($success){
    $return["url"] = giveResponse();
  }
  // var_dump($return);
  $return["json"] = json_encode($return);
  echo json_encode($return);
}
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

  return false;

}

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
  return $url;
}

mysqli_close($con);
