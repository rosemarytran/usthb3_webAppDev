<div id="page-content-wrapper">
    <div class="container-fluid">  
        <div class="row">
            <div class="col-lg-12">
                <p><?php echo anchor("ictlab_info/index",'<< Back to ICTLab Infomation'); ?></P>
                <br>
                <p>Total <?=$num_news?> news.</p>
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if(isset($news)) : foreach($news as $new) :?>
                        <tr>
                            <td><?=$new->id?></td>
                            <td><?=$new->title?></td>
                            <td><?php echo substr($new->content, 0, 120).'...' ?></td>  
                            <td><?php echo anchor("news/view/$new->id",'View') ?></td>
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

