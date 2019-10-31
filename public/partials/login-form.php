<?php

/**
 * Login Page  
 *
 * This file is used to markup the login form 
 *
 * @link       http://awesome-plugins.com
 * @since      1.0.0
 *
 * @package    Awesome_Login
 * @subpackage Awesome_Login/public/partials
 */
?>

<h2><?php _e("Login Here",'awesome-login'); ?> </h2> 

	<form action="" method="post" class="aws_login_form aws_login_form">
			<?php
				$error =  $this->get_aws_login_error();
					if ($error){

				echo "<p class=\"error\">{$error}</p>\r\n";
			}
			?>
			<div class="textfield field-large">
				<input type="text" id="aws_login_username" class="textfield-input" name="username" value="<?php echo (isset($_POST['username']) ? $_POST['username'] : "") ?> "/>
					<span class="input-bar"></span>
						<label for="title" class="textfield-label">
							<?php _e('Username', 'awesome-login') ?>
				</label>
			</div>

			<div class="textfield field-large">
				<input type="password" id="aws_login_password" class="textfield-input" name="password"/>
					<span class="input-bar"></span>
						<label for="title" class="textfield-label">
							<?php _e('Password', 'awesome-login') ?>
				</label>
			</div>

			<div class="md-checkbox">
			
				<input id="rm" type="checkbox">
					<label for="rm">Remember Me</label>
			</div>

			<div class="button-wrapper">
			
					<input type="submit" class="button ripple-effect js-login" value="Login">
			
			</div>
			

</form>