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
                .menu li { display:block; float:left; margin:0 0 0 5%; height:27px; }
                .menu li.left { margin:0; }
                .menu a {
                    display:block; float:left; color:#fff; background:#4A6867; line-height:27px;
                    text-decoration:none; padding:0 17px 0 18px; height:27px;
                }
                .menu a.right { padding-right:19px; }
                .menu a:hover { background:#2E4560; }
                .menu a.current { color:#2E4560; background:#fff; }
                .menu a.current:hover { color:#2E4560; background:#fff; }
                
                .line { width:90%; padding:10px; border:3; border-style:solid; border-color:#EBEBEB; overflow:auto; }
    
                select { width:73%; box-sizing:border-box; }
                label { display:inline-block; width:25%; text-align:right; }
                input { width:73%; box-sizing:border-box; border:1px solid #999; }
                input:focus { border-color: #000; }
        </style>
        <script type="text/javascript">
            window.addEventListener('load', function() {
                setTimeout(scrollTo, 0, 0, 1);
            }, false);
            function input_alert(){
                alert("항목을 전부 채워주세요.");
            }
        </script>
    </head>
    
    <body>
        <table align='center' style="width:100%">
            <tr>
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.php" title="index">INDEX</a></li>
                            <li><a href="timetable.php" title="timetable">TIME</a></li>
                            <li><a href="book_info.php" title="bookinfo" class="current">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
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
                                	
                            	    echo '<option>--insert book--</option>';
                                	while($booknames = mysqli_fetch_array($result)){
                                	    echo '<option value="'.$booknames["name"]. '">'.$booknames["name"].'</option>';
                                	}
                                ?>
                            </select>
                        	<button type="submit" name="submit">submit</button>
                        </form>
                    </div>
                    <div class="line">
                        <?php
                            if(isset($_POST['submit'])){ // select list
                            	
                                if($_POST['booklist'] == "--insert book--"){
                                    echo '<form method="post" action="book_info.php">';
                                        echo '</br><label for="name">제목&nbsp</label>';
                                        echo '<input type="text" id="name" name="name"/> <br/> ';
                    
                                        echo '<label for="writer">저자&nbsp</label>';
                                        echo '<input type="text" id="writer" name="writer"/> <br/>';
                    
                                        echo '<label for="date">시작일</label>';
                                        echo '<input type="date" id="rstart" name="rstart"/> <br/>';
                    
                                        echo '<label for="publisher">출판사</label>';
                                        echo '<input type="text" id="publisher" name="publisher"/> <br/>';
                                        	
                                        echo '<label for="allpage">페이지</label>';
                                        echo '<input type="text" id="allpage" name="allpage"/> </br></br>';
                                        
                                        echo '<center>';    
                                        echo '<button type="submit" name="insert" value="insert">apply</button>';
                                        echo '<button type="reset" name="reset">cancel</button>';
                                        echo '</center>';    
                                    echo '</form>';
                                }
                                else{
                                    $Name = $_POST['booklist'];
                                    $query = "SELECT * FROM bookinfo WHERE name='$Name'";
                                    $result = mysqli_query($dbc, $query);
                                    $input = mysqli_fetch_array($result);
                                    
                                    echo '<form method="post" action="book_info.php">';
                                        echo '</br><label for="name">제목&nbsp</label>';
                                        echo '<input type="text" id="name" name="name" disabled="disabled" value="'.$input["name"].'"/> <br/> ';
                    
                                        echo '<label for="writer">저자&nbsp</label>';
                                        echo '<input type="text" id="writer" name="writer" value="'.$input["author"].'"/> <br/>';
                    
                                        echo '<label for="date">시작일</label>';
                                        echo '<input type="date" id="rstart" name="rstart"  value="'.$input["startday"].'"/> <br/>';
                    
                                        echo '<label for="publisher">출판사</label>';
                                        echo '<input type="text" id="publisher" name="publisher" value="'.$input["publisher"].'"/> <br/>';
                                        	
                                        echo '<label for="allpage">페이지</label>';
                                        echo '<input type="text" id="allpage" name="allpage" value="'.$input["page"].'"/> </br></br>';
                                        
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
                            	$Writer = $_POST['writer'];
                            	$Date = date("Y-m-d", strtotime($_POST['rstart']));
                            	$Publisher = $_POST['publisher'];
                            	$Page = $_POST['allpage'];
                                    
                            	if($Writer == null|| $Date == null || $Publisher == null || $Page == null){
                            	    echo '<script type="text/javascript"> input_alert(); </script>';
                            	    mysqli_close($dbc);
                            	}
                            	else{
                                	$query = "UPDATE bookinfo SET author='$Writer', startday='$Date', publisher='$Publisher', page=$Page WHERE name='$Name'";
                                	$result = mysqli_query($dbc, $query) or die('DB update Err');
                                	echo $Name.'업데이트 하였습니다';
                        
                                    mysqli_close($dbc);
                                }
                            }
                            else if(isset($_POST['insert'])){ //insert
                                $Name = $_POST['name'];
                            	$Writer = $_POST['writer'];
                            	$Date = date("Y-m-d", strtotime($_POST['rstart']));
                            	$Publisher = $_POST['publisher'];
                            	$Page = $_POST['allpage'];
                            	$Curpage = 0;
                                    
                            	if($Name == null || $Writer == null|| $Date == null || $Publisher == null){
                            	    echo '<script type="text/javascript"> input_alert(); </script>';
                            	    mysqli_close($dbc);
                            	}
                            	else{
                            	    $ip = getenv("REMOTE_ADDR");
                                	$dbc = mysqli_connect($ip, 'meshabber', '', 'c9')
                                	or die('Err Connecting to MYSQL server.');
                                    
                                	$query = "INSERT INTO bookinfo values ('$Name', '$Writer', '$Date', '$Publisher', $Page, $Curpage)";
                                	$result = mysqli_query($dbc, $query)
                                	or die('DB insert Err');
                        
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