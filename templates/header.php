<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Mind Your Meds</title>
        <?php endif ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
        <script src="js/bootstrap.js"></script>
        
    </head>

    <body>

        <div class="container-fluid">

            <div id="middle">
            
            <!-- NAVBAR -->
                        
                <div>
                    <div data-dropdown="dropdown" class="topbar" id="navbar">
                        <ul class="nav nav-pills">
                                
                        </ul>                       
                    </div>
                </div>​
