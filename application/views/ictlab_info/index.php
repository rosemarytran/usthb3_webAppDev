<div id="page-content-wrapper">
    <div class="container-fluid">   
        <?php if ($level == 1): ?>
            <h2>Public Information.</h2>
            <hr>
            <h3><?php echo anchor("news/manage",'Manage News') ?></p>
            <h3><?php echo anchor("usth_event/manage",'Manage Events') ?></p>
            <h2>Private Information.</h2>
            <hr>
        <?php else: ?>
            <h2>Public Information.</h2>
            <hr>
            <h3><?php echo anchor("news/index",'View News >>') ?></p>
            <h3><?php echo anchor("usth_event/index",'View Events >>') ?></p>
            <h2>Private Information.</h2>
            <hr>
        <?php endif; ?>
    </div>
</div>

