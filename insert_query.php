<html>
    <head>
        <title>노래추가</title>
    </head>
    
    <body>
        <?php
        
            $ip = getenv("REMOTE_ADDR"); 
        
        	$Name = $_POST['name'];
        	$Writer = $_POST['writer'];
        	$Date = date("Y-m-d", strtotime($_POST['rstart']));
        	$Publisher = $_POST['publisher'];
        
        	$dbc = mysqli_connect($ip, 'meshabber', '', 'c9')
        	or die('Err Connecting to MYSQL server.');
        
        	$query = "INSERT INTO bookinfo values ('$Name', '$Writer', '$Date', '$Publisher')";
        
        	$result = mysqli_query($dbc, $query)
        	or die('Err Querying database.');
        
        	echo '추가되었습니다.';
        
        	mysqli_close($dbc);
        
        ?>
    </body>

</html>