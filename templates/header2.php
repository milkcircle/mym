<!DOCTYPE html>

<html>

    <head>
    
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Mind Your Meds</title>
        <?php endif ?>

        <script src="js/jquery-1.8.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
        <script type="text/javascript" src="js/validate.jquery.js"></script>
        
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
        
        <!--JAVASCRIPT-->
        
            <!--about-->
            <script>
            $(document).ready(function(){
                $('.about').click(function() {
                    $('#regtoggle').slideUp('slow');
                    $('#pwtoggle').slideUp('slow');
                    $('#logintoggle').slideUp('slow'); 
                    $('#pwtoggle2').slideUp('slow');
                    $('#abouttoggle').slideDown('slow');
                    $('#apology').slideUp('slow'); 
                    $('#pwtoggle3').slideUp('slow');
                });
            });
            </script>        
            
            <!--login form-->
            <script>
            $(document).ready(function(){
                $('.login').click(function() {
                    $('#regtoggle').slideUp('slow');
                    $('#pwtoggle').slideUp('slow');
                    $('#logintoggle').slideDown('slow'); 
                    $('#pwtoggle2').slideUp('slow');
                    $('#abouttoggle').slideUp('slow');
                    $('#apology').slideUp('slow'); 
                    $('#pwtoggle2').slideUp('slow');
                });
            });
            </script>
            
            <!--register form-->
            <script>
            $(document).ready(function(){
                $('#register').click(function() {
                    $('#logintoggle').slideUp('slow');
                    $('#pwtoggle').slideUp('slow');
                    $('#pwtoggle2').slideUp('slow');
                    $('#regtoggle').slideDown('slow');
                    $('#abouttoggle').slideUp('slow');
                    $('#apology').slideUp('slow'); 
                    $('#pwtoggle2').slideUp('slow');
                });
            });
            </script>
            
            <!--pwreset form-->
            <script>
            $(document).ready(function(){
                $('#pwreset').click(function() {
                    $('#logintoggle').slideUp('slow');
                    $('#regtoggle').slideUp('slow');
                    $('#pwtoggle2').slideUp('slow');
                    $('#pwtoggle').slideDown('slow');
                    $('#abouttoggle').slideUp('slow');
                    $('#apology').slideUp('slow'); 
                    $('#pwtoggle2').slideUp('slow');
                });
            });
            </script>
        
    </head>

    <body>

        <div class="container-fluid">

            <div id="middle">
            
            <!-- NAVBAR -->
                <div>
                    <div data-dropdown="dropdown" class="topbar" id="navbar">
                        <span class="alignleft"><b>MYM</b></span>
                        <span class="middle">
                            <ul class="nav nav-pills">
                                <li><a href="#" class="about">ABOUT</a></li>
                                <li><a href="#" class="login">LOGIN</a></li>
                                <li><a href="#" id="register">REGISTER</a></li>
                            </ul>    
                        </span>
                    </div>
                </div>​
                
            <!-- LOGO -->
                <br><br>
                <div id="logo">
                    <font size="7">Mind Your Meds</font>
                </div>
                <br><br>
                
            <!-- ABOUT -->
                <div style="display: block; width:400px; margin:0 auto;"" id="abouttoggle">
                    <font size="4">Put your health first. Never forget a dose of medication again.<br><br>
                    <span>What can you do with Mind Your Meds?</span><br><br>
                    <center>
                        &#149; Register your medications.<br>
                        &#149; Set up email/text notifications.<br>
                    </ul></center><br>
                    <span>With this simple and intuitive application, log your medications quickly and easily.
                    Our notification system will make sure you remember to take your medication.</span></font><br><br>
                </div>
                
            <!-- LOGIN FORM -->
            
                <script>
                    $(document).ready(function() {
                        $('#loginform').validate({
                            rules: {
                                password: 'required',
                                username: 'required',
                            }
                        })
                    });
                    
                    $(document).ready(function(){
                        $('.ajaxform').submit(function() {

                            $.ajax({
                                url     : $(this).attr('action'),
                                type    : $(this).attr('method'),
                                data    : $(this).serialize(),
                                success : function( data ) {
                                    if (data == "Valid login")
                                        location.href = "index.php";
                                    else
                                        alert(data);
                                        $('.ajaxform')[0].reset();
                                    },
                                error   : function(){
                                             alert(data);
                                             $('.ajaxform')[0].reset();
                                          }
                            });
                            return false;
                        });

                    });
                    
                </script>
            
                <div style="display: none" id="logintoggle">
                    <form method="post" id="loginform" action="login.php" class="ajaxform">
                        <label for="email"></label>
                        <input autofocus placeholder="Email" type="text" id="email" name="email" class="required input_field" />
                        <div class="cleaner"></div>
                        <br>
                        <label for="password"></label>
                        <input placeholder="Password" type="password" id="password" name="password" class="required input_field">
                        <div class="cleaner"></div>
                        <br>
                        <button type="submit" class="btn" name="submit" id="submit">Log In</button>
                    </form>
                </div>
                
            <!-- REGISTER FORM -->
            
                <script>
                    $(document).ready(function() {
                        $('#registerform').validate({
                            rules: {
                                password: 'required',
                                email: 'required',
                                confirmation: {
                                    equalTo: "#password1",
                                }                               
                            }
                        })
                    });
                </script>
                
                <div style="display: none" id="regtoggle">
                    <form action="register.php" method="post" id="registerform">
                        <fieldset>
                            <div class="control-group">
                                <label for="email"></label>
                                <input autofocus name="email" placeholder="*Email" type="text" id="email" class="required input_field"/>
                            </div>
                            <div class="control-group">
                                <label for="password"></label>
                                <input name="password" placeholder="*Password" type="password" id="password1" class="required input_field"/>
                            </div>
                            <div class="control-group">
                                <label for="confirmation"></label>
                                <input name="confirmation" placeholder="*Repeat:" type="password" id="confirmation" class="required input_field"/>
                            </div>                           
                            <div class="control-group">
                                </label for="phone"></label>
                                <input name="phone" placeholder="10 digit phone # (optional)" type="text" id="phone"/>
                                
                                <!--
                                <table align="center"><tr><td align="left">
                                </label for="carrier"></label>
                                <input type="radio" name="carrier" value="Verizon" id="carrier"> Verizon
                                </td></tr><tr><td align="left">
                                <input type="radio" name="carrier" value="ATT" id="carrier"> AT&T
                                </td></tr><tr><td align="left">
                                <input type="radio" name="carrier" value="T-Mobile" id="carrier"> T-Mobile
                                </td></tr>
                                </table>
                                -->
                                
                            </div>
                            <div class="control-group">
                                <button type="submit" class="btn">Register</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                
            <!-- PW RESET FORM -->
            
            <div style="display:none" id="pwtoggle">
                <form action="pwreset.php" method="post">
                    <fieldset>
                        <div class="control-group">
                            <input autofocus name="email" placeholder="Email address" type="text"/>
                        </div>
                        <div class="control-group">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
