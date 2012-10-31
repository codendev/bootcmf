<?PHP load_template("admin/element/header.php",$data);?>

<div id="site-container">

	<div class="content">
		<div class="sidebar">
			<?PHP load_template("admin/element/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Taxonomies");?>
			</h1>

			<table class="list">
				<tr>
					<th><input id="list-ckbx" type="checkbox"
						onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
					</th>
					<th class="left">Title</th>
					<th class="left">Parent</th>
					<th class="left"><?php echo __("Status");?></th>
					<th class="center"><?php echo __("Action");?></th>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="title" type="text" value="" /></td>
					<td><select id="parent_id" name="parent_id">
							<option value="0">
								<?php echo __("No parent")?>
							</option>
							<?php foreach($taxonomies as $parent):?>
							<option value="<?php echo $parent["taxonomy_id"];?>">
								<?php echo $parent["title"];?>
							</option>
							<?php endforeach;?>
					</select></td>
					<td><select id="status" name="status">
							<option value="1">
								<?php echo __("Enable")?>
							</option>
							<option value="0">
								<?php echo __("Disable")?>
							</option>
					</select>
					</td>
					<th><button><?php echo __("Filter");?></button></th>
				</tr>
				<?php foreach($taxonomies as $taxonomy):?>
				<tr>
					<td class="center" ><input value="<?php echo $taxonomy["taxonomy_id"]?>"
						name="selected[]" type="checkbox" />
					</td>
					<td><?php echo $taxonomy["title"]?></td>
					<td><?php echo $taxonomy["parent_id"]?></td>
					<td><?php echo $taxonomy["status"]?></td>
					<td class="center"><a href="<?php echo BASE_URL?>?action=admin/taxonomy/index/edit/<?php echo $taxonomy["taxonomy_id"]?>">Edit</a> 
					<a href="<?php echo BASE_URL?>?action=admin/taxonomy/index/delete/<?php echo $taxonomy["taxonomy_id"]?>">Delete</a></td>
				</tr>
				<?php endforeach;?>
			</table>

		</div>

		<?PHP load_template("admin/element/footer.php",$data);?>