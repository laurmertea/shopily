<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/public/css/main.css">
    <title><?php echo ($title) ?? defaultTitle();?></title>
</head>
<body>
    <?php if (isset($loggedIn) || isLoggedIn()) partial('nav');?>

    <div class="flex-center" style="min-height: 2em;">
        <?php if (hasMessage()) showHTMLMessage() ;?>
    </div>