<footer>
    <p>
        &copy; BiseAdmin 2015
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)-->

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<?php 
if(isset($files)){
    foreach($files as $file){
        echo '<script type="text/javascript" src="'.base_url().'assets/js/'.$file.'"></script>';
    }
}
?> 
<script type="">
    $(document).ready(function () {
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "cache": false
        });
        $('#data-tablereg').dataTable({
            "sPaginationType": "full_numbers",
            "cache": false
        });
    });

</script>
<script type="">



    function downloadslip9th(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>index.php/result/resultcard9thgroupwise/'+rno+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }

    function downloadgroupwise12(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>index.php/result/InterRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise9th(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>index.php/result/resultcard9thgroupwise/'+$("#std_group").val()+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadslip_Inter(rno)
    {
        window.location.href = '<?=base_url()?>index.php/result/InterRollNo/'+rno+'/2'
    }

    function downloadgroupwise()
    {
        window.location.href = '<?=base_url()?>index.php/result/MatricRollNoGroupwise/'+$("#std_group").val()
    }


    function logout(){
        var msg = "Are you Sure You want to LOGOUT?"

        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>login/logout';
            } 
        });
    }
</script>


</body>
</html>