<?php
global $site_url;

global $page_url;
global $page_slug;
global $page_name;
global $page_dsc;

global $parent_name;

global $page_css;
global $add_css;

global $version;

// META
$site_tit = '福岡市立児童心理治療施設';

if($page_slug == 'top') {
  $page_tit = $site_tit;
} elseif (isset($grand_name)) { //第4階層
	$page_tit = $page_name . '｜' . $parent_name . '｜' . $grand_name . '｜' . $site_tit;
} elseif (isset($parent_name)) { //第3階層
  $page_tit = $page_name . '｜' . $parent_name . '｜' . $site_tit;
} else { //第2階層
  $page_tit = $page_name . '｜' . $site_tit;
}

//canonical
$site_htp = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
$site_url = $site_htp . $_SERVER["SERVER_NAME"];
$page_url = $site_htp . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

//description
if( !isset($page_dsc) ) $page_dsc = '福岡市立児童心理治療施設のホームページです';

//version
$version = '?v=' . date("Ymd-His");
?>
<!DOCTYPE html>
<html lang="ja">

<head>

  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width">
  
  <meta name="format-detection" content="telephone=no,address=no,email=no">

<!-- web font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500&family=Zen+Maru+Gothic:wght@700&display=swap" rel="stylesheet">

<!-- web icon -->

<!-- css -->
<link rel="stylesheet" href="<?php echo $site_url; ?>/assets/css/common.min.css<?php echo $version; ?>">

<?php if(isset($page_css)) : ?>
  <link rel="stylesheet" href="/assets/css/<?php echo $page_css; ?>.min.css<?php echo $version; ?>">
<?php endif; ?>

<?php if( isset($add_css) ) echo $add_css; ?>


<!-- js -->
  <link rel="prefetch" href="<?php echo $site_url; ?>/assets/js/jquery.min.js" as="script">
  <link rel="prefetch" href="<?php echo $site_url; ?>/assets/js/base.js" as="script">
  <script src="<?php echo $site_url; ?>/assets/js/jquery.min.js"></script>

  <meta name="description" content="<?php echo $page_dsc; ?>">
	<meta property="og:description" content="<?php echo $page_dsc; ?>">

  <link rel="canonical" href="<?php echo $page_url; ?>">
  <meta property="og:title" content="<?php echo $page_tit; ?>">
  <meta property="og:url" content="<?php echo $page_url; ?>">
  <meta property="og:type" content="<?php if ($page_slug == 'top') : ?>website<?php else : ?>article<?php endif ; ?>">
  <meta property="og:image" content="<?php echo $site_url; ?>/assets/img/common/ogp.png">
  <meta name="twitter:card" content="summary_large_image">


  <meta name="copyright" content="Copyright © ">

<!-- icon -->
  <link rel="shortcut icon" href="<?php echo $site_url; ?>/favicon.ico">
  <link rel="apple-touch-icon" href="<?php echo $site_url; ?>/assets/img/common/apple_touch_icon.png">


  <title><?php echo $page_tit; ?></title>
</head>


<body>

<!-- ヘッダーここから -->
<header class="header">
</header>