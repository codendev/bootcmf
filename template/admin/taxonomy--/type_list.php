<?PHP Core_Helper_Template::template("admin/block/header.php",$data);?>

<div id="site-container">

	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Taxonomy Types");?>
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
					<?php foreach($taxonomies as $type):?>
					<tr>
						<td class="center"><input value="<?php echo $type["type_id"]?>"
							name="selected[]" type="checkbox" />
						</td>
						<td><?php echo $type["title"]?></td>
						<td><?php $found="";
						foreach($parents as $parent){
							if($type["parent_id"]==$parent["type_id"]){

								$found=$parent["title"];
							}
						}
						echo !empty($found)?$found:__("No Parent");
						?>
						</td>
						<td><?php echo $type["status"]?__("Enable"):__("Disable")?></td>
						<td class="center"><a
							href="<?php echo BASE_URL?>?action=admin/type/index/edit/<?php echo $type["type_id"]?>">Edit</a>
							<a
							href="<?php echo BASE_URL?>?action=admin/type/index/delete/<?php echo $type["type_id"]?>">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</form>
		</div>

		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>