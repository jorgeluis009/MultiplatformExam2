<?php
   $Servername = "localhost";
   $Username = "root";
   $pass = "";
   $database = "admindb";

   $conn = mysqli_connect($Servername,$Username,$pass,$database);
   if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
   }  

   if(!isset($_POST['searchTerm'])) { 
    $fetchData = mysqli_query($conn,"SELECT * from users order by user limit 5");

   }else { 
    $search = $_POST['searchTerm'];   
    $fetchData = mysqli_query($conn,"SELECT * from users where user like '%".$search."%' limit 5");
   } 

   $data = array();
   while ($row = mysqli_fetch_array($fetchData)) {    
    $data[] = array("id"=>$row['id'], "text"=>$row['user']);
   }
   echo json_encode($data);
