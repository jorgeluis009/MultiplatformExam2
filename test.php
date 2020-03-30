<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
    $Servername = "localhost";
    $Username = "root";
    $Password = "";
    $DBName = "admindb";

    $conn = mysqli_connect($Servername,$Username,$Password,$DBName);

    if(!$conn)
    {
        die("Fallo la conexion:". mysqli_connect_error());
    }

    $sql = "INSERT INTO users (user,pass) Values ('b','b')";

    if(mysqli_query($conn,$sql)){
        echo "Registro insertado correctamente...";
    }else{
        echo "Error ". $sql . "<br>" . mysqli_error();
    }

        mysqli_close($conn);

    ?>

</body>
</html>