<?php
require 'dbConnect.php';
// handle an ajax request
if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "rating": main(); break;
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

// handles inserting repsonse and returning a response
function main(){
  $return = $_POST;
  $success;
  if ($return["response"] == "1"){
    $success = insertResponse($return["profileID"], "1", $return["url"]);
  } else{
    $success = insertResponse($return["profileID"], "0", $return["url"]);
  }
// store the next image to display
  $return["url"] = giveResponse();
// encode into a JSON before sending response
  $return["json"] = json_encode($return);
// give full response back to page
  echo json_encode($return);
}

// auxillary function to insert a rating into DB
function insertResponse($profile, $response, $url){
  global $conn;
  $id;
// DB uses foriegn keys, so find what ID represents the given URL
  $sql = "SELECT id FROM pictures WHERE url = '" . $url . "'";
  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object()){
      $id = $row -> id;
    }
  }

  // Now use the ID to represent the URL in the insertion
  $sql = "INSERT INTO profile_data(profile, url, response) VALUES('" . $profile . "'," . $id . ", " . $response . ")";
  if($result = $conn -> query($sql)){
    return true;
  }
}
// auxillary function to find the range of id-values
// used to randomize which image will be displayed next
// returns an array of two values - 1 is min, 0 is max
// called by giveResponse() function
function getRange(){
  global $conn;
// find the max value
  $sql = "SELECT id from pictures ORDER BY id DESC LIMIT 1";
  $array = array();

  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object())
    $array[0] = (int)$row -> id;
  }

//find the min value
  $sql = "SELECT id from pictures ORDER BY id ASC LIMIT 1";

  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object())
    $array[1] = (int)$row -> id;
  }
  return $array;
}

// function to return the next image for the user to rate
function giveResponse(){
  global $conn;
  $url;
// call function to find what id's are viable
// reliant on having no gaps in the database - all id's must be sequential
  $arr = getRange();
// select the next image to display
  $sql = "SELECT url FROM pictures WHERE id = ". rand($arr[1], $arr[0]);
  if($result = $conn -> query($sql)){
    while($row = $result -> fetch_object()){
      $url = $row -> url;
    }
  }
// return a string of the URL
  return $url;
}

//close the connection
mysqli_close($conn);
