<!DOCTYPE html>
<html lang="en">
<head>
<meta name="description"
	content=<?php echo isset($metaDescription)?$metaDescription:"" ?> />
<meta name="keywords"
	content="<?php echo isset($metaKeywords)?$metaKeywords:"" ?>" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=utf-8" />
<meta name="generator" content="CodenStark" />
<meta name="robots" content="noindex,nofollow" />
<link rel="icon" type="image/png"
	href="<?PHP echo ADMIN_SKIN_URL;?>images/fav.ico">
<title><?php echo isset($metaTitle)?$metaTitle:"" ?>
</title>
<script
	src="<?PHP echo BASE_URL;?>js/jquery-ui-1.9.0.custom/js/jquery-1.8.2.js"></script>
<script
	src="<?PHP echo BASE_URL;?>js/jquery-ui-1.9.0.custom/js/jquery-ui-1.9.0.custom.min.js"></script>
<link rel="stylesheet"
	href="<?PHP echo BASE_URL;?>js/jquery-ui-1.9.0.custom/css/smoothness/jquery-ui-1.9.0.custom.min.css">
<link rel="stylesheet" type="text/css"
	href="<?PHP echo ADMIN_SKIN_URL;?>css/style.css">
<script>

$(function() {
	$( "input[type=submit], button" )
	.button()
	.click(function( event ) {
		event.preventDefault();
	});
	}); 
	
</script>

</head>
<body>
	<div id="wrapper">
		<header>
			<div class="container">
				<div class="logo">
					<a href="index.php"><img
						src="<?PHP echo ADMIN_SKIN_URL;?>images/logo.png" alt="codendev" />
					</a>
				</div>
				<div class="clear"></div>
			</div>


		</header>