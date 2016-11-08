<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" />
        <link href="<?php echo base_url('bootstrap/myform.css');?>" rel="stylesheet">
    </head>
    
    <body>
        <div class="container">
            <?php echo form_open('form/reset_password', array('class' => 'form-signin'))?>
                <h2 class="form-signin-heading">Reset Password</h2> 
                
                <?php echo $this->session->flashdata('error_msg'); ?>
                <p><?php echo 'Email: '.$email; ?></p>
                
                <?php echo form_error('password'); ?>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder=" Current Password" required value="<?php echo set_value('password'); ?>" />
                
                <?php echo form_error('passnew'); ?>
                <input type="password" name="passnew" id="inputPassword" class="form-control" placeholder="New Password" required value="<?php echo set_value('passnew'); ?>" />  
                         
                <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
                <br>
                <p>
                    <?php echo 'Back to  '.anchor("dashboard",'Dashboard')?>
                </p>
            </form>
        </div>
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

