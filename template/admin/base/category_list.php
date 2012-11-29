<?PHP Admin_Block_Header::index($data);?>

<div id="site-container">

	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Categories");?>
			</h1>
			<form id="form" method="get">
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
								<?php foreach($parents as $parent):?>
								<option value="<?php echo $parent["type_id"];?>">
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
						<th><input value="<?php echo __("Filter");?>" type="submit"
							onclick="$('#form').submit();" /></th>
					</tr>
					<?php foreach($categories as $category):?>
					<tr>
						<td class="center"><input
							value="<?php echo $category["category_id"]?>" name="selected[]"
							type="checkbox" />
						</td>
						<td><?php echo $category["title"]?></td>
						<td><?php foreach($parents as $parent){ 
							echo $category["parent_id"]==$parent["category_id"]?$parent["title"]:__("No Parent");
						}?>
						</td>
						<td><?php echo $category["status"]?__("Enable"):__("Disable")?></td>
						<td class="center"><a
							href="<?php echo BASE_URL?>?action=admin/category/edit/<?php echo $category["category_id"]?>">Edit</a>
							<a
							href="<?php echo BASE_URL?>?action=admin/category/delete/<?php echo $category["category_id"]?>">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</form>
		</div>

		<?PHP Admin_Block_Footer::index($data);?>