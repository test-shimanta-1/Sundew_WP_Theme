<?php

function myplugin_register_settings() {
   add_option( 'anno_max_login_attmpt', 
   ''// default value
   );
   add_option('anno_login_expiration_time', '');
   add_option('anno_failed_attempt_warning_msg', '');
   register_setting( 'custom_theme_options_group', 'anno_max_login_attmpt', 'anno_max_login_attmpt_sanitize_callback' );
   register_setting( 'custom_theme_options_group', 'anno_login_expiration_time', 'anno_login_expiration_time_sanitize_callback' );
   register_setting( 'custom_theme_options_group', 'anno_failed_attempt_warning_msg', 'anno_failed_attempt_warning_msg_sanitize_callback' );
}
add_action( 'admin_init', 'myplugin_register_settings' );

function myplugin_register_options_page() {
  add_options_page('', 'Global Settings', 'manage_options', 'global-settings-slug', 'swd_options_page_callback');
}
add_action('admin_menu', 'myplugin_register_options_page');

function swd_options_page_callback()
{
?>
  <div>
  <?php screen_icon(); ?>
  <br>
  <h4>Please Maintain Your Global Settings</h4>
  <br>
  <form method="post" action="options.php">
  <?php settings_fields( 'custom_theme_options_group' ); ?>
  <label for="anno_max_login_attmpt">Max Login Attempt Value</label>
  <input type="text" id="anno_max_login_attmpt" name="anno_max_login_attmpt" value="<?php echo get_option('anno_max_login_attmpt'); ?>" />
  <br><br>
  <label for="anno_login_expiration_time">Max Login Expiration Time(In Sec.)</label>
  <input type="text" id="anno_login_expiration_time" name="anno_login_expiration_time" value="<?php echo get_option('anno_login_expiration_time'); ?>" />  
  <br><br>
  <label for="anno_failed_attempt_warning_msg">Failed Login Attempt Warning Message</label>
  <input type="text" id="anno_failed_attempt_warning_msg" name="anno_failed_attempt_warning_msg" value="<?php echo get_option('anno_failed_attempt_warning_msg'); ?>" />  
  <?php submit_button(); ?>
  </form>
  </div>
<?php
} 