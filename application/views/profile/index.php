<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">   
        <div class="row">
            <div class="col-lg-12">
                <?php if($level == 2): ?>
                    <?php if($me <> NULL): ?>
                        <h3><?php echo anchor("profile/update/$me->id",'Update My Profile') ?></h3>
                    <?php else : ?>
                        <h3><?php echo anchor("profile/create",'Create My Profile') ?></h3>
                    <?php endif; ?>
                <?php else : ?>
                        <h3><?php echo anchor("profile/create",'Create New Profile') ?></h3>
                <?php endif; ?>
            </div>
        </div>
<!-- table of all staffs-->
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <p>Total <?=$num_staffs?> staffs</p>
                <table class="table table-hover">
                    <thead>
                        <th>Photo</th>
                        <th>
                            <?php echo anchor ("profile/index/title/".
                                                (($sort_order == 'asc')? 'desc':'asc'),
                                                'Title') ?>
                        </th>
                        <th>Name</th>
                        <th>
                            <?php echo anchor ("profile/index/position/".
                                                (($sort_order == 'asc')? 'desc':'asc'),
                                                'Position') ?>
                        </th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php if(isset($staffs)) : foreach($staffs as $staff) :?>
                        <tr>
                            <td><img height="50" src="<?php echo base_url().'/uploads/'.$staff->photo;?>"/></td>
                            <td><?=$staff->title?></td>
                            <td><?=$staff->name?></td>
                            <td><?=$staff->position?></td>
                            <?php if($level == 2): ?>
                                <?php if($email == $staff->email): ?>
                                    <td>
                                        <?php echo anchor("profile/view/$staff->id",'View') ?> | 
                                        <?php echo anchor("profile/update/$staff->id",'Update') ?>
                                    </td>
                                <?php else : ?>
                                    <td><?php echo anchor("profile/view/$staff->id",'View') ?></td>
                                <?php endif; ?>
                            <?php else : ?>
                                <td>     
                                    <?php echo anchor("profile/view/$staff->id",'View') ?> | 
                                    <?php echo anchor("profile/update/$staff->id",'Update') ?> | 
                                    <?php echo anchor("profile/delete/$staff->id",'Delete') ?>
                                </td>                           
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
                        <?php else :?>
                            <h1>No staff.</h1>
                        <?php endif; ?>
                <!-- Pagination -->  
                <?php if(strlen($pagination)): ?>                               
                    <p>Pages: <?=$pagination?></p>              
                <?php endif; ?>
            </div>
        </div>     
    </div>
</div>
<!-- /#page-content-wrapper -->

