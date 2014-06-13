<html>
    <head>
        <title> INDEX </title>
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, target-densitydpi=medium-dpi">
        <style type="text/css">
            #container { padding:25px 15px 0 15px; background:#67A897;}
                .menu {
                    list-style-type:none; width:100%; position:relative; height:27px;
                    font-family:"Trebuchet MS", Arial, sans-serif; font-size:13px; font-weight:bold;
                    margin:0; padding:11px 0 0 0;
                }
                .menu li { display:block; float:left; margin:0 0 0 5%; height:27px; }
                .menu a {
                    display:block; float:left; color:#fff; background:#4A6867; line-height:27px;
                    text-decoration:none; padding:0 17px 0 17px; height:27px;
                }
                .menu a:hover { background:#2E4560; }
                .menu a.current { color:#2E4560; background:#fff; }
                .menu a.current:hover { color:#2E4560; background:#fff; }
                
                .line { width:90%; padding:10px; border:3; border-style:solid; border-color:#EBEBEB; overflow:auto; align:center; }
                
                .grey {color:#696969;width:90%;padding:0.2px 5px 0.2px 5px; border:solid 1px;border-color:#E7E7E7;background-color:#F4F4F4;text-align:center;}
                .done {color:#828282; padding: 10px 2px 15px 10px;width:90%;border:solid 1px;border-color:#E7E7E7;background-color:#000000;text-align:right;}
                .green {color:#99B81A;width:90%;border:solid 1px;border-color:#DDEAA8;padding:5px 5px 2px 5px;background-color:#FBFDF1;text-align:center;}
                .red {color:#D98383;width:90%;border:solid 1px;border-color:#F9D5D5;padding:5px 5px 2px 5px;background-color:#FEF6F6;text-align:center;}
                .purple {color:#AF69C0;width:90%;border:solid 1px;border-color:#EFDAF4;padding:5px 5px 2px 5px;background-color:#FCF7FD;text-align:center;}
                .blue {color:#7381EA;width:90%;border:solid 1px;border-color:#DCDFF6;padding:5px 5px 2px 5px;background-color:#F6F7FE;text-align:center;}
                .blue-green {color:#619DAC;width:90%;border:solid 1px;border-color:#DAEAEE;padding:5px 5px 2px 5px;background-color:#F0F6F8;text-align:center;}
                .green-blue {color:#6FB587;width:90%;border:solid 1px;border-color:#D5EDDD;padding:5px 5px 2px 5px;background-color:#EFF9F2;text-align:center;}
                .yellow{color:#FF9900;width:90%;border:solid 1px;border-color:#FFEC15;padding:5px 5px 2px 5px;background-color:#FFFCDF;text-align:center;}
                .sky{color:#0A8DBD;width:90%;border:solid 1px;border-color:#9DD7E8;padding:5px 5px 2px 5px;background-color:#F8FDFF;text-align:center;}
                
                .graph { padding:1.5px; border-style:solid; border-color:#EBEBEB; background-color:#65C28E; font-size:10px;}
        </style>
        <script type="text/javascript">
            window.addEventListener('load', function() {
                setTimeout(scrollTo, 0, 0, 1);
            }, false);
        </script>
    </head>
    
    <body>
        <table align="center" style="width:100%">
            <tr>
                <td>
                    <div id="container">
                        <ul class="menu" align="center">
                            <li><a href="index.php" title="index" class="current">INDEX</a></li>
                            <li><a href="timetable.php" title="timetable">TIME</a></li>
                            <li><a href="book_info.php" title="bookinfo">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="line" align='center'>
                        <?php
                            $kday=array("일", "월", "화", "수", "목", "금", "토");
                            $wday=date("w", (time()+46800));
                            $currenttime = date("H:i", (time()+46800));
                            echo '<center style="font-weight:bold;">TODAY('.$kday[$wday].')</center>';
                            echo '<br />';
                            
                            $color_map["컴퓨터네트워크"] = "green";
                            $color_map["운영체제"] = "red";
                            $color_map["프로그래밍언어"] = "purple";
                            $color_map["소프트웨어공학"] = "blue";
                            $color_map["데이타베이스"] = "blue-green";
                            $color_map["마이크로프로세서"] = "green-blue";
                            $color_map[""] = "grey";
                            $period_map = array("s0900", "s1000", "s1100", "s1200", 
                                          "s1300", "s1400", "s1500", "s1600", "s1700", "s1800");
                            
                            $invert_time_map["s0900"] = "09:00";
                            $invert_time_map["s1000"] = "10:00";
                            $invert_time_map["s1100"] = "11:00";
                            $invert_time_map["s1200"] = "12:00";
                            $invert_time_map["s1300"] = "13:00";
                            $invert_time_map["s1400"] = "14:00";
                            $invert_time_map["s1500"] = "15:00";
                            $invert_time_map["s1600"] = "16:00";
                            $invert_time_map["s1700"] = "17:00";
                            $invert_time_map["s1800"] = "18:00";
                            
                            $ip=getenv("REMOTE_ADDR");
                            $dbc=mysqli_connect($ip, 'meshabber', '', 'c9') 
                            or die('Err Connecting to MYSQL server.');
                            
                            $query="DELETE FROM today WHERE day<$wday";
                            $result=mysqli_query($dbc, $query);
                            
                            $query="SELECT * FROM weekschedule WHERE day='$kday[$wday]'";
                            $result=mysqli_query($dbc, $query);
                            $input=mysqli_fetch_array($result);
                        
                            $today_query="SELECT DISTINCT period FROM today ORDER BY period ASC";
                            $today_result=mysqli_query($dbc, $query);
                            while($today_input = mysqli_fetch_array($today_result)){
                                $today_period[] = $today_input["period"];
                            }
                            
                            for($i=0;$i<10;$i++){
                                $div_class=$color_map[$input[$period_map[$i]]];
                                $class_name=$input[$period_map[$i]];
                                if($class_name == null){
                                    $class_name = '<button type="submit" style="width:100%;" name="'.$i.'">일정 보기</button>';
                                }
                                if($currenttime > $invert_time_map[$period_map[$i]]){
                                    $today_query="SELECT bookname, currentpage FROM today WHERE period='$period_map[$i]'";
                                    $today_result=mysqli_query($dbc, $query);
                                    while($today_input = mysqli_fetch_array($today_result)){
                                        $Curpage = $today_input["currentpage"];
                                        $BOOK = $todau_input["bookname"];
                                        if($Curpage == null) break;
                                        $query="UPDATE bookinfo SET currentpage=$Curpage WHERE bookname='$BOOK'";
                                        $result=mysqli_query($dbc, $query) or die('DB Update Err');
                                    }
                                    mysqli_query($dbc, "DELETE FROM today WHERE period='$period_map[$i]'") or die('DB ERR'); 
                                    
                                    $class_name = null;
                                    $div_class="done";
                                }
                                echo '<form method="post" action="index.php">';
                                echo '<div class="'.$div_class.'">'.$class_name.'</div>';
                            }
                            echo '<br />';
                            
                            for($i=0;$i<10;$i++){
                                if(isset($_POST[$i])){
                                    $query = "SELECT name FROM bookinfo";
                                	$result = mysqli_query($dbc, $query);
                                	
                                	$period = $period_map[$i];
                                    $query2 = "SELECT * FROM today where period='$period'";
                                	$result2 = mysqli_query($dbc, $query2);
                                	
                                    echo '<form method="post" action="index.php">
                                          <fieldset>
                                          <legend>'.$invert_time_map[$period_map[$i]].'</legend>';
                                    
                                    $time_use = 60;    
                                    while($today = mysqli_fetch_array($result2)){
                                        echo '<input type="text" disabled="disabled" value="'.$today["bookname"].'"/> ~ 
                                              <input type="text" disabled="disabled" style="width:10%" value="'.$today["page"].'"/>min<br />';
                                        $time_use = $time_use - $today["page"];
                                    }    
                                    
                                	if($time_use != 0){
                                        echo '<select name="booklist" style="width:65%">';	
                                    	while($booknames = mysqli_fetch_array($result)){
                                    	    echo '<option value="'.$booknames["name"]. '">'.$booknames["name"].'</option>';
                                    	}
                                    	echo '</select>
                                              ~ <input type="number" name="page" max="'.$time_use.'" min="1" value="1"/> 
                                              <input type="hidden" name="period" value="'.$period_map[$i].'"/> 
                                    	      <button type="submit" name="todaysubmit">submit</button>';
                                	} 
                                	echo '</fieldset>
                                	      </form>';
                                }
                            }    
                            
                            if(isset($_POST['todaysubmit'])){
                                $bookname = $_POST['booklist'];
                                $period = $_POST['period'];
                                $page = $_POST['page'];
                                $day = date("w", (time()+46800));
                                
                                $query="INSERT INTO today(bookname, period, page, day) values('$bookname', '$period', $page, $day)";
                                $result = mysqli_query($dbc, $query);
                            }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>