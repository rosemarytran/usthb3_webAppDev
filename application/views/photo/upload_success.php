<html>
    <head>
        <title>Upload Form</title>
    </head>
    <body>

        <h3>Your file was successfully uploaded!</h3>
        <img src="data:image/jpg;base64,<?php echo base64_encode( $photo['content'] ); ?>" />
        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $photo['content'] ).'"/>'; ?>
        <p><?php echo anchor('photo', 'Upload Another File!'); ?></p>

    </body>
</html>