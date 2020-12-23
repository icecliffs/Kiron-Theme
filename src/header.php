<?php
/*
Template Name:CPZZ
Description: 适用于中小学校、企业等的开源Emlog模板
Version:1.0.0
Author:Po7mn1
Author Url:https://www.icecliffs.cn
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $site_title; ?></title>
		<meta name="keywords" content="<?php echo $site_key; ?>">
		<meta name="description" content="<?php echo $site_description; ?>" />
        <meta name="generator" content="ICEBUILD" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/category.css">
		<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/slides.css">
		<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/articles.css">
		<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>/images/任意ico文件" type="image/x-icon">
		<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/auto-slides.js"></script>
        <link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
        <link href="<?php echo TEMPLATE_URL; ?>main.css" rel="stylesheet" type="text/css" />
        <?php doAction('index_head'); ?>
	</head>
	<body>
    <div class="container">			
        <header>
            <div class="l-logo">
                <img src="<?php echo TEMPLATE_URL;?>/images/fjjjzx-logo.png" alt="福建省晋江职业中专">
            </div>
            <div class="l-fonts">
				<p id="h-title"><?php echo $blogname; ?></p>
				<p id="h-title-des"><?php echo $bloginfo; ?></p>
            </div>
        </header>
            <?php blog_navi();?>
            <div class="content">