<?PHP Core_Helper_Template::template("admin/block/header.php",$data);?>

<div id="site-container">

	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Taxonomies");?>
			</h1>
			<form id="form" method="get">
				<table class="list">
					<tr>
						<th><input id="list-ckbx" type="checkbox"
							onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
						</th>
						<th class="left">Title</th>
						<th class="left"><?php echo __("Status");?></th>
						<th class="center"><?php echo __("Action");?></th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input name="title" type="text" value="" /></td>
						<td><select id="status" name="status">
								<option value="1">
									<?php echo __("Enable")?>
								</option>
								<option value="0">
									<?php echo __("Disable")?>
								</option>
						</select>
						</td>
						<th><input value="<?php echo __("Filter");?>" type="submit" onclick="$('#form').submit();" /></th>
					</tr>
					<?php foreach($tags as $tag):?>
					<tr>
						<td class="center"><input
							value="<?php echo $tag["taxonomy_id"]?>" name="selected[]"
							type="checkbox" />
						</td>
						<td><?php echo $tag["title"]?></td>
						<td><?php echo $tag["status"]?__("Enable"):__("Disable")?></td>
						<td class="center"><a
							href="<?php echo BASE_URL?>?action=admin/taxonomy/tag/edit/<?php echo $tag["tag_id"]?>">Edit</a>
							<a
							href="<?php echo BASE_URL?>?action=admin/taxonomy/tag/delete/<?php echo $tag["tag_id"]?>">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</form>
		</div>

		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>