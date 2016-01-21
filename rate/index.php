<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script>
function firstTime(){
  // alert("test");
  xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      // get response
      // myJson = JSON.parse(xmlhttp.responseText);

      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
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
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    	// get response
    	myJson = JSON.parse(xmlhttp.responseText);

      document.getElementById("txtHint").innerHTML=myJson['image'];
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
<div id="txtHint"><b>Person info will be listed here.</b></div>
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
