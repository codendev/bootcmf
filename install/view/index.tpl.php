<?php template('header.tpl.php');?>
		<div class="content">
		<p>BootCMF requires the following in order to work.Please proceed if there are no error and warnings.</p>
			<form method="post">

				<table class="table">
					<tr class="header">
						<td>Required</td>
						<td align="left">Status</td>
						<td>Suggestion</td>
					</tr>
					<?php foreach($warnings as $warning):?>
					<tr>
						<td><?php echo $warning["message"];?></td>
						<td align="center"><span class="warning"></span></td>
						<td><?php echo $warning["suggestion"];?></td>
					</tr>
					<?php endforeach;?>
				</table>


			</form>
<?php template('footer.tpl.php');?>
