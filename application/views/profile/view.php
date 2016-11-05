<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">      
        <h3><?php echo $staff->name ?></h3>
        <p><?php echo $staff->title ?></p>
        <p><?php echo $staff->position ?></p>
        <p><?php echo $staff->affiliation ?></p>
        <img src="<?php echo base_url().'/uploads/'.$staff->photo;?>"/>
        <?php if($email == $staff->email): ?>
            <p><?php echo anchor("profile/update/$staff->id",'Update') ?></p>
        <?php endif; ?>    
        <?php if($level == 1): ?>
            <p>     
                <?php echo anchor("profile/update/$staff->id",'Update') ?>
                <?php echo anchor("profile/delete/$staff->id",'Delete') ?>
            </p>
        <?php endif; ?>       
    </div>
</div>
<!-- /#page-content-wrapper -->

