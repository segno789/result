<html>
    <body>
        <div class="container-fluid">
        <div class="dashboard-container">
        <div class="top-nav">
            <ul>
              

                    <?php 
                if($isselected == '4'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>result/dashboard9th" class="<?php if($isselected == '4') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Result Cards
                        </a>
                    </li>
                    <?php } ?>
                    
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="sub-nav">
          
          
            <?php
            if($isselected == '4'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>Result/dashboard9th"   data-original-title="" >Result Cards: </a></li>
                     <li>
                    <a href="<?php echo base_url(); ?>Result/dashboard9th">
                   9th Result Cards
                    </a>
                    </li>
                   <!-- <li>
                        <a href="<?php echo base_url(); ?>RollNoSlip/TenthStd">
                            10th Roll No. Slip
                        </a>
                    </li>
                     <li>
                    <a href="<?php echo base_url(); ?>RollNoSlip/EleventhStd">
                    11th Roll No. Slip
                    </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>RollNoSlip/InterStd">
                            12th Roll No. Slip
                        </a>
                    </li>-->
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }?>

                
            <div class="btn-group pull-right">
                <button class="btn btn-primary">
                    Main Menu
                </button>
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                    <span class="caret">
                    </span>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="index.html" data-original-title="">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration.php" data-original-title="">
                            Registration
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission.php" data-original-title="">
                            Admission
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Result.php" data-original-title="">
                            Result
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Profile.php" data-original-title="">
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>

