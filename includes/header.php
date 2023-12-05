<?php

require 'config/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php if(isset($pageTitle)) {echo $pageTitle;} else{echo webSetting('title') ?? 'Device Services';}?></title>
    <meta name="description" content="<?=webSetting('meta_description') ?? 'Meta Desc';?>">
    <meta name="keyword" content="<?=webSetting('meta_keyword') ?? 'Meta Keyword';?>">

   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
  <?php include('navbar.php') ?>