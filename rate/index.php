<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript">
  $("document").ready(function(){
    $(".myButton").click(function(){
      var data = {
        "action": "rating",
        "response" : $(this).attr("value")
      };
      FB.api('/me', function(response) {
        data = "&" + $.param(data) + "&url=" + $("#my_image").attr("src") + "&profileID=" + response.id;
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "dbInter.php",
          data: data,
          success: function(data) {
            $("#my_image").attr("src",data["url"]);
            // alert("Form submitted successfully.\nReturned json: " + data["json"]);
          }
        });
        return false;
      });
    });
  });
  </script>
</head>
<body>
  <script>
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      testAPI();
    } else if (response.status === 'not_authorized') {
      document.getElementById('status').innerHTML = 'Please log ' +
      'into this app.';
    } else {
      document.getElementById('status').innerHTML = 'Please log ' +
      'into Facebook.';
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '469894839866750',
      cookie     : true,  // enable cookies to allow the server to access
      // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.2' // use version 2.2
    });
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      // document.getElementById('status').innerHTML =
      // 'Thanks for logging in, ' + response.name + '!';
    });
  }
  </script>

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>    <button  name="response" value="1" type="submit" class="myButton">Like</button>
<button  name="response" value="0" type="submit" class="myButton">Dislike</button>
<div class="the-return">
  <img id="my_image" src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg"/>
</div>
</body>
</html>
