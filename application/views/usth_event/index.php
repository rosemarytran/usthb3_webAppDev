<div id="page-content-wrapper">
    <div class="container-fluid">  
        <div class="row">
            <div class="col-lg-12">
                <p><?php echo anchor("ictlab_info/index",'<< Back to ICTLab Infomation'); ?></P>
                <br>
                <p>Total <?=$num_events?> events.</p>
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($events)) : foreach($events as $event) :?>
                        <tr>
                            <td><?=$event->id?></td>
                            <td><?=$event->title?></td>
                            <td><?php echo substr($event->content, 0, 120).'...' ?></td>  
                            <td><?php echo anchor("usth_event/view/$event->id",'View') ?></td>
                        </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
                        <?php else :?>
                            <h1></h1>
                        <?php endif; ?>
                <!-- Pagination -->  
                <?php if(strlen($pagination)): ?>                               
                    <p>Pages: <?=$pagination?></p>              
                <?php endif; ?>
            </div>
        </div>     
    </div>
 </div>   
