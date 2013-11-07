<?php
    
    include( 'paramimg/paramimg-functions.php' );
    
?><!DOCTYPE html>
<html>
    <head>
        <title>Parameter-Images</title>
        <meta charset="utf-8"/>
        
        <style rel="stylesheet" type="text/css">
            
        </style>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="paramimg/paramimg.js" type="text/javascript"></script>
        <script type="text/javascript">
        
        </script>

    </head>
    <body>
        
        <?php
            
            $param = array(
                'id' => 'test',
                'param' => array(
                    'test' => 'test'
                ),
                'src' => '/images/jpg/square.jpg'
            );
            echo paramimg_get_image( $param );
            
        ?>
        
    </body>
</html>
