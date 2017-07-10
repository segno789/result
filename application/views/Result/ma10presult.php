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

include ('mFunPro.php');
//DebugBreak();
//---------------------------          

$Spl_cd = 0;  

$class ='';
$sess ='';
$title = '';




//$mymatricObj = new Matric();

//DebugBreak();
//------------------------------------------------------------------------------------------            
$result = $result[0];//$mymatricObj->getresult($mRNo1,$sess,$class,$_POST['year']);
$mRNo1= intval($result['RNo']);   
$spl_recd = //$mymatricObj->issplrno($mRNo1);

$Rl_fee = '';
$_POST['year'] =$result['iyear'];

if(SESS == '1' )
{
    $class =10; 
    $sess =1;
    $title = 'Matric (Annual) Examination, '.$_POST['year'];
}
else  if(SESS == '2')
{
    $class =10;
    $sess =2; 
    $title = 'Matric (Supply) Examination, '.$_POST['year'];
}




//print_r($result);  
//exit();     
// $result['iyear']=   $_POST['year'];
if ($result === FALSE){                

    echo('<center><span class="blink" style="font-size:25px;  " > You entered invalid Roll-Number, Please enter valid Roll Number from  400000 to 602981 </span></center>');
    echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');
}
else 
{ 
    $Spl_cd = getField($result,"spl_cd");

    if($Spl_cd == 10 or $Spl_cd == 11 or $Spl_cd == 12 or $Spl_cd == 13 or $Spl_cd == 14 or $Spl_cd == 16 or $Spl_cd == 17 or $Spl_cd == 24 or $Spl_cd == 8 or $Spl_cd == 15 or $Spl_cd == 9  or $Spl_cd == 4  or $Spl_cd == 5  or $Spl_cd == 99 ) 

    {
        $splName = getField($result,"result2");

        if($splName == '')
        {
            $splName = getField($res,"spl_name");  
        }             

        echo('<center><span class="blink" style="font-size:25px; text-align:justified" > This Student Record is '. $splName . '.</br> </span></center>');
        echo('<center><span   style="font-size:25px; text-align:justified" >  </span></center>');

        return false;

    }




    $Status=getField($result,"status");
    $schm= getField($result,"schm");
    $obt_mrk=getField($result,"obt_mrk");
    $Chance=getField($result,"chance");
    $Cat09=getField($result,"Cat09");
    $Cat10=getField($result,"Cat10");
    $oldschm=0;
    if($schm ==850)
    {
        $oldschm = 50; 
    }
    ?>         


    <table cellSpacing="0" class="tx grid" cellPadding="2" width="800" border="1" align="center" style="margin-bottom: 13px;" >
        <colgroup>
            <col width=4%>    <col width=40%>    <col width=8%>    <col width=8%>    <col width=8%>    <col width=8%>    <col width=8%>    <col width=8%>    <col width=8%>
        </colgroup>

        <tbody align="center">

            <tr align="left" height="100">
                <td height="50" colspan="9" align="center">                     
                    <span class="style4">
                        Board of Intermediate &amp; Secondary Education, Gujranwala
                    </span>
                    <h3><?php echo $title;?></h3>
                </td>
            </tr>

            <!-- Roll No, Name, Institute/District -->
            <tr align="left" height="35">
                <td colspan="5">Roll No:&nbsp;<b><?php echo getField($result,"RNo"); ?></b></td>
                <td colspan="4">Registration No:<b><?php echo  getField($result,"strRegNo"); ?></b></td>
            </tr>

            <tr align="left" height="28">
                <td colspan="5">Name:&nbsp;<b><?php echo getField($result,"Name"); ?></b></td>
                <td colspan="4"><b><?php echo "Group: " . mGroup(getField($result,"Grp_cd")); ?></b></td>
            </tr>

            <tr height="28">
                <td colspan="9" align="left">
                    <b><?php
                        $mVar=getField($result,"RegPvt");            
                        if ($mVar == "1"){
                            $mVar1=getField($result,"Sch_Cd");
                            $mVar=getField($result,"sch_Name");
                            echo "School: " .$mVar1.'-'. $mVar;
                        }
                        else
                            if ($mVar == "2")
                                echo "District: " . mDistrict(getField($result,"Dist_Cd"));
                    ?> </b>               
                </td> 
            </tr>

            <tr bgcolor="#D8D8D8" align="center" height="10">
                <td rowspan="2">Sr.</td>
                <td rowspan="2">Name of Subjects</td>
                <td rowspan="2" bgcolor="#D8D8D8">Max.<br>Marks</td>
                <td colspan="4">Marks Obtained</td>
                <!-- td>10th</td>
                <td>Practical</td>
                <td>Total</td -->
                <td colspan="2">Status</td>
                <!-- td>10th</td -->
            </tr>
            <tr bgcolor="#D8D8D8" align="center">
                <!-- td>Sr.</td>
                <td vAlign="bottom" height="10">Name of Subjects</td>
                <td>Max. Marks</td -->

                <?php if($result['iyear'] ==  2007) 
                {
                    $titl1 =  'Paper A';
                    $titl2 =  'Paper B';
                }
                else
                {
                    $titl1 =  '9th';
                    $titl2 =  '10th'; 
                }

                ?>

                <td>9th</td>
                <td>10th</td>
                <td>Practical</td>
                <td>Total</td>
                <td>9th</td>
                <td>10th</td>
            </tr>
            <!-- Sub-1 (Urdu) -->
            <tr height="28">
                <td>1</td>
                <td align="left"> 

                    <?php  $mVar=getField($result,"S1");                                                    
                    echo mSubName($mVar)?>

                </td>
                <td>150</td>
                <td><?php if(getField($result,"sub1st1") == 1 || getField($result,"sub1st1") == 4) {echo getField($result,"S1MT1");} else if(getField($result,"sub1st1") == 2) echo 'A'; ?></td>
                <td><?php if(getField($result,"sub1st2") == 1 || getField($result,"sub1st2") == 4) {echo getField($result,"S1MT2");} else if(getField($result,"sub1st2") == 2) echo 'A'; ?></td>

                <td>&nbsp;</td>
                <td><?php 
                    if((getField($result,"S1PF1") == 1 && getField($result,"S1PF2") == 1) || (getField($result,"S1PF1") == 2 || getField($result,"S1PF2") == 2)) 
                    {
                        echo getField($result,"S1MT2")+getField($result,"S1MT1");
                    }

                ?></td>
                <td>
                    <?php
                    $mVar = getField($result,"S1PF1");
                    echo subStatus($mVar);
                    ?>
                </td>
                <td>
                    <?php
                    $mVar = getField($result,"S1PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Sub-2 (English) -->            
            <tr height="28">
                <td>2</td>
                <td align="left">ENGLISH</td>
                <td>150</td>
                <td><?php if(getField($result,"sub2st1") == 1 || getField($result,"sub2st1") == 4) {echo getField($result,"S2MT1");} else if(getField($result,"sub2st1") == 2) echo 'A'; ?></td>
                <td><?php if(getField($result,"sub2st2") == 1 || getField($result,"sub2st2") == 4) {echo getField($result,"S2MT2");} else if(getField($result,"sub2st2") == 2) echo 'A'; ?></td>
                <td>&nbsp;</td>
                <td><?php  if((getField($result,"S2PF1") == 1 && getField($result,"S2PF2") == 1) || (getField($result,"S2PF1") == 2 || getField($result,"S2PF2") == 2)) 
                    {
                        echo getField($result,"S2MT2")+getField($result,"S2MT1");
                    }
                    ?>
                </td>
                <td><?php
                    $mVar = getField($result,"S2PF1");
                    echo subStatus($mVar);
                ?></td>
                <td>
                    <?php
                    $mVar = getField($result,"S2PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Sub-3 (Islamiyat) -->
            <tr height="28">
                <td>3</td>

                <td align="left">
                    <?php 

                    if($Cat09 !=4 and $Cat10!=4)
                    {
                        $mVar = getField($result,"S3");
                        echo ($mVar == "3") ? "ISLAMIYAT" : mSubName($mVar);
                    }

                    ?>    
                </td>           

                <td><?php 
                    if($Cat09 !=4 and $Cat10 !=4 )
                    {
                        if ($schm==1){echo '100';}else{echo '75';}
                    }
                ?></td>
                <td><?php if(getField($result,"sub3st1") == 1 || getField($result,"sub3st1") == 4) {echo getField($result,"S3MT1");} else if(getField($result,"sub3st1") == 2) echo 'A'; ?></td>
                <td ><?php if($schm==1){if(getField($result,"sub3st2") == 1 || getField($result,"sub3st2") == 4) {echo getField($result,"S3MT2");} else if(getField($result,"sub3st2") == 2) echo 'A';;}else{echo '-';} ?></td>
                <td>&nbsp;</td>
                <td><?php if($schm==2){echo getField($result,"S3MT1");} else {

                        if((getField($result,"S3PF1") == 1 && getField($result,"S3PF2") == 1) || (getField($result,"S3PF1") == 2 || getField($result,"S3PF2") == 2)) 
                        {
                            echo getField($result,"S3MT2")+getField($result,"S3MT1");
                        }
                        else if(getField($result,"S3PF1") == 1 && getField($result,"schm") == 1050)

                        {
                            echo getField($result,"S3MT1");
                        }

                    } ?>
                </td>
                <td>
                    <?php
                    $mVar = getField($result,"S3PF1");
                    echo subStatus($mVar);
                    ?>

                </td>
                <td><?php if($schm==1){$mVar = getField($result,"S3PF2"); echo subStatus($mVar);}else{echo '-';} ?></td>
            </tr>
            <!-- Sub-8 (Pak-St) -->          
            <tr height="28">
                <td>4</td>
                <td align="left">PAKISTAN STUDIES</td>
                <td><?php if($schm==1){echo '100';}else{echo '75';}?></td>
                <td><?php if($schm==1){if(getField($result,"sub8st1") == 1 || getField($result,"sub8st1") == 4) {echo getField($result,"S8MT1");} else if(getField($result,"sub8st1") == 2) echo 'A';}else{echo '-';} ?></td>
                <td><?php if(getField($result,"sub8st2") == 1 || getField($result,"sub8st2") == 4) {echo getField($result,"S8MT2");} else if(getField($result,"sub8st2") == 2) echo 'A';  ?></td>
                <td>&nbsp;</td>
                <td><?php if($schm==2){if(getField($result,"sub8st2") == 1 || getField($result,"sub8st2") == 4) {echo getField($result,"S8MT2");} else if(getField($result,"sub8st2") == 2) echo 'A'; } else {  
                    if(((getField($result,"S8PF2") == 1 && getField($result,"S8PF1") == 1) || (getField($result,"S8PF2") == 2 || getField($result,"S8PF1") == 2)) && $result['iyear']>2008) 
                    {
                        echo getField($result,"S8MT2")+getField($result,"S8MT1");
                    }
                    else if(getField($result,"S8PF2") == 1 && (getField($result,"schm") == 1050 || getField($result,"schm") == 850))

                    {
                        echo getField($result,"S8MT2");
                    }
                } ?></td>
                <td><?php if($schm==1){$mVar = getField($result,"S8PF1");echo subStatus($mVar);}else{echo '-';} ?></td>
                <td>    
                    <?php
                    $mVar = getField($result,"S8PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Sub-4 (Math) --> 
            <tr height="28">
                <td>5</td>
                <td align="left"><?php 
                    if($Cat09 !=4 and $Cat10 !=4)
                    {
                        if(getField($result,"Grp_cd") == 1)
                            echo "MATHEMATICS";
                        else if(getField($result,"Grp_cd") == 2)
                            echo "GENERAL MATH";

                }?></td>
                <td><?php if($Cat09 !=4 and $Cat10 !=4 and $result['iyear']>=2007) { echo 150-$oldschm ;}else if($Cat09 !=4 and $Cat10 !=4){echo '100';}?></td>
                <td><?php if(getField($result,"sub4st1") == 1 || getField($result,"sub4st1") == 4) {echo getField($result,"S4MT1");} else if(getField($result,"sub4st1") == 2) echo 'A'; ?></td>
                <td><?php if(getField($result,"sub4st2") == 1 || getField($result,"sub4st2") == 4) {echo getField($result,"S4MT2");} else if(getField($result,"sub4st2") == 2) echo 'A'; ?></td>

                <td>&nbsp;</td>
                <td><?php if((getField($result,"S4PF1") == 1 && getField($result,"S4PF2") == 1) || (getField($result,"S4PF1") == 2 || getField($result,"S4PF2") == 2)) 
                    {
                        echo  getField($result,"S4MT2")+getField($result,"S4MT1");
                    }
                ?></td>                
                <td>
                    <?php
                    $mVar = getField($result,"S4PF1");
                    echo subStatus($mVar);
                    ?>
                </td>
                <td>
                    <?php
                    $mVar = getField($result,"S4PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Sub-5 (Phy/GSc) --> 
            <tr height="28">
                <td>6</td>
                <td align="left">
                    <?php
                    $mVar=getField($result,"S5");                                                    
                    echo mSubName($mVar);
                    ?> 
                </td>
                <td><?php if($Cat09 !=4 and $Cat10 !=4 and  $result['iyear']>=2007) { echo 150-$oldschm;} else if($Cat09 !=4 and $Cat10 !=4){echo '100';}?></td>
                <td><?php if(getField($result,"sub5st1") == 1 || getField($result,"sub5st1") == 4) {echo getField($result,"S5MT1");} else if(getField($result,"sub5st1") == 2) echo 'A';; ?></td>
                <td><?php if(getField($result,"sub5st2") == 1 || getField($result,"sub5st2") == 4) {echo getField($result,"S5MT2");} else if(getField($result,"sub5st2") == 2) echo 'A'; ?></td>

                <td><?php
                    $s5st = getField($result,"S5SP2");
                    if($s5st == 2) {echo "A";}
                    else
                    {
                        if ($schm==1){echo get_gradeMAPrac_new_ma2016(getField($result,"S5MP2"),getField($result,"S5SP2"),getField($result,"S5"),getField($result,"S5PrSt2"));}
                        else {echo getField($result,"S5MP2");} 
                    }
                ?></td>
                <td><?php if((getField($result,"S5PF1") == 1 && getField($result,"S5PF2") == 1 ) || (getField($result,"S5PF1") == 2 || getField($result,"S5PF2") == 2)) 
                    {
                        if($schm==1)
                            echo getField($result,"S5MT2")+getField($result,"S5MT1");
                        else
                            echo getField($result,"S5MT2")+getField($result,"S5MT1")+getField($result,"S5MP2");

                    }
                ?></td>
                <td>
                    <?php
                    $mVar = getField($result,"S5PF1");
                    echo subStatus($mVar);
                    ?>
                </td>
                <td>
                    <?php
                    $mVar = getField($result,"S5PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Sub-6 (Ch/Opt) --> 
            <tr height="28">
                <td>7</td>
                <td align="left">
                    <?php
                    if($Cat09 !=4 and $Cat10 !=4) {
                        $mVar=getField($result,"S6");
                        echo mSubName($mVar);
                    }
                    ?> 

                </td>
                <td><?php if($Cat09 !=4 and $Cat10 !=4 and  $result['iyear']>=2007) {echo 150-$oldschm;}else if($Cat09 !=4 and $Cat10 !=4) {echo '100';}?></td>
                <td><?php if(getField($result,"sub6st1") == 1 || getField($result,"sub6st1") == 4) {echo getField($result,"S6MT1");} else if(getField($result,"sub6st1") == 2) echo 'A'; ?></td>
                <td><?php if(getField($result,"sub6st2") == 1 || getField($result,"sub6st2") == 4) {echo getField($result,"S6MT2");} else if(getField($result,"sub6st2") == 2) echo 'A'; ?></td>

                <td><?php 
                    // DebugBreak();
                    $s6st = getField($result,"S6SP2");
                    if($s6st == 2) {echo "A";}
                    else
                    {
                        if ($schm==1){echo get_gradeMAPrac_new_ma2016(getField($result,"S6MP2"),getField($result,"S6SP2"),getField($result,"S6"),getField($result,"S6PrSt2"));}

                        else {echo getField($result,"S6MP2");} 
                    }
                ?></td>
                <td><?php if((getField($result,"S6PF1") == 1 && getField($result,"S6PF2") == 1) || (getField($result,"S6PF1") == 2 || getField($result,"S6PF2") == 2)) 
                    {
                        if ($schm==1)
                            echo  getField($result,"S6MT2")+getField($result,"S6MT1");
                        else
                            echo  getField($result,"S6MT2")+getField($result,"S6MT1") +getField($result,"S6MP2");

                    }
                ?></td>
                <td>
                    <?php
                    $mVar = getField($result,"S6PF1");
                    echo subStatus($mVar);
                    ?>
                </td>
                <td>
                    <?php
                    $mVar = getField($result,"S6PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Sub-7 (Ch/Opt) --> 
            <tr height="28">
                <td>8</td>
                <td align="left">
                    <?php
                    if($Cat09 !=4 and $Cat10 !=4) {
                        $mVar=getField($result,"S7");
                        echo mSubName($mVar);
                    }
                    ?> 
                </td>
                <td><?php if($Cat09 !=4 and $Cat10 !=4 and   $result['iyear']>=2007) {echo 150-$oldschm;} else if($Cat09 !=4 and $Cat10 !=4) {echo '100';}?></td>
                <td><?php if(getField($result,"sub7st1") == 1 || getField($result,"sub7st1") == 4) {echo getField($result,"S7MT1");} else if(getField($result,"sub7st1") == 2) echo 'A'; ?></td>
                <td><?php if(getField($result,"sub7st2") == 1 || getField($result,"sub7st2") == 4) {echo getField($result,"S7MT2");} else if(getField($result,"sub7st2") == 2) echo 'A'; ?></td>

                <td><?php 
                    $s7st = getField($result,"S7SP2");
                    if($s7st == 2) {echo "A";}
                    else
                    {
                        if ($schm==1){echo get_gradeMAPrac_new_ma2016(getField($result,"S7MP2"),getField($result,"S7SP2"),getField($result,"S7"),getField($result,"S7PrSt2"));}
                        else{echo getField($result,"S7MP2"); }
                    }
                ?></td>
                <td><?php if((getField($result,"S7PF1") == 1 && getField($result,"S7PF2") == 1) || (getField($result,"S7PF1") == 2 || getField($result,"S7PF2") == 2)) 
                    {
                        if ($schm==1)
                            echo  getField($result,"S7MT2")+getField($result,"S7MT1");
                        else
                            echo  getField($result,"S7MT2")+getField($result,"S7MT1") +getField($result,"S7MP2");
                    }
                ?></td>
                <td>
                    <?php
                    $mVar = getField($result,"S7PF1");
                    echo subStatus($mVar);
                    ?>
                </td>
                <td>
                    <?php
                    $mVar = getField($result,"S7PF2");
                    echo subStatus($mVar);
                    ?>
                </td>
            </tr>
            <!-- Total and Grade --> 
            <tr height="28">
                <!-- td></td -->
                <td align="right" colspan="2">Total/Over All Grade:</td>
                <td><b><?php      
                        // DebugBreak();
                        $totalmarksvr = '';
                        if ($schm==1 and ($Cat09 ==4 and $Cat10==4)){ echo "400"; $totalmarksvr = 400;} 
                        else if ($schm == 850) {echo $schm;$totalmarksvr=$schm;}
                            else if ($schm == 1050) {echo $schm;$totalmarksvr=$schm;}
                                else if ($schm==1 and ($Cat09 ==5 and $Cat10==5)){ echo "";}     
                                    else if ($schm==1 and !($Cat09 ==4 and $Cat10==4) and !($Cat09 ==5 and $Cat10==5)){echo '1100'; $totalmarksvr = 1100;}                                                         
                                        else if ($schm==2){echo '1050';} else if($_POST['year']>=2007){ echo '1050'; $totalmarksvr = 1050;} else { echo '850'; $totalmarksvr = 850;}
                    ?></b>
                </td>
                <td colspan="3">&nbsp;</td>
                <!-- td></td>
                <td></td -->
                <td><b>
                        <?php
                        $mVar = getField($result,"obt_mrk");
                        echo $mVar != "0" ?    $mVar : "";
                    ?></b>
                </td>
                <td>Grade:</td>
                <td><b><?php if($schm==1 and  $result['iyear']>2007){echo get_gradeMA_newSch($obt_mrk,$Cat09,$Cat10,$Status);}
                        else if($schm==2 OR $schm == '' and  $result['iyear']>2007){echo get_gradeMA_oldSch($obt_mrk,$Status);}
                            else {
                                $pers = (getField($result,"obt_mrk")/$totalmarksvr)*100;

                                echo  get_gradeMA($pers);

                    } ?></b></td>
            </tr>            
            <!-- For Notification Detail --> 
            <tr height="25" bgcolor="#D8D8D8">
                <!-- td></td -->
                <td colspan="2" rowspan="2" align="right">Notification:</td>                
                <td colspan="1">9th:</td>
                <td colspan="6" align="left"><?php echo getField($result,"result1"); ?></td>
            </tr>            
            <tr height="25" bgcolor="#D8D8D8">
                <!-- td></td -->
                <td colspan="1">10th:</td>
                <td colspan="6" align="left"> <?php echo getField($result,"result2").' '.$Rl_fee; ?></td>
            </tr>
            <tr align="left" height="28">
                <td colspan="9" align="center">
                    <?php 
                    $Status=getField($result,"status");
                    $Chance=getField($result,"chance");
                    $Cat09=getField($result,"Cat09");
                    $Cat10=getField($result,"Cat10");

                    if ($Status=="1"){        //Pass
                        if ($Cat09=="1" or $Cat09=="2" or $Cat10=="1" or $Cat10=="2")
                            echo "< The candidate has Passed >";
                        else
                            if ($Cat09=="3" or $Cat10=="3")
                                echo "< The candidate has Improved his/her marks >";
                            else
                                if ($Cat09=="4" or $Cat10=="4")
                                    echo "< Candidate has Passed Aama/Khasa Subjects >";
                                else
                                    if ($Cat09=="5" or $Cat10=="5")
                                        echo "< Candidate has Passed in Additional Subject(s) >";
                    }        
                    else if ($Status=="2"   && $_POST['year'] >=2016 && $sess ==  1){        //Fail (Reappear)
                        if ($Cat09=="1" or $Cat09=="2" or $Cat10=="1" or $Cat10=="2")
                            echo "< Candidate has failed in subject(s) and eligible to reappear till ";
                        if ($Chance=="1")
                            echo "Supplementary Examination, 2017 >";                                    
                        else
                            if ($Chance=="2")
                                echo "Annual Examination, 2017 >";
                            else
                                if ($Chance=="3")
                                    echo "Supplementary Examination, 2016 >";
                    }
                    else if ($Status=="2"   && $_POST['year'] >=2016 && $sess==2){        //Fail (Reappear)
                        if ($Cat09=="1" or $Cat09=="2" or $Cat10=="1" or $Cat10=="2")
                            echo "< Candidate has failed in subject(s) and eligible to reappear till ";
                        if ($Chance=="1")
                            echo "Annual Examination, 2018 >";                                    
                        else
                            if ($Chance=="2")
                                echo "Supplementary Examination, 2017 >";
                            else
                                if ($Chance=="3")
                                    echo "Annual Examination, 2017 >";
                    }
                    else if ($Status=="3" and $_POST['year'] >=2015)
                    {        //Fail (Full)
                        if ($Cat09=="1" or $Cat09=="2" or $Cat10=="1" or $Cat10=="2"){
                            /*if ($Chance=="1" or $Chance=="2")
                            echo "Candidate has Failed in more than two subjects so he/she will reappear in full subjects next time";
                            else 
                            if ($Chance==3)*/

                            echo "< The candidate has failed in both parts. THEREFORE, he/she should appear in full subjects next time >";
                        }
                        else 
                            if ($Cat09=="3" or $Cat10=="3")
                                echo "< Candidate could not Improve his/her marks >";
                            else
                                if ($Cat09=="4" or $Cat10=="4")
                                    echo "< Candidate has Failed after Passing Aama/Khasa Examination >";
                                else
                                    if ($Cat09=="5" or $Cat10=="5")
                                        echo "< Candidate has Failed in Additional Subject(s) >";
                    }
                    ?>
                </td>
            </tr>
            <tr height="28">
                <td colspan="9" align="left">
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
            <?php 

            if($result['iyear'] ==2016)
            {

                ?>

                <tr height="28">
                    <td colspan="9" align="left">

                        In Case of any query related to result. Contact to Board Official Mr. <strong> <?Php echo getField($result,"Emp_Name")?>  <?php //echo  ' (Room No.'.getField($result,"RoomNo").')'; ?> </strong>

                    </td>
                </tr>

                <tr style="    height: 53px;">
                    <td colspan="9" align="center">
                        <img src="assets/img/simple.JPG" alt="" style="    width: 660px;">
                        <span style=" text-align: center;font-size: 16px;margin-left: 122px;margin-top: -8px;" ><a href="http://rechecking.bisegrw.com/" class="blink" style="    font-size: 25px" target="_blank" >Apply for Rechecking</a></span>        

                    </td>
                </tr>    
                <?php }?>    
            <tr height="28">
                <td colspan="9" align="center">
                    <a href="javascript:javascript:history.go(-1)">Click here to go back to previous page</a>        
                </td>
            </tr>

            <!-- ***************************************************************************************** -->
        </tbody>
    </table>
    <?php                    
    //sqlsrv_close($conn);

}

?>

