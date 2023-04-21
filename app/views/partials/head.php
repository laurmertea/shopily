<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <title><?php echo ($title) ?? defaultTitle();?></title>
</head>
<body>
    <?php if (isset($loggedIn) || isLoggedIn()) partial('nav');?>

    <div class="flex-center" style="min-height: 2em;">
        <?php if (hasMessage()) showHTMLMessage() ;?>
    </div>