<html>
    <head>
        <title>Upload Form</title>
    </head>
    <body>

        <h3>Your file was successfully uploaded!</h3>
        <img src="data:image/jpeg;base64,<?php echo ''.base64_encode($photo['content']).''; ?>" />
        <img src="<?php echo base_url().'/uploads/'.$photo['name'];?>"/>
        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo['content']).'"/>'; ?>
        <p><?php echo ''.base64_encode($photo['content']).'';?></p>
    </body>
</html>