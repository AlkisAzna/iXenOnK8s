<?php
session_start();
if (!empty($_SESSION["access_token"] )) {
//   $Sub_paylaod= $_POST['checkbox'];
  $IDErr="name in use";
  $access_token=$_SESSION["access_token"];
  $USERNAME=$_SESSION["USERNAME"];
  $PASSWORD=$_SESSION["PASSWORD"];
  $ch=curl_init("http://10.48.0.9:1027/v2/entities/$USERNAME");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array("Fiware-ServicePath: /subscribers","Fiware-Service: tourguide","X-Auth-token: thismagickeyfororion"));
  $list = curl_exec($ch);
  curl_close($ch);
  //////////////////////////////////////////////////////////////////////
  $ch=curl_init("http://10.48.0.9:1027/v2/entities?limit=1000");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array("Fiware-ServicePath: /applications","Fiware-Service: tourguide","X-Auth-token: thismagickeyfororion"));
  $existingapps = curl_exec($ch);
  curl_close($ch);

}else{
    //echo "you must login first ";
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  font-size: 22px;
  cursor: pointer;

  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 5px;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
#P { text-align: center }
#App_scope{
  background-image: url('');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  padding: 5px 20px 5px 40px;
}
#container{
  margin: auto;
  text-align:left;
}
#div1{
 margin: auto;


}
#div2{


  left: 500px;
    margin-right:0;
    position:absolute;
}
* {
  box-sizing: border-box;

}

.autocomplete {
  /*the container must be positioned relative:*/

  position: relative;
  display: inline-block;
}
input {

  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=button] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {

  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
.error {color: #FF0000;}
/*the container must be positioned relative:*/
.custom-select {
  position: !important;
  font-family: Arial!important;

}
.custom-select select {
  display: none!important;
}
.select-selected {
  background-color: DodgerBlue;
  height:42px
}
/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}
/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}
/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}
/*style items (options):*/
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}
/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}
.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
.popup {
    position: relative;
    display: inline-block;
    cursor: pointer;

}

/* The actual popup */
.popup .popuptext {
    visibility: hidden;
    width: 700px;
    height: 300px;
    background-color: #555;
    color: #fff;
    white-space: pre;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 900px;
    margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
}
</style>
</head>

<body>
  <nav class="w3-sidebar w3-red  w3-top w3-large w3-padding" style="z-index:3;width:18%;font-weight:bold;background-color: DodgerBlue!important;" id="mySidebar"><br>
    <div class="w3-container">
      <h3 class="w3-padding-64"><b id="show_username"></b></h3>
    </div>
    <div class="w3-bar-block " style="z-index:3;">
      <a href="devPortal.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white"style="position:absolute; bottom:0;width:90%; overflow: hidden;">Back</a>
      <a  onclick="CURL();" class="w3-bar-item w3-button w3-hover-white">Search</a>
      <a  onclick="calculations();" class="w3-bar-item w3-button w3-hover-white">Application Generate</a>
    </div>
  </nav>


<div id="p"><h1 class="w3-xxxlarge w3-text-red"style="color: DodgerBlue!important;text-align: center!important;margin-top:80px;"><b>Create Application</b></h1></div><br><br>
<div id="container"style="width:50%;">
    <div id="div1"style="width:100%;">


              <div id="p" style="text-align: center" >Application name </div>
              <input id="appname" type="text" name="appname" placeholder="e.g: myapp"style="width:30%;margin : 0 auto;display: block;"><br><br>
              <div class="autocomplete" style="width:100%;" >
                <textarea   id=Query maxlength="100000" style="width:100%;height:200px;float:left;font-size: 22px; border-radius: 25px;; overflow: hidden;" spellcheck="false">

  (attrs.temperature# || attrs.humidity#)
                </textarea>
                <textarea   id=GeoQuery maxlength="100000" style="width:100%;height:200px;float:left;font-size: 22px; overflow: hidden; border-radius: 25px;" spellcheck="false">

  "georel": "near;maxDistance:20000",
  "geometry": "point",
  "coords": "41.3763726, 2.1864475"

               </textarea>


             </div>
            <div class="popup" >
              <span class="popuptext" id="myPopup" style="overflow-y:scroll;"></span>
            </div>


</div>
<br>
<div class="autocomplete"  style="background-color:#f0f0f5;width:100%; border-radius: 25px;" ><br>

    <div  id=results class="w3-container" style="width:100%;height:200px;overflow-y:scroll;">
        <h3 class="w3-padding-64"style="text-align: center!important;">The query results, are going to be displayed here...</h3>
    </div>


</div>

</div>
<br><br>
<div id="container"style="width:50%;">
<div id="mydiv"  class="autocomplete" style="width:50%;margin : 0 auto;display: block;">
  <div id="p" style="text-align: center!important;">Add a mashup to the Application</div>
  <br>
  <input type="text" id="attribute" placeholder="attribute"style="width:45%;float:left;">
  <div  style="width:30%;float:left;height:42px!important;border-radius: 25px!important;">
    <select id="operation" style="height:46px;background-color: #DCDCDC!important;" >
      <option  value="HMAX">MAX_24hr</option>
      <option  value="HMIN">MIN_24Hr</option>
      <option  value="HAVERAGE">AVG_24Hr</option>
      <option  value="HMIN_column">MIN_24Hr_c</option>
      <option  value="HMAX_column">MAX_24Hr_c</option>
      <option  value="HAVERAGE_column">AVG_24Hr_c</option>
      <option  value="HMAX_7D">MAX_7D</option>
      <option  value="HMIN_7D">MIN_7D</option>
      <option  value="HAVERAGE_7D">AVG_7D</option>
      <option  value="LIVE">LIVE</option>
    </select>
  </div><input type="button"  value=" Add " onclick="Mashup();" style="width:20%;float:right;height:46px;"/><br><br>
</div>
<br><br>
<div id="p" style="text-align: center">Application Description</div>
 <br>
 <textarea   id="description" maxlength="100000" style="width:50%;height:100px;margin : 0 auto;display: block; border-radius: 25px;" >
e.g: This app is showing cool stuff
 </textarea><br><br>
 <div id="p" style="text-align: center">Assign the application to a specific application scope</div>

 <div id="mydiv"  class="autocomplete" style="width:50%;margin : 0 auto;display: block;border-radius: 25px!important;">
   <div id="p" style="text-align: center!important;"></div>
   <br>
   <div style="width:100%;margin : 0 auto;display: block;height:42px!important;border-radius: 25px!important;">
     <select id="App_scope" style="height:42px;width:100%;border-radius: 25px!important;">
       <option value="" disabled selected>Select Application Scope</option>
       <option  value="enviromental_monitoring">Enviromental Monitoring</option>
       <option  value="assisted_living">Assisted Living</option>
     </select>
   </div>
 </div>
</div>


<input  id="123" value=<?php echo $list;?> style="display: none;">



<br><br>
<br><br>
<br><br>
<div class="w3-light-grey w3-container w3-padding-32" style="background-color: #DCDCDC!important;

    text-align: right;
    height: 50px;
    width: 100%;
    position: fixed;
    bottom: 0;
    margin-left:"><p style="position: relative;top: -10px;">Copyright 2018 | Intelligent Systems Laboratory</p>
</div>

<script type="text/javascript">
    var Username = "<?php echo $USERNAME; ?>";
    document.getElementById("show_username").innerHTML =Username;

</script>
<script src="https://cdn.jsdelivr.net/npm/jsonld@1.0.0/dist/jsonld.min.js"></script>

<script>
function results_ids(payload) {
  var permissions = document.getElementById('123').value;
  permissions = JSON.parse(permissions);
  var xhttp2 = new XMLHttpRequest();
  payload = JSON.parse(payload);
  var GeoQuery=document.getElementById("GeoQuery").value;

  if (GeoQuery.indexOf('geometry') > -1)
  {
    GeoQuery='"expression": {'+GeoQuery+"}";
    GeoQuery=GeoQuery.replace(/\\n/g,'')
    GeoQuery=GeoQuery.replace(/\\/g,'');
    var tmp={"geoQuery":GeoQuery};
    payload.push(tmp);
  }else{
    var tmp={"geoQuery":""};
    payload.push(tmp);
  }
  payload = JSON.stringify(payload);

  xhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      payload = this.responseText;
      validattributes=payload;
      obj = JSON.parse(payload);
      for (var i in obj) {

        if(permissions.hasOwnProperty(obj[i].id)){

          var checkBox = document.createElement("input");
          var label = document.createElement("label");
          var span_custom = document.createElement('span');
          span_custom.classList.add('checkmark');
          checkBox.type = "checkbox";
          checkBox.value = obj[i].id;
          checkBox.name = "checkbox[]";
          checkBox.class = "messageCheckbox";
          checkBox.checked=true;
          label.id=i;
          label.addEventListener("dblclick",function(){
                                                            obj[this.id].context;
                                                            var context =JSON.stringify(obj[this.id].context.value);
                                                            var temp=obj[this.id];
                                                            var body =JSON.stringify(temp);
                                                            body=body.slice(1, -1);
                                                            var doc ="{"+body+","+'"@context":'+context+"}";
                                                            doc=JSON.parse(doc);
                                                            var cont = {};
                                                            jsonld.compact(doc, cont, function(err, compacted) {
                                                                  var popup = document.getElementById("myPopup");
                                                                  if(currentStateOpened==false){
                                                                    popup.classList.toggle("show");
                                                                    currentStateOpened=true;
                                                                  }
                                                                  popup.innerHTML=JSON.stringify(compacted, null,2);
                                                            });
                                                          });
          label.classList.add('container');
          label.appendChild(checkBox);
          label.appendChild(span_custom);
          document.getElementById("results").appendChild(label);


          label.appendChild(document.createTextNode("Sensor:  "));
          var sensor_id=document.createTextNode(obj[i].id);
          var span = document.createElement('span');
          span.style.fontSize = "20px";
          span.style.color = "DodgerBlue";
          span.appendChild(sensor_id);
          label.appendChild(span);
          label.appendChild(document.createElement('br'));
          label.appendChild(document.createElement('br'));
          document.getElementById("results").appendChild(document.createElement('br'));
       }
    }


    }
  };
  xhttp2.open("POST", "getDesiredIDs.php", true);
  xhttp2.send(payload);
}
 </script>
<script>

var currentStateOpened =false;
var popup = document.getElementById("myPopup");
popup.addEventListener("dblclick",function(){
                                            popup.classList.toggle("show");
                                            currentStateOpened=false;
                                          });
function CURL() {


  document.getElementById("results").innerHTML = "";
  var payload;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      payload = this.responseText;
      if(payload!='Syntax error' && (JSON.parse(payload)).length>0){
        results_ids(payload);
      }
    }
  };
  var q=document.getElementById("Query").value;
  q = q.replace(/#/g,"!= undefined");

  xhttp.open("POST", "mongoParserAjax.php", true);
  xhttp.send(q);

}




</script>



<script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 0; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

<script>
function Mashup() {
var attr=document.getElementById('attribute').value;
if(validattributes.search(attr)==-1){
    alert("this is not a valid attribute according to query results");
}
else if(attr==""){
    alert("attribute cant be blank");
}
else{
    if (confirm("add this mashup?")) {
          var choosen=new Array();
            var cboxes = document.getElementsByName('checkbox[]');
            var len = cboxes.length;
            for (var i=0; i<len; i++) {
              if(cboxes[i].checked)
                choosen.push(cboxes[i].value);
            }


            var oper=document.getElementById('operation').value;
            var person = {attribute:attr, operation:oper, ids:choosen};

            Array2MushUp.push(person);
            var objJON=JSON.stringify(Array2MushUp);
    }
}
}

</script>




<script>

function calculations() {

var app_name=document.getElementById('appname').value;
var service_path=document.getElementById("App_scope").value;
var existingapps=<?php echo $existingapps;?>;
existingapps=JSON.stringify(existingapps);
if(app_name==""){
    alert("app name cant be blank");
}
else if(existingapps.search(app_name)!=-1){
    alert("name already in use");
}
else if(service_path==""){
    alert("Assign the application to a specific scope");
}
else{

      if (confirm("if u want to genarate this app press ok")) {

          var f_array = {appname:app_name,info:Array2MushUp};

          Array2MushUpGenerate.push(f_array);
          var obj_JON=JSON.stringify(Array2MushUpGenerate);
          alert("going to send : "+obj_JON);
            var payload;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                payload = this.responseText;
                payload = payload.substring(payload.indexOf("{"));
                payload=JSON.parse(payload);
                createCBappInfo(payload["id"]);
              }
            };
            xhttp.open("POST", "deploy.php", true);
            xhttp.send(obj_JON);
      }
}
}

function createCBappInfo(appid) {
var Appinfo=new Array();
var app_name=document.getElementById('appname').value;
var description=document.getElementById('description').value;
var App_scope=document.getElementById('App_scope').value;
description=description.replace(/\n/g, '')
Appinfo={appname:app_name,appdescription:description,appid:appid,App_scope:App_scope};
Appinfo=JSON.stringify(Appinfo);
var payload;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    payload = this.responseText;
  }
};
xhttp.open("POST", "AppToCB.php", true);
xhttp.send(Appinfo);
}
</script>



<script>
var validattributes="";
var Array2MushUp=new Array();
var Array2MushUpGenerate=new Array();

</script>








</body>
</html>
