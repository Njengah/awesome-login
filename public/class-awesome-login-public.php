<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://awesome-plugins.com
 * @since      1.0.0
 *
 * @package    Awesome_Login
 * @subpackage Awesome_Login/public
 */


class Awesome_Login_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action('init', array($this, 'aws_login_form'));
		add_shortcode('aws-login-form', array($this, 'aws_login_form_shortcode'));
		add_shortcode( 'aws-password-lost-form', array( $this, 'aws_password_lost_form_shortcode' ) );
		
		add_filter('lostpassword_url', array($this,  'recover_password_page_redirect'), 10, 0 ); 
		//add_action('after_setup_theme', array($this, 'remove_admin_bar')); ### Disabled for now for Easy Debugging ####
		
	}
	

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/awesome-login-public.css', array(), $this->version, 'all' );

	}

	
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/awesome-login-public.js', array( 'jquery' ), $this->version, false );

	}
	
	//Login Form 
	
	public function aws_login_form() {

	global $aws_login_error;
	$aws_login_error = false;

		if (isset($_POST['username']) && isset($_POST['password'])){
		
			$creds                  = array();
			$creds['user_login']    = $_POST['username'];
			$creds['user_password'] = $_POST['password'];
			
			$user                   = wp_signon($creds);
			
			if (is_wp_error($user)){
				$aws_login_error = $user->get_error_message();
				
			}else{
				
				if (isset($_POST['redirect']) && $_POST['redirect']){
					
					wp_redirect($_POST['redirect']);
					
						exit;
				
				}
			}
	
		}
   
    }
   
   
	//Validation & Errors 
   
	public function show_aws_login_error() {
			
			echo  $this->get_aws_login_error();
			
		}

		public function get_aws_login_error() {
			
			global $aws_login_error;
			
			if ($aws_login_error){
				
				$return     = $aws_login_error;
				$aws_login_error = false;
				return $return;
				
			}else{
				
				return false;
				
			}
	}
	
	
	//Forms Shortcode 
	
    public function get_aws_login_form($redirect = false) {

		if (!is_user_logged_in()){

			ob_start();
		
				include __DIR__ . "/partials/login-form.php";
			
			return ob_get_clean();
		 }else{
		
			$logout_url =  wp_logout_url(get_bloginfo("url"));
			$return = "<a href={$logout_url }><button>". " Logout"." </button></a><br/>";
		
		}
			return $return;
	
	}
	
	
	public function the_aws_login_form_form($redirect = false) {
		
			echo $this->get_aws_login_form($redirect);
			
	}

		

	public function aws_login_form_shortcode($atts, $content = false) {
		
			$atts = shortcode_atts(array(
				'redirect'   => false,
			), $atts);
			
			
			 return $this->get_aws_login_form();
					
	}
	
	public function aws_password_lost_form_shortcode(){
			
		include __DIR__ . "/partials/password-reset-form.php";
				
		global $wpdb;
        $error = '';
        $success = '';
		
	  
        if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ) {
			
			
		    $email = trim($_POST['user_login']);
            
            if( empty( $email ) ) {
                $error = 'Enter a username or e-mail address..';
            } else if( ! is_email( $email )) {
                $error = 'Invalid username or e-mail address.';
            } else if( ! email_exists( $email ) ) {
                $error = 'There is no user registered with that email address.';
            } else {
				
			    $random_password = wp_generate_password( 12, false );
                $user = get_user_by( 'email', $email );
                
			    $update_user = wp_update_user( array (
                        'ID' => $user->ID, 
                        'user_pass' => $random_password
                    )
                );
			
			
			if( $update_user ) {
                    $to = $email;
                    $subject = 'Your new password';
                    $sender = get_option('name');
                    
                    $message = 'Your new password is: '.$random_password;
                    
                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";
                    
                    $mail = wp_mail( $to, $subject, $message, $headers );
                    if( $mail )
                        $success = 'Check your email address for you new password.';
                        
                } else {
                    $error = 'Oops something went wrong updaing your account.';
                }
                
            }
			
		   if( ! empty( $error ) )
                echo '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
            
            if( ! empty( $success ) )
                echo '<div class="error_login"><p class="success">'. $success .'</p></div>';
		}
		 
	}

   
    //Redirects  
    
	public function recover_password_page_redirect() {
			
			return site_url('/reset-password/');
			
	}


	public function remove_admin_bar() {
		
		if (!current_user_can('administrator') && !is_admin())
		{
			show_admin_bar(false);
		}
	}
	
	public function recover_lost_password(){
		
		
		
		
	}
	

}
