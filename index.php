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
                
                .grey {color:#696969;width:90%;padding:10px;border:solid 1px;border-color:#E7E7E7;background-color:#F4F4F4;text-align:right;}
                .class_done {color:#828282; padding:5px;width:90%;border:solid 1px;border-color:#E7E7E7;background-color:#000000;text-align:right;}
                .done {color:#828282; padding:10px;width:90%;border:solid 1px;border-color:#E7E7E7;background-color:#000000;text-align:right;}
                .green {color:#99B81A;width:90%;border:solid 1px;border-color:#DDEAA8;padding:5px 5px 2px 5px;background-color:#FBFDF1;text-align:justify;}
                .red {color:#D98383;width:90%;border:solid 1px;border-color:#F9D5D5;padding:5px 5px 2px 5px;background-color:#FEF6F6;text-align:justify;}
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
        <table align='center' style="width:100%">
            <tr>
                <td>
                    <div id="container">
                        <ul class="menu">
                            <li><a href="index.php" title="index" class="current">INDEX</a></li>
                            <li><a href="timetable.php" title="timetable">TIME</a></li>
                            <li><a href="book_info.php" title="bookinfo">BOOK</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="width=90%" align='center'>
                        <?php
                            $kday=array("일", "월", "화", "수", "목", "금", "토");
                            $wday=date("w", (time()+(46800)));
                            $currenttime = date("H", (time()+56800));
                            echo '<center style="font-weight:bold;">TODAY('.$kday[$wday].')</center>';
                            
                            $color_map["컴퓨터네트워크"] = "green";
                            $color_map["운영체제"] = "red";
                            $color_map["프로그래밍언어"] = "purple";
                            $color_map["소프트웨어공학"] = "blue";
                            $color_map["데이타베이스"] = "blue-green";
                            $color_map["마이크로프로세서"] = "green-blue";
                            $color_map[""] = "grey";
                            $period_map = array("s0900", "s1000", "s1100", "s1200", 
                                          "s1300", "s1400", "s1500", "s1600", "s1700", "s1800");
                            for($i=0;$i<10;$i++){
                                $time_map[$period_map[$i]]=($i+9);
                            }
                            
                            $ip=getenv("REMOTE_ADDR");
                            $dbc=mysqli_connect($ip, 'meshabber', '', 'c9') 
                            or die('Err Connecting to MYSQL server.');
                        
                            $query="SELECT * FROM weekschedule WHERE day='$kday[$wday]'";
                            $result=mysqli_query($dbc, $query);
                            $input=mysqli_fetch_array($result);
                            
                            for($i=0;$i<10;$i++){
                                $div_class=$color_map[$input[$period_map[$i]]];
                                $class_name=$input[$period_map[$i]];
                                if($currenttime > $time_map[$period_map[$i]]){
                                    if($class_name != null)
                                        $div_class="class_done";
                                    else
                                        $div_class="done";
                                }
                                echo '<div class="'.$div_class.'">'.$class_name.
                                     
                                     
                                     '</div>';
                            }
                            echo '<br />';
                            
                        ?>
                    </div>
                    <div class="line">
                        <?php
                            $query="SELECT busnum FROM busschedule";
                            $result=mysqli_query($dbc, $query) or die('DB Err');
                            $numberofbook=0;
                            while($input=mysqli_fetch_array($result)){ $numberofbook++; }
                            
                            $query="SELECT name, page, currentpage FROM bookinfo";
                            $result=mysqli_query($dbc, $query) or die('DB Err');
                            
                            $i=0;
                            $values[$numberofbook][2];
                            while($input=mysqli_fetch_array($result)){
                                $values[$i][0]=$input['name'];
                                $values[$i][1]=(int)(($input['currentpage']/$input['page'])*100);
                                $i++;
                            }
                            $columns = count($values);
                            for($i=0;$i<$columns;$i++){
                                echo '<div style="font-size:10px; font-weight:bold;">'.$values[$i][0].'</div>';
                                echo '<div class="graph" style="width:'.$values[$i][1].'%">'.$values[$i][1].'%</div><br />';
                            }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>