<?php
include_once './includes/config.session.inc.php';
if (!isset($_SESSION["user_id"])) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Login and Registration Form in HTML & CSS</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <h2>
            <?php if (true) : ?>
                <p class="lead mt3">Well Come!... <?php echo session_id(); ?></p>
                <p class="lead mt3">Well Come!... <?php print_r($_SESSION); ?></p>
            <?php endif; ?>
        </h2>
        <a href="includes/logout.inc.php"> Logout </a>

    </div>
</body>


</html>