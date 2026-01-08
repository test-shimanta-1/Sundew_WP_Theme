<?php

/** theme configuration */
require_once(get_template_directory() . '/inc/' . 'setup.php');
require_once(get_template_directory() . '/theme-settings.php');

/** including post-types */
// include_once(get_template_directory() . '/inc/post-types/' . 'Inventor.php');
// include_once(get_template_directory().'/inc/post-types/'.'Services.php');
// include_once(get_template_directory() . '/inc/post-types/' . 'Emergency.php');
include_once(get_template_directory() . '/inc/post-types/' . 'Memoriam.php');


/** customizing the login page */


/** login cookie expiration */
function user_auth_remember_me($expires)
{
    return 30 * 24 * 60 * 60; // Set the time in seconds ~ set to 30 days.
}
add_filter('auth_cookie_expiration', 'user_auth_remember_me');

/** 2FA in wp-login.php */
// add_filter('authenticate', function ($user, $u, $p) {
//     if (!empty($_POST['2fa_code']))
//         return $user;
//     if (is_wp_error($user))
//         return $user;
//     if ($user instanceof WP_User && $u && $p) {
//         $code = rand(100000, 999999);
//         update_user_meta($user->ID, '2fa_code', $code);
//         // wp_mail('shimanta.das@sundewsolutions.com', 'test email otp', 'here is a otp for the localhost website: '.$code);
//         set_transient("2fa_user_$user->ID", 1, 300);
//         set_transient("2fa_u_$user->ID", $u, 300);
//         set_transient("2fa_p_$user->ID", $p, 300);
//         wp_redirect(wp_login_url() . "?2fa=$user->ID");
//         exit;
//     }else{
//         $handle = fopen('data.txt', 'a');
//         $data = "dummyhhhh ";
//         fwrite($handle, $data);
//         fclose($handle);
//     }
//     return $user;
// }, 30, 3);

// add_action('login_form', function () {
//     if (!isset($_GET['2fa']))
//         return;
//     $id = intval($_GET['2fa']);
//     if (!get_transient("2fa_user_$id"))
//         return;
//     $u = esc_js(get_transient("2fa_u_$id"));
//     $p = esc_js(get_transient("2fa_p_$id"));
//     $err = isset($_GET['error']) ? '<span style="color:red">Please enter the correct code</span><br>' : '';
//     echo $err . '<p><label>Enter 2FA Code<br><input type="text" name="2fa_code" class="input"></label></p>
//     <input type="hidden" name="user_id" value="' . $id . '">
//     <script>
//     document.addEventListener("DOMContentLoaded",function(){
//         let l=document.getElementById("user_login");
//         let x=document.getElementById("user_pass");
//         let b=document.getElementById("wp-submit");
//         if(l) l.value="' . $u . '";
//         if(x) x.value="' . $p . '";
//         if(b) b.value="Verify";
//     });
//     </script>';
// });

// add_action('login_init', function () {
//     if (!isset($_POST['2fa_code']))
//         return;
//     $id = intval($_POST['user_id']);
//     $saved = get_user_meta($id, '2fa_code', true);
//     if ($_POST['2fa_code'] == $saved) {
//         delete_user_meta($id, '2fa_code');
//         delete_transient("2fa_user_$id");
//         delete_transient("2fa_u_$id");
//         delete_transient("2fa_p_$id");
//         wp_set_current_user($id);
//         wp_set_auth_cookie($id);
//         wp_redirect(admin_url());
//         exit;
//     }
//     wp_redirect(wp_login_url() . "?2fa=$id&error=1");
//     exit;
// });
/** end of 2FA */

/** acf TEXT, TEXTAREA field validations */
add_action('acf/render_field_settings/type=text', 'acf_custom_char_limit_settings');
add_action('acf/render_field_settings/type=textarea', 'acf_custom_char_limit_settings');
function acf_custom_char_limit_settings($field)
{
    acf_render_field_setting($field, array(
        'label' => __('Standard Character Limit'),
        'type' => 'number',
        'name' => 'standard_limit',
        'min' => 1,
        'instructions' => 'Default character limit before warning appears.',
    ));

    acf_render_field_setting($field, array(
        'label' => __('Maximum Character Limit'),
        'type' => 'number',
        'name' => 'max_limit',
        'min' => 1,
        'instructions' => 'Hard maximum limit. Input is truncated.',
    ));
}

add_filter('acf/prepare_field', function ($field) {
    if (isset($field['standard_limit'])) {
        $field['wrapper']['data-standard'] = $field['standard_limit'];
    }
    if (isset($field['max_limit'])) {
        $field['wrapper']['data-max'] = $field['max_limit'];
    }
    return $field;
});
/** end of acf validations */

/** login page url customization */
add_action('init', function() {
    add_rewrite_rule('^user/login/?$', 'wp-login.php', 'top');
});

add_filter('site_url', function($url, $path) {
    if ($path === 'wp-login.php' || $path === 'wp-login.php?action=register') {
    return site_url('user/login');
    }
    return $url;
}, 10, 2);

add_filter('wp_redirect', function($location) {
    if (strpos($location, 'wp-login.php') !== false) {
        return site_url('user/login');
    }
    return $location;
});

add_action('init', function() {
    if (strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
        if (strpos($_SERVER['REQUEST_URI'], 'action=logout') !== false) {
            return;
        }
        if (!is_user_logged_in()) {
            wp_redirect(home_url());
            exit;
        }else{
            wp_redirect(admin_url());
            exit;
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], 'user/login') !== false && is_user_logged_in()){
        wp_redirect(admin_url());
        exit;
    }
});
/** login attempts */
add_action( 'wp_login_failed', 'sdw_handle_failed_login' );
function sdw_handle_failed_login( $username ) {
    if(username_exists($username)){
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = get_transient('login_fail_'.$username."_".$ip);

        if ( ! $data ) {
            $data = [
                'count' => get_option('anno_max_login_attmpt')-1, // M = N - 1 | M - count number, N - real count 
                'locked' => false
            ];
        } elseif ( $data['count'] <= 0 ) {
            $data['locked'] = true;
        } else {
            $data['count']--;
        }
        set_transient('login_fail_'.$username."_".$ip, $data, get_option('anno_login_expiration_time') ); // change expiration in sec.
    }
}

add_filter( 'login_errors', 'swd_custom_login_error_message' );
function swd_custom_login_error_message( $error ) {
    $username = $_POST['log'] ?? '';
    if(username_exists($username)){
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = get_transient('login_fail_'.$username."_".$ip);
        if ( ! $data ) {
            return $error;
        }
        if ( ! empty( $data['locked'] ) ) {
            return get_option('anno_failed_attempt_warning_msg') ? get_option('anno_failed_attempt_warning_msg') : 'Too many failed login attempts. Please try after some time!';
        }
        return 'Invalid credentials. Attempts remaining: ' . ( $data['count'] + 1 );
    }
    
}
/** login url customization end */

/** create roles & manage capabilities */
add_role('faculty', 'Faculty');
function author_level_up()
{
    $role = get_role('faculty');
    $role->add_cap('read');
    $role->add_cap('edit_users');   
}
add_action('admin_init', 'author_level_up');
/** end of custom user roles */


?>