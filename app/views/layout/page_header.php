<!DOCTYPE html> 
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="<?=$appRoot ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?=$appRoot ?>/css/modal.css">
<title><?=$appName ?></title>
</head>
<body>
<div class="wrapper">
<div id="navbar">
    <div><?=$appName ?> - <?= $userName ?></div>
    <div class="push-right">
        <a class="menu-item" href="<?= $appRoot ?>">HOME</a>&nbsp
<?php foreach($appMenu as $_label => $_action) { ?> 
    <a class="menu-item" href="<?= $appRoot . $_action ?>"><?= $_label ?></a>&nbsp;
<?php } ?>
    </div>
</div>
