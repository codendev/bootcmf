<?PHP Core_Helper_Template::template("admin/block/header.php",$data);?>

<div id="site-container">
	
	<div class="content">
		
		<div  class="login-window">
		<form id="form" enctype="multipart/form-data" method="post" action="">
        <table style="width: 100%;">
          <tbody>
          <tr>
            <td>Username:<br>
              <input type="text" style="margin-top: 4px;" value="" name="email">
              <br>
              <br>
              Password:<br>
              <input type="password" style="margin-top: 4px;" value="" name="password">
              <br>
              <a href="http://demo.twinkler.co.uk/oc541/admin/index.php?route=common/forgotten">Forgotten Password</a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right;"><input class="ui-button" type="submit" value="Login" onclick="$('#form').submit();"/></td>
          </tr>
        </tbody></table>
              </form>
		
		</div>
		
<?PHP Core_Helper_Template::template("admin/block/footer.php",$data);?>

