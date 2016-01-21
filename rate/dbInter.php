<?php
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require 'dbConnect.php';

function getMaxID(){

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

    // var_dump($url);
    // $url = 'https://upload.wikimedia.org/wikipedia/commons/5/58/Sunset_2007-1.jpg';

    // return "hi";
    return "<img src='" . $url . "'>";
}
// $q = intval($_GET['q']);
// $sql = "INSERT INTO `fashionksu` . `clothing` (`profile`, `response`) VALUES ('" . $profile . "', '" . $q . "')";
echo giveResponse();
// $result = mysqli_query($conn,$sql);
// mysqli_close($con);
