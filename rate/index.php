<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
  $("document").ready(function(){
    $(".myButton").click(function(){
      var data = {
        "action": "test"
      };
      data = "response=" + $(this).attr("value") + "&" + $.param(data) + "&url=" + $("#my_image").attr("src");
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "dbInter.php", //Relative or absolute path to response.php file
        data: data,
        success: function(data) {
          $("#my_image").attr("src",data["url"]);
          alert("Form submitted successfully.\nReturned json: " + data["json"]);
        }
      });
      return false;
    });
  });
  </script>
</head>
<body>
    <button  name="response" value="1"" type="submit" class="myButton">Like</button>
    <button  name="response" value="0" type="submit" class="myButton">Dislike</button>
  <div class="the-return">
  <img id="my_image" src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg"/>
  </div>
</body>
</html>
