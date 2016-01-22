<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <script>
  function getID(){
    // facebook operation to get their profile id
    // return id;
  }
  function firstTime(){
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        return xmlhttp.responseText;
//        document.getElementById("txtHint").innerHTML= xmlhttp.responseText;
}
    }
    xmlhttp.open("GET","dbInter.php?q=9",true);
    xmlhttp.send();
  }
  function sendData(str) {
    if (str=="") {
      document.getElementById("txtHint").innerHTML="";
      return;
    }
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        // get the response which will just be a plain URL, construct the img tag for it and display it to "txtHint"
        // that saved image url will go back to GET parameters under key "url" for DB use
        // document.getElementById("txtHint").innerHTML=
        dataHelper(xmlhttp.responseText);
      }
    }
    xmlhttp.open("GET","dbInter.php?q="+str,true);
    xmlhttp.send();
  }

  </script>
</head>
<body onload = "firstTime()">
  <div class="container">

    <br>
    <div id="txtHint">
      <img src= "firstTime()">
    </div>
  </div>
  <p> LIKE AND DISLIKE BUTTON WILL GO HERE REPLACING THE FORM
    <form>
      <select name="users" onchange="sendData(this.value)">
        <option value="">Select a person:</option>
        <option value="0">Like</option>
        <option value="1">Dislike</option>
      </select>
    </form>
  </body>
  </html>
