<div id="page-content-wrapper">
    <div class="container-fluid">
        <h1> Update profile </h1>

        <?php echo form_open_multipart('profile/do_update');?>
            <input type="id" name="id" placeholder=ID" required autofocus value="<?php echo $staff->id; ?>" size="50" />          
            <br/><br/> 
            <input type="email" name="email" placeholder="Email" required autofocus value="<?php echo $staff->email; ?>" size="50" />          
            <br/><br/>        
            <input type="text" name="name" placeholder="Full name" required autofocus value="<?php echo $staff->name; ?>" size="50" />          
            <br/><br/>
            <input type="file" name="photo" required autofocus size="20" />
            <br/>
            <input type="text" name="title" placeholder="Title" required autofocus value="<?php echo $staff->title; ?>" size="50"/>
            <br/><br/>
            <input type="text" name="position" placeholder="Position" required autofocus value="<?php echo $staff->position; ?>" size="50"/>
            <br/><br/>
            <input type="text" name="affiliation" placeholder="Affiliation" required autofocus value="<?php echo $staff->affiliation; ?>" size="50"/>
            <br/><br/>
            <textarea type="text" name="publication" placeholder="List of publications (seperated by ; )" value="<?php echo $staff->publication; ?>" ></textarea>
            <br/><br/>
            <textarea type="text" name=" supervised_student" placeholder="List of supervised students (seperated by ; )" value="<?php echo $staff->supervised_student; ?>" ></textarea>
            <br/><br/>
            <textarea name="r_project" placeholder="List of participated reasearch projects (seperated by ; )" value="<?php echo $staff->r_project; ?>"></textarea>
            <br/><br/>
            <input type="submit" value="Update" />
        </form>
    </div>
</div>

