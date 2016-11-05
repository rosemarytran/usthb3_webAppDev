<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" />
        <link href="<?php echo base_url('bootstrap/myform.css');?>" rel="stylesheet">
    </head>
    
    <body>
        <div class="container">
            <?php echo form_open('form/login', array('class' => 'form-signin'))?>
                <h2 class="form-signin-heading">Please log in</h2> 
                
                <?php echo form_error('email'); ?>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?php echo set_value('email'); ?>" />

                <?php echo form_error('password'); ?>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required value="<?php echo set_value('password'); ?>" />
                
                <h4>Level  
                    <span>
                        <select name="level">
                            <option value="1">Administrator</option>
                            <option value="2">Staff</option>
                        </select>
                    </span>
                </h4>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                <br>
                <p><?php echo 'Don\'t have an account?  '.anchor("signup",'Sign Up')?></p>
                <p><?php echo 'Forget your password?  '.anchor("form/#",'Send me a new one')?></p>
            </form>
        </div>
    </body>
</html>

