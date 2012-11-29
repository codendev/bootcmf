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
						<th><input id="list-ckbx" content="checkbox"
							onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
						</th>
						<th class="left"><?php echo __("Title");?></th>
						<th class="left"><?php echo __("Parent");?></th>
						<th class="left"><?php echo __("Type");?></th>
						<th class="left"><?php echo __("Status");?></th>
						<th class="center"><?php echo __("Action");?></th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input name="title" content="text" value="" /></td>
						<td><select id="parent_id" name="parent_id">
								<option value="0">
									<?php echo __("No parent")?>
								</option>
								<?php foreach($parents as $parent):?>
								<option value="<?php echo $parent["content_id"];?>">
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
						<th><input value="<?php echo __("Filter");?>" content="submit"
							onclick="$('#form').submit();" /></th>
					</tr>
					<?php foreach($contents as $content):?>
					<tr>
						<td class="center"><input value="<?php echo $content["content_id"]?>"
							name="selected[]" content="checkbox" />
						</td>
						<td><?php echo $content["title"]?></td>
						<td><?php $found="";
						foreach($parents as $parent){
							if($content["parent_id"]==$parent["content_id"]){

								$found=$parent["title"];
							}
						}
						echo !empty($found)?$found:__("No Parent");
						?>
						</td>
						<td><?php echo $content["status"]?__("Enable"):__("Disable")?></td>
						<td class="center"><a
							href="<?php echo BASE_URL?>?action=admin/content/edit/<?php echo $content["content_id"]?>">Edit</a>
							<a
							href="<?php echo BASE_URL?>?action=admin/content/delete/<?php echo $content["content_id"]?>">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</form>
		</div>

		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>