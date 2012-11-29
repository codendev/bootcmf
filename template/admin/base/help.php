<?PHP new Admin_Block_Header($data);?>

<div id="site-container">

	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="font-20">Help</h1>
			<p class="padding-top10">Help</p>
		</div>
		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>