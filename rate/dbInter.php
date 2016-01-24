<?php
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
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

function test_function(){
  $return = $_POST;

  //Do what you need to do with the info. The following are some examples.
  if ($return["favorite_beverage"] == ""){
    $return["favorite_beverage"] = "Coke";
  }
  $return["favorite_restaurant"] = "McDonald's";

  $return["json"] = json_encode($return);
  echo json_encode($return);
}
/*function giveResponse(){
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
*/
