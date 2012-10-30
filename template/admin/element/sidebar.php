<div id="accordion">
	<h3>Dashboard</h3>
	<div>
		<ul>
			<li><a href="<?php BASE_URL?>?action=admin/index/welcome">Welcome</a>
			</li>
			<li><a href="<?php BASE_URL?>?action=admin/index/help">Help</a></li>
		</ul>
	</div>
	<h3>CMS</h3>
	<div>
		<ul>
			<li><a href="<?php BASE_URL?>?action=admin/cms/index/add">Add Content</a>
			</li>
			<li><a href="<?php BASE_URL?>?action=admin/cms">Contents</a></li>
		</ul>
	</div>
	<h3>Project</h3>
	<div>
		<ul>
			<li><a href="<?php BASE_URL?>?action=admin/index/add">Add Project</a>
			</li>
			<li><a href="<?php BASE_URL?>?action=admin/project/index">Projects</a>
			</li>
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
				<li><a href="<?php BASE_URL?>?action=admin/taxonomy/index/add">Add Group</a>
				</li>
				<li><a href="<?php BASE_URL?>?action=admin/taxonomy/index">Groups</a>
				</li>
				<li><a href="<?php BASE_URL?>?action=admin/taxonomy/category/add">Add Category</a>
				</li>
				<li><a href="<?php BASE_URL?>?action=admin/taxonomy/category/index">Catogories</a>
				</li>
				<li><a href="<?php BASE_URL?>?action=admin/taxonomy/tag/add">Add Tag</a>
				</li>
				<li><a href="<?php BASE_URL?>?action=admin/taxonomy/tag/index">Tags</a>
				</li>
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
