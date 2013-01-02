<?php template('header.tpl.php');?>
<div class="content">
	<p>BootCMF requires the following configuration.</p>
	
	<span style="padding:10px;background: lime;display:inline-block;;"><?php echo $success?></span>
	<form action="<?php echo base_url()."/?action=index/config"?>"
		method="post">
	   <?php if(isset($success)):?>
	   
	   <?php endif;?>	
		<h3>Database Configuration</h3>
		<table class="table">
			<tr class="header">
				<td>Setting</td>
				<td>Value</td>
				<td>Suggestion</td>
			</tr>
			<tr>
				<td>Host name</td>
				<td><input name="hostName" type="text"
					value="<?php echo isset($hostName)?$hostName:'localhost'; ?>" /></td>
				<td style="font: italic;">e.g. localhost,127.0.0.1</td>
			</tr>
			<tr>
				<td>Database name</td>
				<td><input name="databaseName" type="text"
					value="<?php echo isset($databaseName)?$databaseName:'bootcmf'; ?>" /></td>
				<td style="font: italic;">e.g. bootcmf</td>
			</tr>
			<tr>
				<td>User name</td>
				<td><input name="userName" type="text"
					value="<?php echo isset($userName)?$userName:'root'; ?>" /></td>
				<td style="font: italic;">e.g. root</td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input name="password" type="text"
					value="<?php echo isset($password)?$password:''; ?>" /></td>
				<td style="font: italic;">e.g. empty for no password</td>
			</tr>

		</table>
		<div style="margin: 10px 0px 10px 0px; float:right;">
			<input type="submit" name="test" value="Test database connection" />
		</div>
		<div style="clear: both"></div>
		<h3>System Configuration</h3>
		<table class="table">
			<tr class="header">
				<td>Setting</td>
				<td>Value</td>
				<td>Suggestion</td>
			</tr>
			<tr>
				<td>Salt</td>
				<td><input name="salt" type="text" value="<?php echo $salt ?>" /></td>
				<td style="font: italic;">To improve your password strength choose
					random salt characters e.g. ADW@#DASD</td>
			</tr>

		</table>
		<div style="margin: 10px 0px 10px 0px; float:right;">
			<input type="submit" name="save" value="Save and continue" />
		</div>
		<div style="clear: both"></div>

	</form>
	<?php template('footer.tpl.php');?>