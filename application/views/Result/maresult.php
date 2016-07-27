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

        <link href="<?php echo base_url(); ?>assets/css/icomoon/styleprivateslip.css" rel="stylesheet">   
        <link href="<?php echo base_url(); ?>assets/css/icomoon/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/datatables.min.css" rel="stylesheet">
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
                    <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 25%;" src="<?php echo base_url(); ?>assets/img/icon.png" alt="Logo BISE GRW"></a>
                    <!--Intimation-->
                    <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 28px;float: left;  margin-top:55px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> Result SSC Annual 2016 </p>
                </div>
            </div> 
            <div id="page">
                <div style="">
                    <form id="searchForm" method="post">
                        <fieldset>

                            <img src="<?php echo base_url(); ?>assets/img/1_pointing.gif" width="70" height="70" style="margin-top: -72px;margin-left: 50px;float: left;">
                            <input name="keyword" type="text" required="required" id="s" value="<?= @$callback['keyword']?>">

                            <input type="submit" value="Submit" id="submitButton">
                            <input type="hidden" id="ischeck" value="<?= @$callback['check']?>">

                            <div id="searchInContainer">
                                <input type="radio" name="check" value="2" id="searchSite" class="radio-button">
                                <label for="searchSite" id="siteNameLabel">Search by Roll No</label>
                                <input type="radio" name="check" value="1" id="searchWeb" class="radio-button"> 
                                <label for="searchWeb">Search by Name</label>
                                <input type="radio" name="check" value="3" id="searchIns" class="radio-button"> 
                                <label for="searchIns">Search by Institute Code</label>
                            </div>



                        </fieldset>
                    </form>
                </div>
                <!-- <input id="btn-print" type="button" value="Print" style="width: 86px;
                height: 31px;
                color: black;
                font-size: 20px;" /> -->
                <div id="resultsDiv" style="margin-bottom: 40px;min-height: 473px;">
                    <div style="  color: #246785;font-size: 20px;     margin-bottom:  35px;     display: inline-block;    margin-left: 75px;"> Gazette & CD Password: <b style="color: red;font-size: 22px;" >Inter_Supply_2015</b></div>
                    <?php 
                      //DebugBreak();
                    if(@$isfound == -1)
                    {
                        echo "<p style='color: red;font-size: 24px;font-weight: bold;    text-align: center;    margin-bottom: 20px;'>Record Not Found. Please Enter Valid Roll Numnber/Name.</p>";
                    }

                    else if( @$callback['check'] ==2)
                    {

                        include "ma10presult.php";  
                    }   ?>
                   

               
                
              
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
                                                                      //  DebugBreak();

                                        if(@$result!= false)
                                        {
                                            $n=0;  
                                            $grp_name='';                             
                                            foreach($Inst_Cd = $result as $key=>$vals):
                                                $n++;
                                                //$formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                                echo '<tr  >
                                                <td style="width: 5%;">'.$vals['RNo'].'</td>
                                                <td style="width:15%">'.$vals['Name'].'</td>
                                                <td style="width:15%">'.$vals['FName'].'</td>
                                                <td style="width:15%">'.$vals['result2'].'</td>
                                                <td style="width:13%" class="hidden-phone"> <button type="button" class="btn-info" style="height: 32px;width: 107px;font-size: 17px;font-weight: bold;"  value="'.$vals['RNo'].'" onclick="Result_Print('.$vals['RNo'].')">View Result</button></td></tr>';
                                                endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                       
                        <?php  }
                    ?>
                        <div style="background-color: #4C5A65;    display: table-cell;    color: #DDDDDD;     -moz-border-radius: 16px;     -webkit-border-radius: 16px;  height: 90px;   font-size: 23px;  margin-top: 0px;vertical-align: middle;text-align: center;" >
                        You can also check detailed result by sending Roll No. to <b>800299 </b>through SMS   <br/></div>
                   </div>

                     </div>

                     

            <div id="header" style=" position: absolute;left: 50%;transform: translate(-50%, -50%);margin: 0 auto;">


                <div class="inFooterLogin">
                    <div id="copyright" style="    color: wheat;font-size: 16px;padding-top: 20px;text-align: center;">
                        © 2016 <a href="http://www.bisegrw.com"  style="color: wheat;">www.bisegrw.com</a> | Powered by Bisegrw  Development Team 
                    </div>
                </div>
            </div> 
        </div>
        <!--/.fluid-container-->
        <a href="http://www.bisegrw.com/" target="blank" style="position: fixed; border: none; text-decoration: none; width: 30px; height: 74px; right: 0px; top: 55px; display: block; overflow: hidden; background: url(&quot;../assets/img/silver.png&quot;) 0% 0% no-repeat;"></a>

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bttz.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
            $('#data-table').dataTable({
                "sPaginationType": "full_numbers",
                "cache": false
            });   
            });
            $("#btn-print").live("click", function () {
                var divContents = $("#printres").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write('<html><head><title>Matric (Annual) Examination, 2016</title>');
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
                    printWindow.document.write('<html><head><title>Matric (Annual) Examination, 2016</title>');
                    printWindow.document.write('</head><body >');
                    printWindow.document.write(divContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                }
            });
            function Result_Print(rno)
            {
                var win = window.open('<?=base_url()?>Result/Result_Print_datagrid/'+rno, '_blank');
                win.focus();
            }
        </script> 
    </body>
</html>