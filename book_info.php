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
                .main { width:480px; height:640px; margin:0px;}
                .clsHead { height : 45px; }
                .clsMain { height : 595px; position:absolute; top:80px;}
            select { width:150px; box-sizing:border-box; }
        </style>
    </head>
    
    <body>
        <table align='center' class='main'>
            <tr class="clsHead">
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.html" title="index">INDEX</a></li>
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
                            <input type="submit" value="submit">
                        </form>
                    </div>
                    <div>percent</div>
                    <div style="width:108%; padding:10px; border:3; border-style:solid; border-color:#EBEBEB; overflow:auto">
                        <?php
                          
                            if($_POST['booklist'] == null || $_POST['booklist'] == "--select books--");
                            else{
                                $Name = $_POST['booklist'];
                                $query = "SELECT * FROM bookinfo WHERE name='$Name'";
                                $result = mysqli_query($dbc, $query);
                                $input = mysqli_fetch_array($result);
                                
                                echo '제목:   '.$input["name"].'</br>';
                                echo '저자:   '.$input["writer"].'</br>';
                                echo '시작일: '.$input["rstart"].'</br>';
                                echo '출판사: '.$input["publisher"].'</br></br>';
                                echo '<form method="post" action="book_info.php">';
                                echo '<button type="submit" name="del" value="'.$Name.'">delete</button>';
                                echo '<button type="submit" name="mody" value="'.$Name.'">modify</button>';
                               // echo '<input type="hidden" name="auth" value="'.$Name.'"/>';
                                echo '</form>';
                            }    
                            if(isset($_POST['del'])){
                                $Name = $_POST['del'];
                                $query = "DELETE FROM bookinfo WHERE name='$Name'";
                                $result = mysqli_query($dbc, $query) or die('DB Err');
                                echo $Name.'을 삭제하였습니다';
                            }
                            else if(isset($_POST['mody'])){
                                
                            }
                            
                        ?> 
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>