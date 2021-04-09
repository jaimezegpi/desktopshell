<?php
if ( ds_userIsLogin() ){
	echo "OK";
}else{
	?>
<form>
	<input type="text" name="username">
	<input type="password" name="username">
	<button>Submit</button>
</form>
	<?php
}
?>