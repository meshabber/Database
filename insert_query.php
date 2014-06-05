<html>
    <head>
        <title> INDEX </title>
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, height=device-height">
        <style type="text/css">
            #container { padding:25px 15px 0 15px; background:#67A897;}
                .menu {
                    list-style-type:none; width:100%; position:relative; height:27px;
                    font-family:"Trebuchet MS", Arial, sans-serif; font-size:13px; font-weight:bold;
                    margin:0; padding:11px 0 0 0;
                }
                .menu li { display:block; float:left; margin:0 0 0 4px; height:27px; }
                .menu li.left { margin:0; }
                .menu a {
                    display:block; float:left; color:#fff; background:#4A6867; line-height:27px;
                    text-decoration:none; padding:0 17px 0 18px; height:27px;
                }
                .menu a.right { padding-right:19px; }
                .menu a:hover { background:#2E4560; }
                .menu a.currnt { color:#2E4560; background:#fff; }
                .menu a.currnt:hover { color:#2E4560; background:#fff; }
            table
                .main { width:480px; height:640px; margin:0px;}
                .clsHead { height : 45px; }
                .clsMain { height : 595px; }
        </style>
    </head>
    
    <body>
        <table align='center' class='main'>
            <tr class="clsHead">
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.html" title="index">INDEX</a></li>
                            <li><a href="insert.html" title="insert" class="current">INSERT</a></li>
                            <li><a href="bookingo.html" title="bookinfo">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr class="clsMain">
                <td>
                    <div>
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
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>