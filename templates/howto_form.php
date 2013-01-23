<div>
    <table class="table" align="center">

        <thead></thead>

        <tr><td>Welcome to Mind Your Meds! This website aims to help you keep track of all of your medications,
            allowing you to keep them organized in an easy-to-navigate website. You can control how you want to be notified of 
            the medications you need to take. Like Fitocracy, MYM is based on a point system, so the more medications you remember to
            take, the more points you earn!</td></tr>
            
    </table>
    
    <table class="table table-striped" align="center">
        
        <tr><td width="50%">
            <div align="center"><b><i><font size="4">Signing Up</font></i></b></div></br>
            <div>Find your way over to <a href="register.php">Register</a> to sign up for an account! Please be sure that your username doesn't 
                contain any weird characters like apostrophes. You have the choice of inputting a phone number if you wish. Make sure to select
                the correct carrier! Don't worry if you decide not to input a phone number; you will have the option of adding one later.
                After you register, you will receive an email, and you'll be ready to begin logging
                your medications!</div></td>
            <td width="50%"><center><img alt="Register" src="img/register.png"/></center></td>
        </tr>
        
        <tr><td width="50%"><center><img alt="Homepage" src="img/home.png"/></center></td>
            <td width="50%">
            <div align="center"><b><i><font size="4">Your Homepage</font></i></b></div></br>
            <div>Welcome to your homepage! This page will show you all the information you need to stay informed about your account. You will
            find information such as 1) how many medications you have organized in the log, 2) your score, and 3) how you performed yesterday. You
            can always come back to this page to see this basic information.</div></td>
                
        <tr><td width="50%">
            <div align="center"><b><i><font size="4">Adding Medications</font></i></b></div></br>
            <div>Now that you're signed in, you're ready to create a medicine log! Navigate your way over to <a href="add.php">Add a Medicine</a>
            and fill out your form as many times as you need to. Check the box for Set a Reminder if you want to set notifications right now for
            the medicine you're adding. If not, don't fret...you can always go add/change notifications later! You can then go to your 
            <a href="medlist.php">Medicine List</a> and see all your medications there. If you don't need to take a medicine anymore, or if you 
            made a mistake, you can delete the medicine right from your list!</div></td>
            <td width="50%"><center><img alt="Add" src="img/add.png"/></center></td>
        </tr>
        
        <tr><td width="50%"><center></br></br><img alt="Add" src="img/hs.png"/></center></td>
            <td width="50">
            <div align="center"><b><i><font size="4">Earning Points</font></i></b></div></br>
            <div>Every time you take your medicine, be sure to visit <a href="today.php">Today's Meds</a> and check it off! You will earn a 
            point every time you remember to take a medicine. However, at the end of the day, you'll lose a point per medicine you didn't take!
            If you want to find out where you stand in relation to the other users of Mind Your Meds, go to the <a href="highscores.php">
            High Scores</a> and look for your username!</div></td>
        </tr>            

        <tr><td width="50%">
            <div align="center"><b><i><font size="4">Managing Notifications</font></i></b></div></br>
            <div>If you want to see information about the notifications you have so far (for example, all the notifications you've logged, what 
            drugs they correspond to, and whether it's an email and/or phone notification), then head over to Manage Your Account -> <a 
            href="list.php">Notifications</a>. Here, you can add more notifications or change/delete existing notifications.</div></td>
            <td width="50%"><center></br></br><img alt="Add" src="img/not.png"/></center></td>
        </tr>
        
        
            
    </table>
</div>

<div>
    </br>
    <?php
        if(empty($_SESSION["id"]))
            print("<a href=\"login.php\">Log in</a>");
    ?>
</div>
