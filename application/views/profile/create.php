<div id="page-content-wrapper">
    <div class="container-fluid">
        <h1> Create profile </h1>
        <?php echo validation_errors(); ?>

        <?php echo form_open_multipart('profile/upload');?>
            <?php if ($level == 1): ?>
                <input type="email" name="email" placeholder="Email" required autofocus value="<?php echo set_value('email'); ?>" size="50" />          
                <br/><br/>
            <?php else : ?>
                <p><?php echo 'Email: '.$email; ?></p>                        
            <?php endif; ?>
            <input type="text" name="name" placeholder="Full name" required autofocus value="<?php echo set_value('name'); ?>" size="50" />          
            <br/><br/>
            <input type="file" name="photo" required autofocus size="20" />
            <br/>
            <input type="text" name="title" placeholder="Title" required autofocus value="<?php echo set_value('title'); ?>" size="50"/>
            <br/><br/>
            <input type="text" name="position" placeholder="Position" required autofocus value="<?php echo set_value('position'); ?>" size="50"/>
            <br/><br/>
            <input type="text" name="affiliation" placeholder="Affiliation" required autofocus value="<?php echo set_value('affiliation'); ?>" size="50"/>
            <br/><br/>
            <textarea type="text" name="publication" placeholder="List of publications (seperated by ; )" value="<?php echo set_value('publication'); ?>" ></textarea>
            <br/><br/>
            <textarea type="text" name=" supervised_student" placeholder="List of supervised students (seperated by ; )" value="<?php echo set_value('supervised_student'); ?>" ></textarea>
            <br/><br/>
            <textarea name="r_project" placeholder="List of participated reasearch projects (seperated by ; )" value="<?php echo set_value('r_project'); ?>"></textarea>
            <br/><br/>
            <input type="submit" value="Submit" />
        </form>
    </div>
</div>
