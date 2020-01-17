<html>
    <head>
        <title>Print Dokumen</title>
        <link href="<?php echo URL; ?>public/css/print.css" rel="stylesheet">
    </head>
    <body onload="javascript:window.print()">
        <?php require VIEWS_PATH . $filename . '.php'; ?>
    </body>
</html>
