<div id="page-content-wrapper">
    <div class="container-fluid">   
        <?php if ($level == 1): ?>
            <h2>Public Information.</h2>
            <hr>
            <h3><?php echo anchor("news/manage",'Manage News >>') ?></p>
            <h3><?php echo anchor("usth_event/manage",'Manage Events >>') ?></p>
            <h3><?php echo anchor_popup("http://localhost/ICTLabWeb/allnews.php",'View on ICTLab Website >>') ?></p>
            <h2>Private Information.</h2>
            <hr>
            <h3><?php echo anchor("internal_calendar/index",'Manage Calendar >>') ?></p>          
        <?php else: ?>
            <h2>Public Information.</h2>
            <hr>
            <h3><?php echo anchor("news/index",'View News >>') ?></p>
            <h3><?php echo anchor("usth_event/index",'View Events >>') ?></p>
            <h3><?php echo anchor_popup("http://localhost/ICTLabWeb/allnews.php",'View on ICTLab Website >>') ?></p>
            <h2>Private Information.</h2>
            <hr>
            <h3><?php echo anchor("internal_calendar/index",'View Calendar >>') ?></h3>
        <?php endif; ?>
    </div>
</div>

