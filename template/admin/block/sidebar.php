<div id="accordion">
	<h3>Dashboard</h3>
	<div>
		<ul>
			<li><a href="<?php echo BASE_URL?>admin/index/welcome">Welcome</a></li>

			<li><a href="<?php echo BASE_URL?>admin/type/add"><?php echo __("Add Type");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/type"><?php echo __("Types");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/category/add"><?php echo __("Add Category");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/category/index"><?php echo __("Categories");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/tag/index"><?php echo __("Tags");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/tag/add"><?php echo __("Add Tag");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/language/add"><?php echo __("Add Language");?>
			</a></li>
			<li><a href="<?php echo BASE_URL?>admin/language/index"><?php echo __("Languages");?>
			</a></li>

			<li><a href="<?php echo BASE_URL?>admin/content/add">Add
					Content</a></li>
			<li><a href="<?php echo BASE_URL?>admin/content">Contents</a>
			</li>
			<li><a href="<?php echo BASE_URL?>admin/index/help">Help</a>
			</li>
		</ul>

		</ul>
	</div>
	<h3>Page</h3>
	<div>
		<ul>
			<li><a href="<?php echo BASE_URL?>admin/page/index/add">Add
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
