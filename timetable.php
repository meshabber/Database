<html>
    <head>
      <title> INDEX </title>
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width">
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
                .table_css { font_family:sans-serif; text-align:center; 
                            border:1; border-style:solid gray; cellpadding:5; cellspacing:0;}    
                select { width:73%; box-sizing:border-box; }
                label { display:inline-block; width:25%; text-align:right; }
                input { width:70%; box-sizing:border-box; border:1px solid #999; }
                input:focus { border-color: #000; }
    
        </style>
        <script type="text/javascript">
            window.addEventListener('load', function() {
                setTimeout(scrollTo, 0, 0, 1);
            }, false);
        </script> 
    </head>
    
    <body>
        <table align='center' style="width:100%">
            <tr>
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.php" title="index">INDEX</a></li>
                            <li><a href="timetable.php" title="timetable" class="current">TIME</a></li>
                            <li><a href="book_info.php" title="bookinfo">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <form method="post" action="timetable.php">
                            <select name="timetable">
                                <option value="Week">Week</option>
                                <option value="BUS">BUS</option>
                            </select>
                        	<button type="submit" name="submit">submit</button>
                        </form>
                    </div>
                    <div class="line">
                        <?php
                            if(isset($_POST['submit'])){
                                $ip=getenv("REMOTE_ADDR");
                                $dbc=mysqli_connect($ip, 'meshabber', '', 'c9')
                                or die('Err Connecting to MYSQL server.');
                                
                                switch($_POST['timetable']){
                                    case "Week":
                                        $kday=array("월", "화", "수", "목", "금");
                                        $wkey=array("s0900", "s1000", "s1100", "s1200", "s1300",
                                                    "s1400", "s1500", "s1600", "s1700", "s1800");    
                                        for($i=0;$i<5;$i++){
                                            $query="SELECT * FROM weekschedule WHERE day='$kday[$i]'";
                                            $result=mysqli_query($dbc, $query) or die('DB Err');
                                            while($input=mysqli_fetch_array($result)){
                                                for($j=0;$j<10;$j++){
                                                    $period[$i][$j]=$input[$wkey[$j]];
                                                }
                                            }
                                            
                                        }
                                        echo '<table border="1" class="table_css" style="font-size:8px; width:100%;">
                                              <tr>
                                              <td></td><td>월</td><td>화</td><td>수</td><td>목</td><td>금</td>
                                              </tr>
                                            ';
                                        for($line=0;$line<10;$line++){
                                            echo '<tr>';
                                            echo '<td>'.($line+1).'</td>';
                                            for($j=0;$j<5;$j++){
                                                echo '<td>'.$period[$j][$line].'</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                        mysqli_close($dbc);
                                        break;
                                        
                                    case "BUS":
                                        $query="SELECT busnum FROM busschedule";
                                        $result=mysqli_query($dbc, $query) or die('DB Err');
                                        $i=0;
                                        while($input=mysqli_fetch_array($result)){ $i++; }
                                        
                                        $query="SELECT * FROM busschedule";
                                        $result=mysqli_query($dbc, $query) or die('DB Err');
                                        for($k=0;$k<$i;$k++){
                                            $input=mysqli_fetch_array($result);
                                            for($j=0;$j<11;$j++){
                                                $period[$k][$j]=$input[$j];
                                            }
                                        }
                                        echo '<table border="1" class="table_css">';
                                        for($j=0;$j<11;$j++){
                                            echo '<tr>';
                                            for($k=0;$k<$i;$k++){
                                                echo '<td>'.$period[$k][$j].'</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                        mysqli_close($dbc);    
                                        break;
                                }
                            }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>