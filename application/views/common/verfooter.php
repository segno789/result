<footer style="margin-top: 30px;">
    <p>
        &copy; <?php echo "2016"; ?> BISE Gujranwala All Rights Reserved.
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)--> 

<script type="text/javascript" src="<?php echo base_url();?>assets/contents/jquery-1.10.2.min.js"></script>   
<link href="<?php echo base_url();?>assets/contents/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/contents/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>



<script>
    jQuery.fn.ForceNumericOnly =
    function()
    {
        return this.each(function()
            {
                $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                        // home, end, period, and numpad decimal
                        return (
                            key == 8 || 
                            key == 9 ||
                            key == 13 ||
                            key == 46 ||
                            key == 110 ||
                            key == 190 ||
                            (key >= 35 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                });
        });
    };
    $(document).ready(function () {

        $body = $("body");

        $(document).on({
            ajaxStart: function() { $body.addClass("loading");    },
            ajaxStop: function() { $body.removeClass("loading"); }    
        });



        $("#sscrno, #Hsscrno, #appNo").ForceNumericOnly();       
        function hideall() {
            $('#divSSC').hide();
            $('#divHSSC').hide();
            $('#divOtherinfo').hide();
        }
        $( "#sscdob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate: new Date(2003, 7,1),yearRange: '1970:2003'}).val();
        //$("#sscdob").datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, startDate:new Date() }).val();

        $('input[type=radio][name=verFor]').change(function () {
            // debugger;
            var option = $('input[type=radio][name=verFor]:checked').val();
            if (option == 1) {
                hideall();
                $('#divSSC').show();
                $('#divOtherinfo').show();
            }
            else if (option == 2) {
                hideall();
                $('#divHSSC').show();
                $('#divOtherinfo').show();
            }
            else if (option == 3) {
                hideall();
                $('#divSSC').show();
                $('#divHSSC').show();
                $('#divOtherinfo').show();
            }
        });


    });
    function verifyRollNo(vClass,RollNO, vYear ,sess){

        jQuery.ajax({                    
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/Verification/VerifyRollNo",
            dataType: 'json',
            data: {vClass: vClass, RollNO: RollNO, vYear: vYear, sess: sess},                            
            success: function(json) {
                //var listitems;
                //alert('Hi i am success' );
                //console.log(json.retData[0].name); 
                //console.log(json.retData[0].obt_mrk); 

                if(vClass == 10) {
                    $('#txtsscName').show();
                    $('#txtsscObtMarks').show();
                    $('#lblDisplyNameSSC').show();
                    $('#lblDisplyObtMarksSSC').show();
                }

                if(vClass == 12) {
                    $('#txtHsscName').show();
                    $('#txtHsscObtMarks').show();
                    $('#lblDisplyNameHSSC').show();
                    $('#lblDisplyObtMarksHSSC').show();
                }

                if(json.retData.length > 0)
                {   
                    if(vClass == 10) {                                               
                        $('#txtsscName').val(json.retData[0].name);                          
                        $('#txtsscObtMarks').val(json.retData[0].obt_mrk);                          
                        $('#txtsscName').attr('readonly', true);
                        $('#txtsscObtMarks').attr('readonly', true);
                        //$('#lblDisplyMessage').show();
                    }
                    if(vClass == 12) {                                               
                        $('#txtHsscName').val(json.retData[0].name);                          
                        $('#txtHsscObtMarks').val(json.retData[0].obt_mrk);                          
                        $('#txtHsscName').attr('readonly', true);
                        $('#txtHsscObtMarks').attr('readonly', true);
                        //$('#lblDisplyMessage').show();
                    }
                }
                else{
                    $('#txtsscName').val('');                          
                    $('#txtsscObtMarks').val('');                   
                    $('#txtHsscName').val('');                          
                    $('#txtHsscObtMarks').val('');   

                    $('#txtsscName').attr('readonly', false);
                    $('#txtsscObtMarks').attr('readonly', false);  
                    $('#txtHsscName').attr('readonly', false);
                    $('#txtHsscObtMarks').attr('readonly', false);                                                        
                }

                if(vYear == 2000){                            
                    $('#rowAttachPicture').show();
                }    



                // console.log(url);
                //$('#pvtZone').empty();
                //$('#pvtZone').append('<option value="0">SELECT ZONE</option>');
                //$.each(json, function (key, data) {

                //console.log(key)

                /*  $.each(data, function (index, data) {

                // console.log('Zone Name :', data.zone_name , ' Zone Code : ' ,data.zone_cd)
                listitems +='<option value=' + data.zone_cd + '>' + data.zone_name + '</option>';
                //$('#pvtZone').append('<option value=' + data.zone_cd + '>' + data.zone_name + '</option>');
                //console.log('Zone Name :', data.zone_cd)
                //console.log('Zone Name :', data)
                })*/
                //})
                //$('#pvtZone').append(listitems)
                /*console.log(data.length);
                for (var i = 0; i < data.length; i++) {

                console.log(" Thesil : "+ data[i].zone_name);
                // var checkBox = "<input type='checkbox' data-price='" + data[i].Price + "' name='" + data[i].Name + "' value='" + data[i].ID + "'/>" + data[i].Name + "<br/>";
                // $(checkBox).appendTo('#modifiersDiv');
                }*/
                //if (json)
                //{
                //var obj = jQuery.parseJSON(json);
                //  console.log(json.teh[0].zone_name);
                //alert( obj['teh']['Class']);
                //   alert(res.Sess);
                //   alert(res.Class);
                //   //debugger;
                //   Show Entered Value
                //   jQuery("div#result").show();
                //   jQuery("div#value").html(res.username);
                //   jQuery("div#value_pwd").html(res.pwd);
                //}

            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });

    }   
    //------------------------file upload review-------------------------------

    function ValidateFileUpload(a,inputFile,fileReview) { 
        var fuData = document.getElementById(inputFile);
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            alert("Please upload an image");
            jQuery(fileReview).removeAttr('src');
        } 
        else {
            var Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(fileReview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } 
            else {
                document.getElementById(inputFile).removeAttr('value');
                jQuery(fileReview).removeAttr('src');
                alert("Image only allows file types of JPEG. ");
                return false;
            }
        }
        var file_size = document.getElementById(inputFile)[0].files[0].size;
        if(file_size>30480) {                                    
            document.getElementById(inputFile).removeAttr('value');
            jQuery(fileReview).removeAttr('src');
            alert("File size can be between 30KB"); 
            return false;
        } 
    } 
    //------------------------end, file upload review-------------------------------

    // --------- validation of Info -------------------
    function check_validate()
    {
        var NOC_class = $("input[name='verFor']:checked").val();
        var matric_rno = $("#sscrno").val();  
        var inter_rno = $("#hsscrno").val();   
        var dob = $("#sscdob").val();   
        var ddlsscYear = $("#ddlsscYear").val();   
        var ddlsscSess = $("#ddlsscSess").val();   
        var ddlsscBrd = $("#ddlsscBrd").val(); 
        if(matric_rno == "")
        {
            alertify.error("Please First Enter Roll Number.");
        }
        else
            if(dob == "")
            {
                alertify.error("Please Select DOB First.");

            } 
            else
                if(ddlsscYear == 0)
                {
                    alertify.error("Please Select Year First.");   
                } 
                else
                    if(ddlsscSess == 0)
                    {
                        alertify.error("Please Select Session First.");    
                    }
                    else
                        if(ddlsscBrd == "0")
                        {
                            alertify.error("Please Select Migrated Board First.");
                        }
                        else
                            if($('#terms').prop('checked')== false)
                            {
                                alertify.error("Please Accept the terms and Conditions Frist");
                            }
                            else
                            {
                                check_ssc_NOC(matric_rno,ddlsscYear,ddlsscSess,ddlsscBrd,dob); 
                            }





    }
    function check_hssc_validate()
    {
        var NOC_class = $("input[name='verFor']:checked").val();
        var matric_rno = $("#tsscrno").val();  
        var inter_rno = $("#Hsscrno").val();   
        var ddlsscYear = $("#ddlHsscYear").val();   
        var ddlsscSess = $("#ddlHsscSess").val();   
        var ddlsscBrd = $("#ddlHsscBrd").val(); 
        if(matric_rno == "")
        {
            alertify.error("Please First Enter Matric Roll Number.");
        }
        else
            if(inter_rno == 0)
            {
                alertify.error("Please First Enter Inter Roll Number.");   
            } 
            else
                if(ddlsscYear == 0)
                {
                    alertify.error("Please Select Year First.");   
                } 
                else
                    if(ddlsscSess == 0)
                    {
                        alertify.error("Please Select Session First.");    
                    }
                    else
                        if(ddlsscBrd == "0")
                        {
                            alertify.error("Please Select Migrated Board First.");
                        }
                        else
                            if($('#termshssc').prop('checked')== false)
                            {
                                alertify.error("Please Accept the terms and Conditions Frist");
                            }
                            else
                            {
                                check_hssc_NOC(matric_rno,inter_rno,ddlsscYear,ddlsscSess,ddlsscBrd); 
                            }





    }

    function check_downloand()
    {
        var appno = $("#appNo").val(); 
        if(appno == "")
        {
            alertify.error("Please Provide Application No.");
            return false;
        }
        else if(appno <5)
        {
            alertify.error("Please Provide Correct Application No.");
            return false;
        }
        else
        {
            alertify.log("Please Wait for a while...")   
            return true;
        }



    }
    function activateButton(element) {

        if(element.checked) {
            $("input[type=submit]").attr("disabled", "enabled");
            //document.getElementById("submit").disabled = false;
        }
        else  {
            $("input[type=submit]").attr("disabled", "disabled");
            // $("#btnVerifySSCRollNo")
            //document.getElementById("submit").disabled = true;
        }

    }
    function check_ssc_NOC(rno,year,sess,migto,dob)
    {
        var noc_html = "";
        var Mesg = "";
        var Mesg_server = "";
        var alldata ;
        jQuery.ajax({ 

            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/NOC/get_ssc_data",
            dataType: 'json',
            data: {rno: rno, year: year, sess: sess, brd:migto, dob:dob},                            
            success: function(json) {


                Mesg = json[0][0]['Mesg'];
                Mesg_server = json[0][0]['Mesg_server'];
                if(Mesg_server != "")
                {
                    alertify.error(Mesg_server);
                }
                else
                {
                    noc_html = "";
                    noc_html += "<div class='row'> <div class='col-sm-3' style='text-align:right; font-weight: bold;'>Name :</div><div class='col-sm-6' style='text-align:left; margin-bottom: -50px;'>"+json[0][0]['name']+"  <img style='width:80px; height: 80px;' class='pull-right'  src ='"+json[0][0]['PicPath']+"'></div>";
                    noc_html += "</div><div class='row'> <div class='col-sm-3' style='text-align:right; font-weight: bold;'>Father Name :</div><div class='col-sm-6' style='text-align:left;'>"+json[0][0]['Fname']+"</div></div>" ;
                    noc_html += "<div class='row' style='    margin-top: 5px;'> <div class='col-sm-3' style='text-align:right; font-weight: bold;'>DOB :</div><div class='col-sm-6' style='text-align:left;'>"+json[0][0]['dob']+"</div></div>";
                    if(Mesg == "")
                    {
                        $( "#dialog-confirm" ).html(noc_html);  
                        $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height: "auto",
                            width: 800,
                            modal: true,
                            buttons: {

                                //  $(this).dialog( "close" );
                                "Confirm and Apply": function() { 
                                    //noc_html;
                                    // $('#terms').val();
                                    //if()
                                    // $("input[type=submit]").attr("disabled", "enabled");
                                    //$( "#noc_form" ).submit();
                                    jQuery.ajax({                    
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>" + "index.php/NOC/Insert_ssc_data",
                                        dataType: 'json',
                                        data: {rno: rno, year: year, sess: sess, migto: migto,dob:dob},                            
                                        success: function(json) {
                                            // alert('Your Application is submitted Successfully');

                                            $( "#dialog-confirm" ).html('<div style="color:Green; font-weight:bold; font-size:16px;">Your Application is submitted Successfully</div>'); 
                                            // window.location.href = '<?php //echo base_url(); ?>NOC/Download_NOC/'+json[0][0]['app_No']+'/';
                                            window.location.href = '<?php echo base_url(); ?>index.php/NOC/downloadPage/'+json[0][0]['app_No']+'/';

                                            $(".ui-button-text").css("display", "none");
                                        },
                                        error: function(request, status, error){
                                            $( "#dialog-confirm" ).html('<div style="color:RED; font-weight:bold; font-size:16px;">Your Application is NOT submitted. Please Try again later.</div>');
                                            alert(request.responseText);
                                        }
                                    });



                                }, 
                                Cancel: function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        });   
                    }
                    else
                    {
                        //  alert('error ');
                        $( "#dialog-message" ).html(Mesg);

                        $( "#dialog-message" ).dialog({
                            modal: true,
                            height: "auto",
                            width: 500,
                            buttons: {
                                Ok: function() {

                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                        return;

                    }  
                }

            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });

    }
    function check_hssc_NOC(matric_rno,rno,year,sess,migto)
    {
        var noc_html = "";
        var Mesg = "";
        var Mesg_server = "";
        var alldata ;
        jQuery.ajax({ 

            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/NOC/get_hssc_data",
            dataType: 'json',
            data: {rno: rno, year: year, sess: sess, brd:migto, matrno:matric_rno},                            
            success: function(json) {


                Mesg = json[0][0]['Mesg'];
                Mesg_server = json[0][0]['Mesg_server'];
                if(Mesg_server != "")
                {
                    alertify.error(Mesg_server);
                }
                else
                {
                    noc_html = "";
                    noc_html += "<div class='row'> <div class='col-sm-3' style='text-align:right; font-weight: bold;'>Name :</div><div class='col-sm-6' style='text-align:left; margin-bottom: -50px;'>"+json[0][0]['name']+"  <img style='width:80px; height: 80px;' class='pull-right'  src ='"+json[0][0]['PicPath']+"'></div>";
                    noc_html += "</div><div class='row'> <div class='col-sm-3' style='text-align:right; font-weight: bold;'>Father Name :</div><div class='col-sm-6' style='text-align:left;'>"+json[0][0]['Fname']+"</div></div>" ;
                    noc_html += "<div class='row' style='    margin-top: 5px;'> <div class='col-sm-3' style='text-align:right; font-weight: bold;'>DOB :</div><div class='col-sm-6' style='text-align:left;'>"+json[0][0]['dob']+"</div></div>";
                    if(Mesg == "")
                    {
                        $( "#dialog-confirm" ).html(noc_html);  
                        $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height: "auto",
                            width: 800,
                            modal: true,
                            buttons: {

                                //  $(this).dialog( "close" );
                                "Confirm and Apply": function() { 
                                    //noc_html;
                                    // $('#terms').val();
                                    //if()
                                    // $("input[type=submit]").attr("disabled", "enabled");
                                    //$( "#noc_form" ).submit();
                                    jQuery.ajax({                    
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>" + "NOC/Insert_ssc_data",
                                        dataType: 'json',
                                        data: {rno: rno, year: year, sess: sess, migto: migto,dob:dob},                            
                                        success: function(json) {
                                            // alert('Your Application is submitted Successfully');

                                            $( "#dialog-confirm" ).html('<div style="color:Green; font-weight:bold; font-size:16px;">Your Application is submitted Successfully</div>'); 
                                            // window.location.href = '<?php echo base_url(); ?>NOC/Download_NOC/'+json[0][0]['app_No']+'/';
                                            window.location.href = '<?php echo base_url(); ?>NOC/downloadPage/'+json[0][0]['app_No']+'/';

                                            $(".ui-button-text").css("display", "none");
                                        },
                                        error: function(request, status, error){
                                            $( "#dialog-confirm" ).html('<div style="color:RED; font-weight:bold; font-size:16px;">Your Application is NOT submitted. Please Try again later.</div>');
                                            alert(request.responseText);
                                        }
                                    });



                                }, 
                                Cancel: function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        });   
                    }
                    else
                    {
                        //  alert('error ');
                        $( "#dialog-message" ).html(Mesg);

                        $( "#dialog-message" ).dialog({
                            modal: true,
                            height: "auto",
                            width: 500,
                            buttons: {
                                Ok: function() {

                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                        return;

                    }  
                }

            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });

    }


</script>        




</body>
</html>

<div class="modal"><!-- Place at bottom of page --></div>