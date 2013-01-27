<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link href="css/timepicker.css" rel="stylesheet"/>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Mind Your Meds</title>
        <?php endif ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/timepicker.js"></script>
        
    </head>

    <body>
        <div class="container-fluid">
            <div class="navbar navbar-top">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand mym" href="index.php">Mind Your Meds</a>
                  <div class="nav-collapse collapse">
                    <ul class="nav">
                        <?php
                        if (!empty($_SESSION["u_id"]))
                        {
                            echo '<li><a href="add_medication.php">Add Medication</a></li>';
                            echo '<li><a href="edit_account_details.php">Account Details</a></li>';
                            echo '<li><a href="medication_list.php">Current Medications</a></li>';
                            echo '<li><a href="logout.php">Log Out</a></li>';
                        }
                        ?>
                    </ul>
                  </div><!--/.nav-collapse -->
                </div>
              </div>
            </div>

    <br/>
    <br/>
    <br/>
            <div id="middle">
