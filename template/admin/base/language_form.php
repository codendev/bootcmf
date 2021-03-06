<?PHP Core_Helper_Template::template("admin/block/header.php",$data);?>

<div id="site-container">
	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Add/Edit Taxonomy Type");?>
			</h1>
			<div style="color: orange; padding: 10px;">
				<?php if(isset($added)){ 
					echo __("Entry created sucessfully");
}?>
				<?php if(isset($updated)){ 
					echo __("Entry updated sucessfully");
}?>
			</div>

			<form method="post" class="form">
				<table>
					<tr>
						<td><?php echo __("Title");?></td>
						<td><input id="title" name="title" type="text"
							value="<?php echo $title; ?>" />
						</td>
					</tr>
					<tr>
						<td><?php echo __("ISO639-1");?></td>
						<td><input id="iso6391" name="title" type="text"
							value="<?php echo $iso6391; ?>" />
						</td>
					</tr>
					<tr>
						<td><?php echo __("ISO639-2");?></td>
						<td><input id="iso6392" name="title" type="text"
							value="<?php echo $iso6392; ?>" />
						</td>
					</tr>
					<tr>
						<td><?php echo __("Status");  ?></td>
						<td><select id="status" name="status">
								<option value="1" <?php echo $status==1?"selected":"";?>>
									<?php echo __("Enable")?>
								</option>
								<option value="0" <?php echo $status==0?"selected":"";?>>
									<?php echo __("Disable")?>
								</option>
						</select>
						</td>
					</tr>
					<tr>
						<td><input value="<?php echo __("Save");?>" type="submit"
							onclick="$('.form').submit();" /></td>
					</tr>
				</table>
			</form>

		</div>

		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>