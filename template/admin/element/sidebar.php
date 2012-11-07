<div id="accordion">
	<h3>Dashboard</h3>
	<div>
		<ul>
			<li><a href="<?php echo BASE_URL?>admin/index/welcome">Welcome</a></li>
			<li><a href="<?php echo BASE_URL?>admin/index/help">Help</a>
			</li>
		</ul>
	</div>
	<h3>Content</h3>
	<div>
		<ul>
			<li><a href="<?php echo BASE_URL?>admin/content/index/add">Add
					Content</a></li>
			<li><a href="<?php echo BASE_URL?>admin/content">Contents</a>
			</li>
		</ul>
	</div>
	<h3>Project</h3>
	<div>
		<ul>
			<li><a href="<?php echo BASE_URL?>admin/index/add">Add Project</a></li>
			<li><a href="<?php echo BASE_URL?>admin/project/index">Projects</a></li>
		</ul>
	</div>
	<h3>Forum</h3>
	<div>
		<ul>
			<li>Add Forum Entry</li>
			<li>View Forum Entries</li>
			<li>View Pages</li>
		</ul>
	</div>
	<h3>Taxonomy</h3>
	<div>
		<ul>
			<ul>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/index/add"><?php echo __("Add Type");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/index"><?php echo __("Types");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/category/add"><?php echo __("Add Category");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/category/index"><?php echo __("Categories");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/tag/add"><?php echo __("Add Tag");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/tag/index"><?php echo __("Add Tags");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/language/add"><?php echo __("Add Language");?>
				</a></li>
				<li><a href="<?php echo BASE_URL?>admin/taxonomy/language/index"><?php echo __("Languages");?>
				</a></li>
			</ul>

		</ul>
	</div>
	<h3>User</h3>
	<div>
		<ul>
			<li>Add User</li>
			<li>View User</li>
			<li>Add Group</li>
			<li>View Group</li>

		</ul>
	</div>

</div>
<script>
    $(function() {
        $( "#accordion" ).accordion({heightStyle: "content"});
    });
</script>
