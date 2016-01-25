<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
  <div class="container">
    <form action="collection_test.php" method="post">
      URL of image:<br>
      <input type="text" name="url" value="">
      <br>
      <br>
      <input type="submit" value="Submit">
    </form>
      <br>

    <p>INSTRUCTIONS: <br>
      Search google for generic clothing term. Ex: shirts<br>
      Click on <b>"Search Tools"</b> and select <b>"Size"</b>, then click on <b>"Medium"</b>. <br>
      Click on an image, then click on "View Image". <br>
      Copy paste that url in the input box above! <br>
      Click on Submit!</p>
    </div>
  </body>
  </html>
  <?php
  require '/rate/dbConnect.php';
  if(isset($_POST["url"]) && !empty($_POST["url"])){
    // echo $_POST["url"];
    $sql = "INSERT INTO pictures(url) VALUES('" . $_POST["url"] . "')";
    if($result = $conn -> query($sql)){
      return true;
    }
  }
