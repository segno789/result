<footer style="margin-top: 30px;">
    <p>
        &copy; <?php echo "2016"; ?> BISE Gujranwala All Rights Reserved.
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)--> 
<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=93646887"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/contents/jquery-1.10.2.min.js"></script>   
<link href="<?php echo base_url();?>assets/contents/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/contents/bootstrap.min.js"></script>





<script>
    $(document).ready(function () {

        function hideall() {
            $('#divSSC').hide();
            $('#divHSSC').hide();
            $('#divOtherinfo').hide();
        }


        $('input[type=radio][name=verFor]').change(function () {
            debugger;
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
                    url: "<?php echo base_url(); ?>" + "Verification/VerifyRollNo",
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
                  debugger;                                                                                         
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
</script>        




</body>
</html>

