<html>
    <head>
        <title>Resend Password</title>
        <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" />
        <link href="<?php echo base_url('bootstrap/myform.css');?>" rel="stylesheet">
    </head>
    
    <body>
        <div class="container">
            <?php echo form_open('form/resend_password', array('class' => 'form-signin'))?>
                <h2 class="form-signin-heading">Resend Password</h2> 
                
                <?php echo $this->session->flashdata('mail_msg'); ?>
                <?php echo $this->session->flashdata('error_msg'); ?>
                <?php echo form_error('email'); ?>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?php echo set_value('email'); ?>" />
                
<!--                <!?php echo form_error('password'); ?>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required value="<!?php echo set_value('password'); ?>" />
                
                <!?php echo form_error('passconf'); ?>
                <label for="inputPassword" class="sr-only">Password Confirm</label>
                <input type="password" name="passconf" id="inputPassword" class="form-control" placeholder="Password Confirm" required value="<!?php echo set_value('passconf'); ?>" />  -->
                         
                <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
                <br>
                <p>
                    <?php echo 'Back to Log In  '.anchor("login",'Log In')?>
                </p>
            </form>
        </div>
    </body>
</html>
