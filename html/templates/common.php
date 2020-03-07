<?php function doc_start($title, $stylesheets, $scripts) { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title><?=$title?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- JQuery, Popper and BootstrapJS scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/logo_tab.png">

        <?php foreach($stylesheets as $stylesheet) { ?>
            <link rel="stylesheet" href="../css/<?=$stylesheet?>.css">
        <?php } ?>
        
        <script src="../js/searchbar.js" defer></script>
        <?php foreach($scripts as $script) { ?>
            <script src="../js/<?=$script?>.js" defer></script>
        <?php } ?>
    </head>
    <body>
<?php } ?>

<?php function doc_end() { ?>
    </body>
    </html>
<?php } ?>

<?php function draw_header() { ?>
    <header>
        <nav class="navbar">
            <a class="navbar-brand" href="../pages/home.php"><img src="../assets/logo_text.svg" width="50" alt="LAMA logo" /></a>
            <form class="expandable-search">
                <input type="search" placeholder="Search" aria-label="Search"/>
            </form>
            <div class="d-flex align-items-center">
                <div class="dropdown d-flex align-items-center">
                    <span class="badge badge-pill badge-light mr-2">3</span>
                    <i class="fas fa-bell" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right notification-menu">
                        <?php draw_notification('bernas634 just commented your post'); ?>                     
                        <?php draw_notification('5 LAMA\'s have upvoted your post recently'); ?>                     
                        <?php draw_notification('Someone reported your post'); ?>                     
                        <?php draw_notification('un_lucky replied to your comment yesterday'); ?>                     
                        <?php draw_notification('There are 10 new posts on !Drunk'); ?>                     
                        <?php draw_notification('One of your posts just hit 1k comments. Congratulations!'); ?>               
                    </div>
                </div>
                <div class="dropdown" style="margin-left: 1em">
                    <img class="rounded-circle dropdown-toggle" data-toggle="dropdown" src="../assets/default_profile.png"
                        height="30">
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="../pages/profile.php">Profile</a>
                        <a class="dropdown-item" href="../pages/feed.php">Feed</a>
                        <a class="dropdown-item" href="../pages/reports.php">Reports</a>
                        <a class="dropdown-item" href="../pages/profile.php#blocked"><i class="fas fa-ban"></i> 49:30:06</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <form action="" id="collapsed-search" class="d-flex flex-row justify-content-center">
        <input type="search" placeholder="Search" aria-label="Search"/>
    </form>
    <div id="content">
<?php } ?>

<?php function draw_back_to_top() { ?>
    <i id="to-top" class="fas fa-arrow-alt-circle-up"></i>
<?php } ?>

<?php function draw_footer() { ?>
    </div>
    <footer id="footer" class="d-flex justify-content-between">
        <ul>
            <li>Contacts:</li>
            <li>lama@gmail.com</li>
            <li>+420 01 01 01 01</li>
            <li>Areosa, Porto</li>
        </ul>
        <ul>
            <li>About:</li>
            <li><a href="../pages/team.php">Team</a></li>
            <li><a href="../pages/regulations.php">Regulations</a></li>
        </ul>
    </footer>
<?php } ?>

<?php function draw_notification($text) { ?>
    <a class="dropdown-item text-wrap notification" href=""><?=$text?></a>
<?php } ?>