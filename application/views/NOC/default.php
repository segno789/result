                                                          
    <style>
        .floatright{float:right;}
        .hr{
                border-top: 1px solid #BDB4BC;
    border-bottom: 1px solid white;
        }
        .body{    background-color: #f4f4f4;}
        .form-textbox, .form-dropdown{
   
    outline: 0;
    height: 25px;
    width:100%;
    padding-left: 10px;
   
   
   -moz-box-sizing: border-box; // Added rule
   -webkit-box-sizing: border-box; // Added rule
    box-sizing:border-box; // Added rule
}
    </style>
    <form action="" name="noc_form" id="noc_form" >
    <div class="container">
    <hr class="hr" />
    <div class="row">
        <div class="col-sm-12"></div>
    </div>
    <div class="row">
        <div class="col-sm-6 text-right">
            <label style="    font-size: 29px;"> Type of NOC : </label>
        </div>
        <div class="col-sm-2">
            <select name="ddlprupose" id="ddlprupose" style="font-size: 16px; font-weight: bold;">
                <!--<option value="0">SELECT ONE</option>-->
                <option selected=selected>NOC For Other Board</option>
                <!--<option>Departmental Verification</option>-->
            </select>
        </div>
    </div>

    <div class="row">
        <hr />
        <div class="col-sm-3  text-right">
            <label style="font-size: 18px;"> NOC For:</label> 
        </div>
        <div class="col-sm-7">
            <label class='radio-inline' style=" font-size: 18px; font-weight: 500;">
                <input type='radio' value='1' id='SSCOnly' name='verFor' style="width: 27px;    height: 15px;">
                SSC ONLY (matric)
            </label>
            <label class='radio-inline'  style="    font-size: 18px; font-weight: 500;">
                <input type='radio' id='HSSConly' value='2' name='verFor' style="width: 27px;    height: 15px;">
                HSSC ONLY(inter)
            </label>
         
        </div>
    </div>
        <div id="dialog-confirm" title="Please Confirm Your Information in order to Proceed NOC Application.">
  
</div>
    <div id="divSSC" style="display:none;">
        <hr class="hr" />
        <div class="row">
            <div class="col-sm-12 panel-heading " style="text-align: left;">
                <H3><b><u>SSC Information</u></b></H3>

            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-1 text-right " >
                <label >Roll No:</label>
            </div>
            <div class="col-sm-2 ">
                <input type="text" id="sscrno" maxlength="6" class="form-textbox"/>
            </div>
            <div class="col-sm-1 text-right " >
                <label >DOB:</label>
            </div>
            <div class="col-sm-2 ">
                <input type="text" id="sscdob" name="sscdob" readonly="readonly" class="form-textbox"/>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1  text-right">
                <label >Year:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlsscYear" class="form-dropdown" >
                    <option value="0">SELECT YEAR</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                   <!-- <option value="1">BEFORE 2000</option>-->

                </select>
            </div>
            <div class="col-sm-1 " >
                <label class="control-label text-right" >Session:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlsscSess" class="form-dropdown">
                    <option value="0">SELECT SESSION</option>
                    <option value="1">ANNUAL</option>
                    <option value="2">SUPPLEMANTARY</option>
                </select>
            </div>
        </div>
        <br />
        <div class="row">
        <div class="col-sm-1" style="font-size:20px; color:red;">
        <label class="control-label text-right" style="    margin-left: -21px;">Migrate To:</label>
        </div>
         <div class="col-sm-5">
                <select id="ddlsscBrd" class="form-dropdown" name="ddlsscBrd">
                <option value="0">PLEASE SELECT ONE</option>
                  <option value="1">BISE, GUJRANWALA</option><option value="2">BISE,  LAHORE</option><option value="3">BISE,  RAWALPINDI</option><option value="4">BISE,  MULTAN</option><option value="5">BISE,  FAISALABAD</option><option value="6">BISE,  BAHAWALPUR</option><option value="7">BISE,  SARGODHA</option><option value="8">BISE,  DERA GHAZI KHAN</option><option value="9">FBISE, ISLAMABAD</option><option value="10">BISE, MIRPUR</option><option value="11">BISE, ABBOTTABAD</option><option value="12">BISE, PESHAWAR</option><option value="13">BSE, KARACHI</option><option value="14">BISE, QUETTA</option><option value="15">BISE, MARDAN</option><option value="16">FBISE, ISLAMABAD</option><option value="17">CAMBRIDGE</option><option value="18">AIOU, ISLAMABAD</option><option value="19">BISE, KOHAT</option><option value="20">KARAKURUM</option><option value="21">MALAKAN</option><option value="22">BISE, BANNU</option><option value="23">BISE, D.I.KHAN</option><option value="24">AKUEB, KARACHI</option><option value="25">BISE, HYDERABAD</option><option value="26">BISE, LARKANA</option><option value="27">BISE, MIRPUR(SINDH)</option><option value="28">BISE, SUKKUR</option><option value="29">BISE, SWAT</option><option value="30">SBTE KARACHI</option><option value="31">PBTE, LAHORE</option><option value="32">AFBHE RAWALPINDI</option><option value="33">BIE, KARACHI</option><option value="34">BISE SAHIWAL</option>
                </select>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-1">
                  <!--<label class="floatright" id="lblDisplyMessage" style="display: none; color: blue; font-weight: bold; font-size: large;">Please Enter Name and Marks</label>-->
            </div>
            <div class="col-sm-2 ">
                <label class="floatright" id="lblDisplyNameSSC" style="display: none;">Candidate Name:</label>
            </div>
            <div class="col-sm-5" style="text-align: left;">
                <input type="text" id="txtsscName" style="display: none; width:66%;" />
            </div>
        </div>
          <div class="row">
        <div class="col-sm-12" style="    text-align: left;    font-weight: bold; text-transform: uppercase;">
        <input type='checkbox'  style='    width: 24px;        height: 24px;' name='terms' id='terms' onchange='activateButton(this)'>  I accept all the terms & coditions of BISE,Gujranwala.
        </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
            <!--onclick="verifyRollNo(10,sscrno.value, ddlsscYear.value, ddlsscSess.value)"-->
                <input type="button" class="btn btn-info" id = "btnVerifySSCRollNo" name="btnVerifySSCRollNo" onclick="return check_validate();" value="VERIFY ROLL NO." />    
            </div>
            <div class="col-sm-3 " >
                <label class="floatright" id="lblDisplyObtMarksSSC" style="display: none;">Obtained Marks:</label>
            </div>
            <div class="col-sm-5"  style="text-align: left;">
                <input type="text" id="txtsscObtMarks" style="display: none;" />
            </div>
        </div>     
      
        <br />
      
 

    </div>


    <div id="divHSSC" style="display:none;">
           <hr class="hr" />
        <div class="row">
            <div class="col-sm-12 panel-heading " style="text-align: left;">
                <H3><b><u>HSSC Information</u></b></H3>

            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-1 text-right " >
                <label style="margin-left: -34px;" >Matric Roll No:</label>
            </div>
            <div class="col-sm-2 ">
                <input type="text" id="sscrno" maxlength="6"  class="form-textbox"/>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-1 text-right " >
                <label style="margin-left: -34px;" >Inter Roll No:</label>
            </div>
             <div class="col-sm-2 ">
                <input type="text" id="Hsscrno" maxlength="6"  class="form-textbox"/>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1  text-right">
                <label >Year:</label>
            </div>
            <div class="col-sm-2">
                <select id="ddlHsscYear" class="form-dropdown" >
                    <option value="0">SELECT YEAR</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                   <!-- <option value="1">BEFORE 2000</option>-->

                </select>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-1 " >
                <label class="control-label text-right" >Session:</label>
            </div>
            
            <div class="col-sm-2">
                <select id="ddlHsscSess" class="form-dropdown">
                    <option value="0">SELECT SESSION</option>
                    <option value="1">ANNUAL</option>
                    <option value="2">SUPPLEMANTARY</option>
                </select>
            </div>
        </div>
        <br />
        <div class="row">
        <div class="col-sm-1" style="font-size:20px; color:red;">
        <label class="control-label text-right" style="    margin-left: -21px;">Migrate To:</label>
        </div>
         <div class="col-sm-6">
                <select id="ddlHsscBrd" class="form-dropdown">
                <option value="0">PLEASE SELECT ONE</option>
                  <option value="1">BISE, GUJRANWALA</option><option value="2">BISE,  LAHORE</option><option value="3">BISE,  RAWALPINDI</option><option value="4">BISE,  MULTAN</option><option value="5">BISE,  FAISALABAD</option><option value="6">BISE,  BAHAWALPUR</option><option value="7">BISE,  SARGODHA</option><option value="8">BISE,  DERA GHAZI KHAN</option><option value="9">FBISE, ISLAMABAD</option><option value="10">BISE, MIRPUR</option><option value="11">BISE, ABBOTTABAD</option><option value="12">BISE, PESHAWAR</option><option value="13">BSE, KARACHI</option><option value="14">BISE, QUETTA</option><option value="15">BISE, MARDAN</option><option value="16">FBISE, ISLAMABAD</option><option value="17">CAMBRIDGE</option><option value="18">AIOU, ISLAMABAD</option><option value="19">BISE, KOHAT</option><option value="20">KARAKURUM</option><option value="21">MALAKAN</option><option value="22">BISE, BANNU</option><option value="23">BISE, D.I.KHAN</option><option value="24">AKUEB, KARACHI</option><option value="25">BISE, HYDERABAD</option><option value="26">BISE, LARKANA</option><option value="27">BISE, MIRPUR(SINDH)</option><option value="28">BISE, SUKKUR</option><option value="29">BISE, SWAT</option><option value="30">SBTE KARACHI</option><option value="31">PBTE, LAHORE</option><option value="32">AFBHE RAWALPINDI</option><option value="33">BIE, KARACHI</option><option value="34">BISE SAHIWAL</option>
                </select>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-1">
                  <!--<label class="floatright" id="lblDisplyMessage" style="display: none; color: blue; font-weight: bold; font-size: large;">Please Enter Name and Marks</label>-->
            </div>
            <div class="col-sm-2 ">
                <label class="floatright" id="lblDisplyNameHSSC" style="display: none;">Candidate Name:</label>
            </div>
            <div class="col-sm-5" style="text-align: left;">
                <input type="text" id="txtHsscName" style="display: none; width:66%;" />
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                <input type="button" class="btn btn-info" id = "btnVerifyHSSCRollNo" name="btnVerifyHSSCRollNo" onclick="verifyRollNo(10,sscrno.value, ddlsscYear.value, ddlsscSess.value)" value="VERIFY ROLL NO." />    
            </div>
            <div class="col-sm-3 " >
                <label class="floatright" id="lblDisplyObtMarksHSSC" style="display: none;">Obtained Marks:</label>
            </div>
            <div class="col-sm-5"  style="text-align: left;">
                <input type="text" id="txtHsscObtMarks" style="display: none;" />
            </div>
        </div>     
        <br />
      

    </div>
    
    <div id="dialog-message" title="You can apply for NOC with your following record.">
  
</div>
</form>
<style type="text/css">
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url(<?php echo base_url().'assets/img/loading-black.gif' ?>) 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: inherit;
}
</style>
       
  


   
      

   
  