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
                .menu a.current { color:#2E4560; background:#fff; }
                .menu a.current:hover { color:#2E4560; background:#fff; }
            table
                .main { width:480px; height:640px; margin:0;}
                .clsHead { height : 45px; }
                .clsMain { height : 595px; position:absolute; top:80px; }
                
                label { display:inline-block; width:50px; text-align:right; }
                input { width:155px; box-sizing:border-box; }
                .button { padding-left:5px; margin-left:.5em; }    
        </style>
    </head>
    
    <body>
        <table align='center' class='main'>
            <tr class="clsHead">
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.html" title="index">INDEX</a></li>
                            <li><a href="insert.php" title="insert" class="current">INSERT</a></li>
                            <li><a href="book_info.php" title="bookinfo">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr class="clsMain">
                <td>
                    <div style="width:96%; height:180px; padding:10px; border:3; border-style:solid; border-color:#EBEBEB; overflow:auto">
                        <form method="post" action="./insert.php">
                        	<label for="name">제목</label>
                        	<input type="text" id="name" name="name"/> <br/> 
    
                         	<label for="writer">저자</label>
                        	<input type="text" id="writer" name="writer"/> <br/>
    
                        	<label for="date">시작일</label>
                        	<input type="date" id="rstart" name="rstart"/> <br/>
    
                        	<label for="publisher">출판사</label>
                        	<input type="text" id="publisher" name="publisher"/> <br/>
                        	
                        	<label for="allpage">페이지</label>
                            <input type="text" id="allpage" name="allpage"/> <br/>

                        	<button type="submit" name="submit">추가</button><br/>
                        </form>
                    </div>
                    <div>
                            <?php
                        	    $Name = $_POST['name'];
                            	$Writer = $_POST['writer'];
                            	$Date = date("Y-m-d", strtotime($_POST['rstart']));
                            	$Publisher = $_POST['publisher'];
                                $ip = getenv("REMOTE_ADDR"); 
                            
                            	$dbc = mysqli_connect($ip, 'meshabber', '', 'c9')
                            	or die('Err Connecting to MYSQL server.');
                            
                            	if($Name == null || $Writer == null|| $Date == null || $Publisher == null){
                            	    echo '</br>항목을 전부 채워주세요';
                            	    mysqli_close($dbc);
                            	}
                            	else{
                                	$query = "INSERT INTO bookinfo values ('$Name', '$Writer', '$Date', '$Publisher')";
                                	$result = mysqli_query($dbc, $query)
                                	or die();
                        
                                	mysqli_close($dbc);
                            	}
                        	?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>