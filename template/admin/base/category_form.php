<?PHP Admin_Block_Header::index($data);?>

<div id="site-container">
	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Add/Edit Category");?>
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
						<td><?php echo __("Parent"); ?></td>
						<td><select id="parent_id" name="parent_id">
								<option value="0">
									<?php echo __("No parent")?>
								</option>
								<?php foreach($parents as $parent):?>
								<option value="<?php echo $parent["type_id"];?>"
								<?php echo $parent["type_id"]==$parent_id?"selected":"";?>>
									<?php echo $parent["title"];?>
								</option>
								<?php endforeach;?>
						</select>
						</td>
					</tr>
					<tr>
						<td><?php echo __("Type"); ?></td>
						<td>
							<ul
								style="border: 1px solid #eee; padding: 5px; height: 100px; width: 200px;">
								<?php foreach($types as $item){?>
								<li style="list-style-type: none;"><input class="type"
									name="type[]" type="checkbox"
									value="<?php echo $item["type_id"]?>"
									<?php echo in_array($item["type_id"], $type)?"checked":"";?>><label><?php echo $item["title"]?>
								</label></li>

								<?php }?>
							</ul> <a href="javascript:void(null);"
							onclick="$('.type').each( function() {if($(this).attr('checked')){$(this).attr('checked',false);}else{$(this).attr('checked',true);}})">Select/
								Unselect All</a>


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

		<?PHP Admin_Block_Footer::index($data);?>