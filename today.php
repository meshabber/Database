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
                
                .grey {color:#696969;width:90%;padding: 10px 2px 10px 10px;border:solid 1px;border-color:#E7E7E7;background-color:#F4F4F4;text-align:right;}
                .class_done {color:#828282; padding:5px;width:90%;border:solid 1px;border-color:#E7E7E7;background-color:#000000;text-align:right;}
                .done {color:#828282; padding: 10px 2px 10px 10px;width:90%;border:solid 1px;border-color:#E7E7E7;background-color:#000000;text-align:right;}
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
                    <div class="line" align='center'>
                        <?php
                            $period_map = array("s0900", "s1000", "s1100", "s1200", 
                                          "s1300", "s1400", "s1500", "s1600", "s1700", "s1800");
                            for($i=0;$i<10;$i++){
                                if(isset($_POST[$i]))
                                    echo $i;
                            }
                            
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>