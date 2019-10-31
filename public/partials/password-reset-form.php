 <?php

/**
 * Password Reset Page  
 *
 * This file is used to markup the password reset form 
 *
 * @link       http://awesome-plugins.com
 * @since      1.0.0
 *
 * @package    Awesome_Login
 * @subpackage Awesome_Login/public/partials
 */
?>


<form method="post" class="awesome-password-reset-form">
 
     <fieldset>
	 
        <p> <?php _e('Please enter your username or email address. You will receive a link to create a new password via email', 'awesome-login')?></p>
               
			<p><label for="user_login"><?php _e( 'Username or E-mail:', 'awesome-login')?> </label>
                  
				<?php $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : ''; ?>
                   
					<input type="text" name="user_login" id="user_login" value="<?php echo $user_login; ?>" /></p>
               
			<p>
                    <input type="hidden" name="action" value="reset" />
                    <input type="submit" value="Get New Password" class="button" id="submit" />
           </p>
    </fieldset> 
        
</form>