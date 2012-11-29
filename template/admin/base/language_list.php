<?PHP Core_Helper_Template::template("admin/block/header.php",$data);?>

<div id="site-container">

	<div class="content">
		<div class="sidebar">
			<?PHP Core_Helper_Template::template("admin/block/sidebar.php",$data);?>
		</div>
		<div class="article">
			<h1 class="article-heading">
				<?php echo __("Languages");?>
			</h1>
			<form id="form" method="get">
				<table class="list">
					<tr>
						<th><input id="list-ckbx" type="checkbox"
							onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
						</th>
						<th class="left"><?php echo __("Title");?></th>
						<th class="left"><?php echo __("ISO639-1");?></th>
						<th class="left"><?php echo __("ISO639-2");?></th>
						<th class="left"><?php echo __("Status");?></th>
						<th class="center"><?php echo __("Action");?></th>
					</tr>
					<tr>
						<td>&nbsp;</td> 
						<td><input name="title" type="text" value="<?php echo isset($title)?$title:""?>" /></td>
						<td><input name="iso6391" type="text" value="<?php echo isset($iso6391)?$iso6391:""?>" /></td>
						<td><input name="iso6392" type="text" value="<?php echo  isset($iso6392)?$iso6392:""?>" /></td>
						<td><select id="status" name="status">
								<option value="1" <?php echo $status?"selected":""?>>
									<?php echo __("Enable")?>
								</option>
								<option value="0" <?php echo !$status?"selected":""?>>
									<?php echo __("Disable")?>
								</option>
						</select>
						</td>
						<th><input value="<?php echo __("Filter");?>" type="submit"
							onclick="$('#form').submit();" /></th>
					</tr>
					<?php foreach($languages as $language):?>
					<tr>
						<td class="center"><input value="<?php echo $language["type_id"]?>"
							name="selected[]" type="checkbox" />
						</td>
						<td><?php echo $language["title"]?></td>
						<td><?php echo $language["iso6391"]?></td>
						<td><?php echo $language["iso6392"]?></td>
						<td><?php echo $language["status"]?__("Enable"):__("Disable")?></td>
						<td class="center"><a
							href="<?php echo BASE_URL?>admin/taxonomy/language/edit/<?php echo $language["language_id"]?>">Edit</a>
							<a
							href="<?php echo BASE_URL?>admin/taxonomy/language/delete/<?php echo $language["language_id"]?>">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			</form>
		</div>

		<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>