<?PHP Core_Helper_Template::template("admin/block/header.php",$data);?>

<div id="site-container">
	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
		
			<?php echo $segment;?>
		</div>

		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>