<style type="text/css">
    input.txt {
        border-right: #8f9ca5 1px solid; border-top: #8f9ca5 1px solid; font-size: 11px; border-left: #8f9ca5 1px solid; color: #000000; border-bottom: #8f9ca5 1px solid; font-family: Verdana, Arial; height: 18px
    }
    .restable {
        padding-right: 0px; padding-left: 0px; font-size: 12px; padding-bottom: 0px; margin: 0px; color: #6f6754; padding-top: 0px; font-family: Georgia, Times New Roman, Times, serif;
    }
    table a:link {
        font-size: 12px; color: #996430; font-family: Georgia, Times New Roman, Times, serif; text-decoration: none
    }
    table a:visited {
        font-size: 12px; color: #996430; font-family: Georgia, Times New Roman, Times, serif; text-decoration: none
    }
    table {
        font-size: 12px; color: #000000; font-family: Georgia, Times New Roman, Times, serif
    }
    .style4 {font-size: large}

    @keyframes blink {  
        50% { color: #005fbf ; }
    100% { color: #000000   ; }
    }
    @-webkit-keyframes blink {
        50% { color: #880000  ; }
    100% { color: #000000   ; }
    }
    .blink {
        -webkit-animation: blink 0.5s linear infinite;
        -moz-animation: blink 0.5s linear infinite;
        animation: blink 0.5s linear infinite;
    }
</style>
<?php
//DebugBreak();
include ('iFunPro.php');
//---------------------------
//$mRNo = $_REQUEST['rIA2P14'];    
$mRNo1= intval(@$callback['keyword']);  
$Spl_cd= 0;

$class ='';
$sess ='';
$title = '';
$_POST['year'] =  2016;
$_POST['class'] =  11;
if($_POST['class'] == '12' )
{
    $class =12; 
    $sess =1;
    $title = 'Intermediate (12th/Composite) Annual Examination,  '.$_POST['year'];
}
else  if($_POST['class'] == 'is')
{
    $class =12;
    $sess =2; 
    $title = 'Intermediate (12th/Composite) Supply Examination, '.$_POST['year'];
}
else  if($_POST['class'] == '11')
{
    $class =11;
    $sess =1;  
    $title = 'Intermediate (11th) Annual Examination, '.$_POST['year'];
}
/*$mymatricObj = new Matric();
$result = $mymatricObj->get12result($mRNo1,$sess,$class,$_POST['year']);      */
//DebugBreak();
$subtotal = '';
$result = $result[0];
if ($result === false)
{                

    echo('<center><span class="blink" style="font-size:25px;  " > You entered invalid Roll-Number, Please enter valid Roll Number from  300000 to 500000 </span></center>');
   // echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');

}

else {

      $splName = '';
    $Spl_cd = getField($result,"Spl_cd");
    //$res =  $mymatricObj->getsplcase($Spl_cd);
    if($Spl_cd == 10 or $Spl_cd == 11 or $Spl_cd == 12 or $Spl_cd == 13 or $Spl_cd == 14 or $Spl_cd == 16 or $Spl_cd == 17 or $Spl_cd == 24 or $Spl_cd == 8 or $Spl_cd == 15 or $Spl_cd == 9  or $Spl_cd == 4  or $Spl_cd == 5 or $Spl_cd == 99 or $Spl_cd == 55 or $Spl_cd == 115 or $Spl_cd == 72 OR $Spl_cd == 119 ) 

    {
        $splName = getField($result,"result1");
        
         if($splName == '')
        {
           // $naration =  $mymatricObj->getsplcase($splName);  

            $splName = getField($result,"spl_name");  
        }
        
        
        //$naration = getField($result,"SPL");
      //  $naration =  $mymatricObj->getsplcase($Spl_cd);
       
    }
  
    if($splName != '')
    {  echo('<center><span class="blink" style="font-size:25px; text-align:justified" > This Student Record is '. $splName . '.</br></span></center>');
       // echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');
        return ;

    }


    //   echo '<pre>'; print_r($result);
    ?>	        
    <a id="btn-print" class="button" style="margin-top: 5px;margin-left:40px;    float: left;"/>Print</a>
    <div id="printres" style="margin-left: 40px;margin-bottom: 20px;"> 
        <table cellSpacing="0" class="txt grid topics" cellPadding="2" width="800" border="1" align="center">
            <colgroup>
                <col width=5%>
                <col width=45%>
                <col width=12%>
                <col width=12%>
                <col width=26%>
            </colgroup>

            <tbody align="center">

                <tr align="left" height="100">
                    <td height="50" colspan="5" align="center">               	  
                        <span class="style4">
                            Board of Intermediate & Secondary Education, Gujranwala
                        </span>
                        <h3><?php echo $title;?></h3>
                    </td>
                </tr>
                <!-- Roll No, Name, Institute/District -->
                <tr align="left" height="28">
                    <td colspan="5"><u>Roll No:</u>&nbsp;<b><?php echo getField($result,"RNo"); ?></b></td>
                </tr>

                <tr align="left" height="28">					
                    <td colspan="3"><u>Name:</u>&nbsp;<?php echo getField($result,"Name"); ?></td>
                    <td colspan="2" align="left">
                        <?php
                        $mGrp = getField($result,"Grp_Cd");
                        echo "<u>Group:</u> " . iGroup($mGrp); 
                        ?>                 
                    </td> 						
                </tr>
                <tr height="28">
                    <td colspan="5" align="left">
                        <?php
                       // DebugBreak();
                        $mVar=getField($result,"RegPvt");			
                        if ($mVar == "1"){
                            $mVar=getField($result,"coll_cd");
                            //$resInst = $mymatricObj->getschoolname($mVar); 

                            echo "<u>College:</u> " . $mVar.'-'.getField($result,"sch_Name");
                        }
                        else
                            if ($mVar == "2")
                                echo "<u>District:</u> " . iDistrict(getField($result,"Dist_Cd"));
                        ?>                  
                    </td> 
                </tr>

                <tr bgcolor="#D8D8D8" align="center">
                    <td>Sr.</td>
                    <td height="10">Name of Subjects</td>
                    <td>Max.<br>Marks</td>
                    <td>Marks<br>Obtained</td>
                    <td>Remarks</td>
                </tr>   
                
                <!-- Sub-1 (Urdu) -->
                <tr height="28">
                    <td>1</td>
                    <td align="left">
                        <?php 
                        $mVar = getField($result,"S3");
                        echo ($mVar == "92") ? "ISLAMIC EDUCATION" : iSubName($mVar);
                        ?>
                    </td>
                    <td>
                    <?php if($_POST['year']>=2016) 
                    {
                       echo  $mark = Get11thSubMarks(getField($result,"S3"));
                          
                    }
                    else
                    {
                      echo   $mark =  50;
                    }
                    $subtotal = $subtotal +   $mark;
                    ?>
                    
                   </td>
                    <td><?php if(getField($result,"S3ST1") == 2 ) echo 'A' ; else echo getField($result,"S3MT1"); ?></td>
                    <td><?php if(getField($result,"S3ST1") != 2 ) echo subRemarks(trim(getField($result,"S3PF1"))); ?></td>
                </tr>
                <!-- Sub-2 (English) -->            
                <tr height="28">
                    <td>2</td>
                    <td align="left"><?php
                        $mVar = getField($result,"S1");
                        echo iSubName($mVar);
                    ?></td>
                    <td>
                     <?php if($_POST['year']>=2016) 
                    {
                       echo  $mark = Get11thSubMarks(getField($result,"S1"));
                          
                    }
                    else
                    {
                      echo   $mark =  100;
                    }
                    $subtotal = $subtotal +   $mark;
                    ?>
                    
                    </td>
                    <td><?php if(getField($result,"S1ST1") == 2 ) echo 'A' ; else echo getField($result,"S1MT1"); ?></td>
                    <td><?php if(getField($result,"S1ST1") != 2 ) echo subRemarks(trim(getField($result,"S1PF1"))); ?>	</td>
                </tr>
                <!-- Sub-3 (Islamiyat) -->
                <tr height="28">
                    <td>3</td>
                    <td align="left">	
                        ENGLISH
                    </td>
                    <td>
                    <?php 
                  ///  DebugBreak();
                    if($_POST['year']>=2016) 
                    {
                       echo  $mark = Get11thSubMarks(getField($result,"S2"));
                          
                    }
                    else
                    {
                      echo   $mark =  100;
                    }
                    $subtotal = $subtotal +   $mark;
                    ?>
                    </td>
                    <td><?php if(getField($result,"S2ST1") == 2 ) echo 'A' ; else echo getField($result,"S2MT1"); ?></td>
                    <td><?php if(getField($result,"S2ST1") != 2 ) echo subRemarks(trim(getField($result,"S2PF1"))); ?>	</td>

                </tr>
                <!-- Sub-4 (Opt-1) --> 
                <tr height="28">
                    <td>4</td>                        
                    <td align="left">
                        <?php
                        $mVar = getField($result,"S4");
                        echo iSubName($mVar);
                        ?> 
                    </td>
                    <td> <?php 
                    
                    if($_POST['year']>=2016) 
                    {
                       echo  $mark = Get11thSubMarks(getField($result,"S4"));
                    }
                    else
                    {
                      echo   $mark =  100;
                    }
                    $subtotal = $subtotal +   $mark;
                    ?>
                    </td>
                    <td><?php if(getField($result,"S4ST1") == 2 ) echo 'A' ; else echo getField($result,"S4MT1"); ?></td>
                    <td><?php if(getField($result,"S4ST1") != 2 ) echo subRemarks(trim(getField($result,"S4PF1"))); ?>	</td>
                </tr>
                <!-- Sub-5 (Opt-2) --> 
                <tr height="28">
                    <td>5</td>
                    <td align="left">
                        <?php
                        $mVar = getField($result,"S5");
                        echo iSubName($mVar);
                        ?>
                    </td>
                    <td><?php  
                    if($_POST['year']>=2016) 
                    {
                       echo  $mark = Get11thSubMarks(getField($result,"S5"));
                    }
                    else
                    {
                       if ($mGrp == "5" or $mGrp == "7") $mark =  75; else $mark =   100;
                       echo   $mark; 
                    }
                    $subtotal = $subtotal +   $mark;
                     ?> </td>
                    <td><?php if(getField($result,"S5ST1") == 2 ) echo 'A' ; else echo getField($result,"S5MT1"); ?></td>
                    <td><?php if(getField($result,"S5ST1") != 2 ) echo subRemarks(trim(getField($result,"S5PF1"))); ?>	</td>
                </tr>
                <!-- Sub-6 (Opt-3) --> 
                <tr height="28">
                    <td>6</td>
                    <td align="left">
                        <?php
                        $mVar = getField($result,"S6");
                        echo iSubName($mVar);
                        ?>
                    </td>
                    <td><?php  
                    if($_POST['year']>=2016) 
                    {
                       echo  $mark = Get11thSubMarks(getField($result,"S6"));
                    }
                    else
                    {
                       if ($mGrp == "5" or $mGrp == "7") $mark =  50; else $mark =   100;
                       echo   $mark; 
                     
                    }
                    $subtotal = $subtotal +   $mark;
                     ?></td>
                    <td><?php if(getField($result,"S6ST1") == 2 ) echo 'A' ; else echo getField($result,"S6MT1"); ?></td>
                    <td><?php if(getField($result,"S6ST1") != 2 ) echo subRemarks(trim(getField($result,"S6PF1"))); ?>	</td>
                </tr>

                <!-- Sub-7 (Opt-4) --> 
                <?php
                if ($mGrp == "5" or $mGrp == "7"){
                    $remarks= ''   ;
                    
                     if($_POST['year']>=2016) 
                    {
                         $mark = Get11thSubMarks(getField($result,"S7"));
                    }
                    else
                    {
                       if ($mGrp == "5" or $mGrp == "7") $mark =  75; 
                      /// echo   $mark; 
                     
                    }
                    
                     $subtotal = $subtotal +   $mark;
                     
                    if(getField($result,"S7ST1") == 2 )  $remarks = 'A' ; else  $remarks =  getField($result,"S7MT1")     ;
                    if(getField($result,"S7ST1") != 2 ) $mVar= subRemarks(trim(getField($result,"S7PF1"))); else  $mVar =  getField($result,"S7MT1")     ;
                    
                    $mTemp = "<tr height=\"28\">"
                    . "<td>7</td>"
                    . "<td align=\"left\">";							
                    $mTemp = $mTemp . iSubName(getField($result,"S7"));
                    $mTemp = $mTemp . "</td>" 
                    . "<td>".$mark."</td>"
                    . "<td>" .$remarks ;
                    $mTemp = $mTemp . "</td><td>";							
                    $mTemp = $mTemp . $mVar . "</td></tr>";
                    echo $mTemp;
                }
                ?>                    

                <!-- Total and Grade --> 
                <tr height="28">
                    <td align="right" colspan="2">Total:</td>
                    <td><b>
                    
                    <?= $subtotal?>
                    </b></td>
                    <td><b>
                            <?php
                            $mVar = getField($result,"result1");
                            echo $mVar != "0" ?	$mVar : "&nbsp;";
                        ?></b>
                    </td>
                    <td>&nbsp;</td>
                </tr>            

                <!-- For Notification Detail --> 
                <tr height="25" bgcolor="#D8D8D8">
                    <td colspan="2" align="right">Notification:</td>                
                    <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;<?php echo getField($result,"result1"); ?></td>
                </tr>

                <!-- Note -->
                <tr height="28">
                    <td colspan="5" align="left">
                        <?php
                        echo "<u><b>Note:-<br></b></u>
                        i-This result gazette is issued provisionally, errors and omissions excepted, as a notice only. 
                        Any entry appearing in this notification does not in itself confer any right or privilege 
                        on a candidate for the grant of certificate which will be issued under the rules/regulations 
                        on the basis of the original record of the Board's office.<br>
                        ii-For rechecking you can apply within 15 days after result declaration date.";	
                        ?>
                    </td>
                </tr>

                <tr height="28">
                    <td colspan="9" align="left">
                        In Case of any query related to result. Contact to Board Official Mr. <strong> <?Php echo getField($result,"Emp_Name"); ?> </strong>
                    </td>
                </tr>
                   <?php if($_POST['year'] == 2016) {?>
                <tr style="    height: 53px;">
                    <td colspan="9" align="center">
                        <img src="<?= base_url()?>assets/img/simple.JPG" alt="" style="    width: 660px;">
                        <span style="display:block; text-align: center;font-size: 16px;margin-left: 122px;margin-top: -12px;" ><a href="http://rechecking.bisegrw.com/rechecking_hssc/" class="blink" style="    font-size: 25px" target="_blank" >Apply for Rechecking</a></span>        
                    </td>
                </tr>   
                <?php }?> 
                <!-- Previous Page -->
                <tr height="28">
                    <td colspan="5" align="center">
                        <a href="javascript:javascript:history.go(-1)">Click here to go back to previous page</a>
                    </td>
                </tr>
                <!-- ***************************************************************************************** -->
            </tbody>
        </table>
    </div>
    <?php                    
}

?>


