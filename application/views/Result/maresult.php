<?php
/*define('MSG_NO_ACCESS_INDEX', '<img src="assets/img/noaccess.jpg" style="width:100%;  height: 100%;">');
error_reporting (0 )    ;
$acceptedDomains = array('bisegrw.com','google.com.pk','google.com','yahoo.com','www.bisegrw.com');
// print_r($_SERVER['HTTP_REFERER'])  ;
if($_SERVER['HTTP_REFERER'] != null)
{
$referer=get_domain($_SERVER['HTTP_REFERER']);
if(!$referer || !in_array($referer,$acceptedDomains))
{
header('HTTP/1.0 403 Forbidden');
exit(MSG_NO_ACCESS_INDEX);
}
}
function get_domain($url)
{
$pieces = parse_url($url);
$domain = isset($pieces['host']) ? $pieces['host'] : '';
if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) 
{
return $regs['domain'];
}
return false;
} */           

date_default_timezone_set('Asia/Karachi');
$hour = 14; 
$minute = 57; 
$month = 7; 
$day = 9; 
$year = 2017; 
$event = 'Christmas'; 

$remaining = date('U', mktime($hour, $minute, 0, $month, $day, $year)) - date('U'); 

$days = floor($remaining / 60 / 60 / 24); 
$hours = $remaining / 60 / 60 % 24; 
$minutes = $remaining / 60 % 60; 
$seconds = $remaining % 60; 


?>

<html lang="en"><!--
    <![endif]--><head>
        <meta charset="utf-8">
        <title>
            BISE GRW - BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- bootstrap css -->

        <link href="<?php echo base_url(); ?>assets/rescss/icomoon/styleprivateslip.css" rel="stylesheet">   
        <link href="<?php echo base_url(); ?>assets/rescss/icomoon/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/rescss/styles.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/rescss/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

        <!--[if lte IE 7]>
        <script src="css/icomoon-font/lte-ie7.js">
        </script>
        <![endif]-->
        <style type="">
            #data-table_length label, .dataTables_filter  label{
                color: #333 !important;
            }
        </style>
    </head>
    <body style="background-color: white !important;">                               





        <div class="left-sidebar">
            <div id="header">
                <div class="inHeaderLogin">
                    <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 22%;" src="<?php echo base_url(); ?>assets/img/icon.png" alt="Logo BISE GRW"></a>
                    <!--Intimation-->
                    <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 8px;float: left;  margin-top:55px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> <?= CURRENT_SESS_YEAR?> </p>
                </div>
            </div> 

            <div style="width: 60%; margin: 60px 235px 0 auto;" id="cnthide">
                <div id="yEa" >





                </div>
            </div>
            <!--<a href="http://results.bisegrw.com/" target="_blank" style="    margin-left: 829px;margin-top: 5px;float: left;font-size: 25px;font-weight: bold;"> Result Link 2</a>-->
            <a href="http://results.bisegrw.com/" target="_blank" style="margin-left: 46%;;margin-top: 5px;float: left;font-size: 25px;font-weight: bold;" style="display: none;" id="secondlink"> Result Link 2</a>
            <div id="page" class="countdown" style="display: none;">

                <div style="  color: #246785;font-size: 20px;    text-align: center;margin-bottom: 1px;margin-left: 27px;margin-top: 48px;"> Gazette & CD Password: <b style="color: red;font-size: 22px;" >grwbise_11th</b></div>
                <div style="width: 422px;float: left;">

                    <form id="searchForm"  class="searchForm" method="post">
                        <fieldset>

                            <!--  <img src="<?php echo base_url(); ?>assets/img/1_pointing.gif" width="70" height="70" style="margin-top: -72px;margin-left: 50px;float: left;">-->
                            <p style="margin-top: -34px;margin-left: 8px;float: left;color:wheat;font-size:20px;">Search by Roll No</p>
                            <input name="keyword" type="text" required="required" id="rno" class="s" maxlength="6" value="<?php if(@$callback['check'] == 2) echo @$callback['keyword']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onclick="setboxval(2);">

                            <input type="submit" value="Submit" id="submitButton">
                            <input type="hidden" id="ischeck" value="<?= @$callback['check']?>">

                            <div id="searchInContainer">
                                <input type="hidden" name="check" value="2" id="searchSite" class="radio-button" >

                            </div>



                        </fieldset>
                    </form>
                </div>
                <!-- <input id="btn-print" type="button" value="Print" style="width: 86px;
                height: 31px;
                color: black;
                font-size: 20px;" /> -->
                <div style="width: 422px;float: left;    margin-left: 28px;">

                    <form id="searchForm1" class="searchForm"  method="post">
                        <fieldset>

                            <!--  <img src="<?php echo base_url(); ?>assets/img/1_pointing.gif" width="70" height="70" style="margin-top: -72px;margin-left: 50px;float: left;">-->
                            <p style="margin-top: -34px;margin-left: 8px;float: left;color:wheat;font-size:20px;">Search by Institute Code</p>
                            <input name="keyword" type="text" required="required" id="inst" class="s" maxlength="6" value="<?php if(@$callback['check'] == 3) echo @$callback['keyword']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onclick="setboxval(1);">

                            <input type="submit" value="Submit" id="submitButton">
                            <input type="hidden" id="ischeck" value="<?= @$callback['check']?>">

                            <div id="searchInContainer">

                                <input type="hidden" name="check" value="3" id="searchIns" class="radio-button"> 
                            </div>



                        </fieldset>
                    </form>
                </div>
                <div id="resultsDiv" style="margin-bottom: 40px;min-height: 473px;">

                    <?php 
                    // DebugBreak();
                    // echo  $callback['check'];
                    if(@$isfound == -1)
                    {
                        echo "<p style='color: red;font-size: 24px;font-weight: bold;text-align: center;margin-bottom: 20px;'>Record Not Found. Please Enter Valid Roll Numnber/Institute Code.</p>";
                    }
                    else if(@$isfound == -2)
                    {
                        echo "<p style='color: red;font-size: 24px;font-weight: bold;text-align: center;margin-bottom: 20px;'>Result Will be declared 10:10 A.M</p>";
                    }

                    else if( @$callback['check'] ==2 && MCLASS == 10)
                    {
                        //DebugBreak();
                        include "ma10presult.php";  
                    }
                    else if( @$callback['check'] ==2 && MCLASS == 9)
                    {
                        //  DebugBreak();
                        include "ma9presult.php";  
                    }
                    else if( @$callback['check'] ==2 && MCLASS == 11)
                    {
                        //  DebugBreak();
                        include "ia11presult.php";  
                    }
                    else if( @$callback['check'] ==2 && MCLASS == 12)
                    {
                        //  DebugBreak();
                        include "ia12presult.php";  
                    }
                    ?>





                    <?php  if ( @$callback['check'] ==1 || @$callback['check'] ==3)
                    {    ?>
                        <table class="table table-condensed table-striped table-hover table-bordered pull-left" border="1" id="data-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">
                                        Roll No.
                                    </th>
                                    <th style="width:15%">
                                        Name
                                    </th>
                                    <th style="width:15%">
                                        Father's Name
                                    </th>
                                    <th style="width:15%">
                                        Result
                                    </th>
                                    <th style="width:13%" class="hidden-phone">
                                        View Result
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // DebugBreak();

                                if(@$result!= false)
                                {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($Inst_Cd = $result as $key=>$vals):
                                        $n++;
                                        //$formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                        $resdata = '' ;
                                        if($vals['Class'] == 12 || $vals['Class'] == 10)
                                        {
                                            if($vals['status'] == 2)
                                            {
                                                if($vals['result1'] != '')
                                                {
                                                    $resdata = 'Part1: '.$vals['result1']  ;
                                                }
                                                if($resdata != '')
                                                {
                                                    $resdata.=  ', Part2: '. $vals['result2'];   
                                                }
                                                else
                                                {
                                                    $resdata =  'Part2: '. $vals['result2'];  
                                                }

                                            }
                                            else
                                            {
                                                $resdata =   $vals['result2'];
                                            }
                                        }
                                        else if($vals['Class'] == 11 || $vals['Class'] == 9)
                                        {
                                            $resdata =  $vals['result1'];  
                                        }
                                        echo '<tr  >
                                        <td style="width: 5%;">'.$vals['RNo'].'</td>
                                        <td style="width:15%">'.$vals['Name'].'</td>
                                        <td style="width:15%">'.$vals['Fname'].'</td>
                                        <td style="width:15%">'.$resdata.'</td>
                                        <td style="width:13%" class="hidden-phone"> <button type="button" class="btn-info" style="height: 32px;width: 107px;font-size: 17px;font-weight: bold;"  value="'.$vals['RNo'].'" onclick="Result_Print('.$vals['RNo'].')">View Result</button></td></tr>';
                                        endforeach;
                                }
                                ?>
                            </tbody>
                        </table>


                        <?php  }
                    ?>
                    <div style="width: 880;background-color: #4C5A65;    display: table-cell;    color: #DDDDDD;     -moz-border-radius: 16px;     -webkit-border-radius: 16px;  height: 90px;   font-size: 23px;  margin-top: 0px;vertical-align: middle;text-align: center;" >
                        You can also check detailed result by sending Roll No. to <b>800299 </b>through SMS   <br/></div>
                </div>

            </div>



            <div id="header" class="headershow" style=" position: absolute;left: 50%;transform: translate(-50%, -50%);margin: 0 auto;display: none;">


                <div class="inFooterLogin">
                    <div id="copyright" style="    color: wheat;font-size: 16px;padding-top: 20px;text-align: center;">
                        © 2016 <a href="http://www.bisegrw.com/home.php"  style="color: wheat;">www.bisegrw.com</a> | Powered by Bisegrw  Development Team 
                    </div>
                </div>
            </div> 
        </div>
        <!--/.fluid-container-->
        <a href="http://www.bisegrw.com/home.php" target="blank" style="position: fixed; border: none; text-decoration: none; width: 30px; height: 74px; right: 0px; top: 55px; display: block; overflow: hidden; background: url(&quot;assets/img/silver.png&quot;) 0% 0% no-repeat;"></a>

        <script src="<?php echo base_url(); ?>assets/resjs/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/resjs/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/resjs/script.js"></script>
        <script src="<?php echo base_url(); ?>assets/resjs/bttz.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/resjs/jquery.dataTables.js"></script>

        <script type="text/javascript"> 
           
             $('#cnthide').show();
            $('#secondlink').hide();
            $('.headershow').hide();
            $('#page').hide();   
          
           
            var days = '<?php echo $days; ?>'; 
            var hours = '<?php echo $hours; ?>'; 
            var minutes = '<?php echo $minutes; ?>'; 
            var seconds = '<?php echo $seconds; ?>'; 
            var finished = false; 
            var zerotxtm = ''
            var zerotxts = ''
            function updatecountdown(){ 
                 zerotxtm = ''
                 zerotxts = ''
                seconds--; 
                if(seconds < 0){ 
                    seconds = 59; 
                    minutes--; 
                    if(minutes < 0){ 
                        minutes = 59; 
                        hours--; 
                        if(hours < 0){ 
                            hours = 23; 
                            days--; 
                            if(days < 0){ 
                                finished = true; 
                            } 
                        } 
                    } 
                } 

                if(!finished){ 
                    var message = days + ' days<br />'; 
                    message += hours + ' hours<br />'; 
                    message += minutes + ' minutes<br />'; 
                    message += seconds + ' seconds<br />'; 
                    message += 'until <?php echo $event; ?>!'; 
                  //  document.getElementById('countdown').innerHTML = message; 
                  
                  if(minutes >=0 && minutes<=9)
                  {
                      zerotxtm = 0;
                  }
                  if(seconds >= 0 && seconds<= 9)
                  {
                     zerotxts = 0
                  }
                     $('#yEa').html('<span style="color:#003399;font-family:arial,sans-serif;font-size:280px;font-weight:bold">'+zerotxtm+minutes+'<span style="color:#cccccc;position:relative;top:-33px">:</span>'+zerotxts+seconds+'</span>');
                      $('#secondlink').hide();
                     $('.headershow').hide();
                     $('#page').hide();   
                    
                } 
                else{ 
                     $('#cnthide').hide();
                     $('#secondlink').show();
                     $('.headershow').show();
                     $('#page').show();   
                     clearInterval(theInterval); 
                } 
            } 
            var theInterval = setInterval("updatecountdown()", 1000); 
        </script>


        <script type="text/javascript">


            $("input").keypress(function(event) {
                if (event.which == 13) {
                    event.preventDefault();
                    var rno = $('#rno').val()
                    var inst = $('#inst').val()
                    if(rno != '')
                    {
                        $("#searchForm").submit();  
                    }
                    else if(inst != '')
                    {
                        $("#searchForm1").submit();    
                    }

                }
            });


            $(document).ready(function () {
                $('#data-table').dataTable({
                    "sPaginationType": "full_numbers",
                    "cache": false,
                    "pageLength": 25
                });   
            });
            $("#btn-print").live("click", function () {
                var divContents = $("#printres").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write('<html><head><title>12th (Annual) Examination, 2016</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });

            $(document).bind("keyup keydown", function(e){
                if(e.ctrlKey && e.keyCode == 80){
                    var divContents = $("#resultsDiv").html();
                    var printWindow = window.open('', '', 'height=400,width=800');
                    printWindow.document.write('<html><head><title>12th (Annual) Examination, 2016</title>');
                    printWindow.document.write('</head><body >');
                    printWindow.document.write(divContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                }
            });
            function Result_Print(rno)
            {
                var win = window.open('<?=base_url()?>index.php/Result/Result_Print_datagrid/'+rno, '_blank');
                win.focus();
            }
            function setboxval(info)
            {
                //  alert(info)
                if(info == 1)
                {
                    $('#rno').val('') 

                }
                else if(info == 2)
                {
                    $('#inst').val('')
                }
            }        
        </script> 
    </body>
</html>