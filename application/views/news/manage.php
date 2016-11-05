<html>
    <head> 
        <meta charset="utf-8" />
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
    </head>
    <body>
        <div>
            <?php echo anchor("news/index",'<< Back to ICTLab Infomation'); ?>
        </div>
        <br>
        <div>
            <?php echo $output; ?>
        </div>
    </body>
</html>

