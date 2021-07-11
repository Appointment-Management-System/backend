<?php
session_start();   // session starts with the help of this function 


if(isset($_SESSION['use']))   // Checking whether the session is already there or not if 
                            // true then header redirect it to the home page directly 
{
  $display_name = $_SESSION['use'];
  $_SESSION['status'] = 1;
}
else {
  $_SESSION['status'] = 0;
}

 ?>

<!DOCTYPE html>
<html>
    <head>
    <title>RT PCR TEST</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <style>
    .bg {
        background-color: #0000ff80;
    }
      /* Create two columns/boxes that floats next to each other */
a{
  text-decoration:none;
  color:black;
}

li{
  font-weight:bolder;
  display:inline;
  padding: 20px;
  padding-top:60px;
  padding-bottom:20px;
}
li:hover{
  background-color:rgb(100,100,255)
}
h1{
  display:inline;
  float:left;
  font-family: 'Staatliches', 'cursive';
  padding-left:20px;
  font-weight:bolder;
  padding-top:0px;
}
#out{
  color:red;
}
#second{
  position:relative;
  top:70px;
  float:left;
}
#first{
  overflow: hidden;
  background-color:rgb(0,255,200);
  margin-top:10px;
}

/* Style the list inside the menu */
ul {
  list-style-type: none;
  padding: 0;
  font-size : 30px;
  overflow: hidden;
  float:right;
  padding-top:38px;
}

article {
  float: right;
  padding: 20px;
  width: 40%;
  height: 200px; /* only for demonstration, should be removed */
}

/* Clear floats after the columns */
section:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
@media (max-width: 600px) {
  nav, article {
    width: 60%;
    height: 100 px;
  }
      </style>
    </head>
    <body class ="bg">
        <div style="color:white;padding:0px;font-size: 30px;">
    <div id="first">
       <h1>RT PCR TEST. </h1>
    <ul>
      <li id="new"><a href="insert.php">Add New Data</a></li>
      <li id="add"><a href="#">Add File</a></li>
      <li id="show"><a href="add.php">Show Appointment</a></li>
      <li id="out"><a href="logout.php">Log out</a></li> 
    </ul>
    </div>     
        
            
                <div id="second">
                 <div class="welcome" id = "welcome" >Welcome <b><?php echo $display_name; ?></b>, You have successfully logged in!<br></div>
                </div>
                <section>

  
  
</section>
            
        </div>
        
        
    </body>
    </html>
   