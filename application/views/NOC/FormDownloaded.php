<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title" style="float: none !important;">
                            <label class="welcome_note myEngheading" style="float: left;">Download Section.</label>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                                <!--FORM START-->
                                <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>index.php/NOC/Print_challan_Form/<?php echo $app_No; ?>" >
                            </div>
                            <label style="color: green; font-size: 32px;">Your Application is Submitted Successfully.</label>
                            <p>  <strong style=" font-size: 24px;"> Your Application No.<?php echo $app_No; ?> </strong></p>
                            <input type="submit" value="Download Challan" id="btnDownloadForm" class="jbtn jmedium jblack">
                            <input type="button" class="jbtn jmedium jblack" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var formno = '<?php echo @$app_No; ?>';

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/noc';
            } else {
                // user clicked "cancel"
            }
        });
    }
</script>