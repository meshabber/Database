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
                .clsMain { height : 595px; position:absolute; top:80px;}
                
                select { width:193px; box-sizing:border-box; }
                label { display:inline-block; width:50px; text-align:right; }
                input { width:155px; box-sizing:border-box; border:1px solid #999; }
                input:focus { border-color: #000; }
                button { margin-left:.5em; }    
        </style>
    </head>
    
    <body>
        <table align='center' class='main'>
            <tr class="clsHead">
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.php" title="index">INDEX</a></li>
                            <li><a href="insert.php" title="insert">INSERT</a></li>
                            <li><a href="book_info.php" title="bookinfo" class="current">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr class="clsMain">
                <td>
                    <div>
                        <form method="post" action="book_info.php">
                            <select name="booklist">
                                <?php
                                    $ip = getenv("REMOTE_ADDR");
                                	$dbc = mysqli_connect($ip, 'meshabber', '', 'c9')
                                	or die('Err Connecting to MYSQL server.');
                                    
                                	$query = "SELECT name FROM bookinfo";
                                	$result = mysqli_query($dbc, $query);
                                	
                            	    echo '<option>--select books--</option>';
                                	while($booknames = mysqli_fetch_array($result)){
                                	    echo '<option value="'.$booknames["name"]. '">'.$booknames["name"].'</option>';
                                	}
                                ?>
                            </select>
                        	<button type="submit" name="submit">submit</button>
                        </form>
                    </div>
                    <div style="width:90%; padding:10px; border:3; border-style:solid; border-color:#EBEBEB; overflow:auto">
                        <?php
                            if(isset($_POST['submit'])){ // select booklist
                            	
                                if($_POST['booklist'] == null || $_POST['booklist'] == "--select books--");
                                else{
                                    $Name = $_POST['booklist'];
                                    $query = "SELECT * FROM bookinfo WHERE name='$Name'";
                                    $result = mysqli_query($dbc, $query);
                                    $input = mysqli_fetch_array($result);
                                    
                                    echo '<form method="post" action="book_info.php">';
                                        echo '</br><label for="name">제목&nbsp</label>';
                                        echo '<input type="text" id="name" name="name" disabled="disabled" value="'.$input["name"].'"/> <br/> ';
                    
                                        echo '<label for="writer">저자&nbsp</label>';
                                        echo '<input type="text" id="writer" name="writer" value="'.$input["writer"].'"/> <br/>';
                    
                                        echo '<label for="date">시작일</label>';
                                        echo '<input type="date" id="rstart" name="rstart"  value="'.$input["rstart"].'"/> <br/>';
                    
                                        echo '<label for="publisher">출판사</label>';
                                        echo '<input type="text" id="publisher" name="publisher" value="'.$input["publisher"].'"/> <br/>';
                                        	
                                        echo '<label for="allpage">페이지</label>';
                                        echo '<input type="text" id="allpage" name="allpage"/> </br></br>';
                                        
                                        echo '<center>';    
                                        echo '<button type="submit" name="mody" value="'.$Name.'">apply</button>';
                                        echo '<button type="submit" name="del" value="'.$Name.'">delete</button>';
                                        echo '</center>';    
                                   // echo '<input type="hidden" name="auth" value="'.$Name.'"/>';
                                    echo '</form>';
                                }    
                            }
                            if(isset($_POST['del'])){ // delete();
                                $Name = $_POST['del'];
                                $query = "DELETE FROM bookinfo WHERE name='$Name'";
                                $result = mysqli_query($dbc, $query) or die('DB Err');
                                echo $Name.'을 삭제하였습니다';
    
                                mysqli_close($dbc);
                            }
                            else if(isset($_POST['mody'])){ // adjust();
                                $Name = $_POST['mody'];
                                
                                if(isset($_POST['submit']) == false);
                                    
                            	$Writer = $_POST['writer'];
                            	$Date = date("Y-m-d", strtotime($_POST['rstart']));
                            	$Publisher = $_POST['publisher'];
                                    
                            	if($Writer == null|| $Date == null || $Publisher == null){
                            	    echo '항목을 전부 채워주세요';
                            	}
                            	else{
                                	$query = "UPDATE bookinfo SET writer='$Writer', rstart='$Date', publisher='$Publisher' WHERE name='$Name'";
                                	$result = mysqli_query($dbc, $query) or die('DB update Err');
                                	echo $Name.'업데이트 하였습니다';
                        
                                    mysqli_close($dbc);
                                }
                            }
                        ?> 
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>