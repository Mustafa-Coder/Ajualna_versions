<!DOCTYPE html>
<?php if (isset($_SESSION['id'])):?>
<html lang="en" <?php echo $Userinfor['languages'] == 'ar' ? "dir='rtl'" : "dir='ltr'" ?>>
<?php else:?>
<html lang="en">
<?php endif;?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./layout/images/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./layout/css/all.min.css">
    <link rel="stylesheet" href="./layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="./layout/css/main.css">
    <link rel="stylesheet" href="./layout/css/animate.css">
    <title><?php title() ?></title>
</head>
<body>
 