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

    <?php foreach($stylesheets as $stylesheet) { ?>
        <link rel="stylesheet" href="../css/<?=$stylesheet?>.css">
    <?php } ?>

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
            <a class="navbar-brand" href="../pages/home.php"><img src="../assets/logo.png" width="30" alt="LAMA logo" /></a>
            <form class="form-inline">
                <input class="form-control search-bar" type="search" placeholder="Search" aria-label="Search"/>
            </form>
            <div class="d-flex align-items-center">
                <div class="dropdown d-flex align-items-center">
                    <span class="badge badge-pill badge-light mr-2">3</span>
                    <i class="fas fa-bell" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <div class="dropdown" style="margin-left: 1em">
                    <img class="rounded-circle dropdown-toggle" data-toggle="dropdown" src="../assets/logo.png"
                        height="30">
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Feed</a>
                        <a class="dropdown-item" href="#">Reports</a>
                        <a class="dropdown-item" href="#">Time</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        <div></div>
    </header>
    <div id="content">
<?php } ?>

<?php function draw_back_to_top() { ?>
    <i id="toTop" class="fas fa-arrow-alt-circle-up"></i>
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
            <li>Regulations</li>
        </ul>
    </footer>
<?php } ?>
