<?php
/*
Plugin Name: STM Importer
Plugin URI: http://stylemixthemes.com/
Description: STM Importer
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_importer
Version: 2.4
*/

// Demo Import - Styles
function stm_demo_import_styles() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'stm-demo-import-style', $plugin_url . '/assets/css/style.css', null, null, 'all' );
}

add_action( 'admin_enqueue_scripts', 'stm_demo_import_styles' );

add_action('admin_menu', 'stm_add_demo_import_page');

if ( ! function_exists('stm_add_demo_import_page'))
{
    function stm_add_demo_import_page()
    {
        /*add_theme_page( esc_html__( 'STM Demo Import', 'consulting' ) , esc_html__( 'STM Demo Import', 'consulting' ) , 'manage_options' , 'stm_demo_import' , 'stm_demo_import' );*/
    }
}

if ( !function_exists('stm_demo_import'))
{
    function stm_demo_import()
    {
        ?>
        <div class="stm_message content" style="display:none;">
            <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/spinner.gif" alt="spinner" style="border:0 !important;" />
            <h1 class="stm_message_title"><?php esc_html_e('Importing Demo Content...', 'consulting'); ?></h1>
            <p class="stm_message_text"><?php esc_html_e('Demo content import duration relies on your server speed.', 'consulting'); ?></p>
        </div>

        <div class="stm_message success" style="display:none;">
            <p class="stm_message_text"><?php echo wp_kses( sprintf(__('Congratulations and enjoy <a href="%s" target="_blank">your website</a> now!', 'consulting'), esc_url( home_url() )), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></p>
        </div>

        <form class="stm_importer" id="import_demo_data_form" action="?page=stm_demo_import" method="post">

            <div class="stm_importer_options">

                <div class="stm_importer_note">
                    <strong><?php esc_html_e('Before installing the demo content, please NOTE:', 'consulting'); ?></strong>
                    <p><?php echo wp_kses( sprintf(__('Install the demo content only on a clean WordPress. Use <a href="%s" target="_blank">Wordpress Database Reset</a> plugin to clean the current Theme.', 'consulting'), 'http://wordpress.org/plugins/wordpress-database-reset/', esc_url( home_url() )), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></p>
                    <p><?php esc_html_e('Remember that you will NOT get the images from live demo due to copyright / license reason.', 'consulting'); ?></p>
                </div>
                <div class="stm_demo_import_choices">
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/1.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_1" checked/>
                            <?php esc_html_e('New York', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/6.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_6"/>
                            <?php esc_html_e('London', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/9.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_9"/>
                            <?php esc_html_e('Frankfurt', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/5.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_5"/>
                            <?php esc_html_e('Moscow', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/2.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_2"/>
                            <?php esc_html_e('Shanghai', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/7.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_7"/>
                            <?php esc_html_e('Madrid', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/3.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_3"/>
                            <?php esc_html_e('Tokyo', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/8.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_8"/>
                            <?php esc_html_e('Seoul', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/4.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_4"/>
                            <?php esc_html_e('Sydney', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/10.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_10"/>
                            <?php esc_html_e('Hong Kong', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/11.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_11"/>
                            <?php esc_html_e('Paris', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/12.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_12"/>
                            <?php esc_html_e('Singapore', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/13.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_13"/>
                            <?php esc_html_e('Sao Paulo', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/14.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_14"/>
                            <?php esc_html_e('Abu Dhabi', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/15.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_15"/>
                            <?php esc_html_e('Dublin', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/16.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_16"/>
                            <?php esc_html_e('Tel Aviv', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/17.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_17"/>
                            <?php esc_html_e('Dubai', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/18.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_18"/>
                            <?php esc_html_e('Tehran', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/19.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_19"/>
                            <?php esc_html_e('Oslo', 'stm-importer'); ?>
						</span>
                    </label>
                    <label>
                        <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/demo/20.jpg" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="consulting_layout_demo" value="layout_20"/>
                            <?php esc_html_e('Rome', 'stm-importer'); ?>
						</span>
                    </label>
                </div>
                <input class="button-primary size_big" type="submit" value="Import" id="import_demo_data">

            </div>

        </form>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#import_demo_data_form').on('submit', function() {
                    jQuery("html, body").animate({
                        scrollTop: 0
                    }, {
                        duration: 300
                    });
                    jQuery('.stm_importer').slideUp(null, function(){
                        jQuery('.stm_message.content').slideDown();
                    });

                    // Importing Content
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        data: jQuery(this).serialize()+'&action=stm_demo_import_content',
                        success: function(){

                            jQuery('.stm_message.content').slideUp();
                            jQuery('.stm_message.success').slideDown();

                        }
                    });
                    return false;
                });
            });
        </script>
    <?php
    }

    // Content Import
    function stm_demo_import_content() {
        $consulting_layout = 'layout_1';

        if( !empty( $_POST['consulting_layout_demo'] ) ) {
            $consulting_layout = $_POST['consulting_layout_demo'];
        }

        update_option('consulting_layout', $consulting_layout);

        set_time_limit( 0 );

        if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
            define( 'WP_LOAD_IMPORTERS', true );
        }

        require_once( 'wordpress-importer/wordpress-importer.php' );

        $wp_import                    = new WP_Import();
        $wp_import->fetch_attachments = true;

        ob_start();
        $wp_import->import( get_template_directory() . '/inc/demo/'. $consulting_layout .'/demo_content.xml' );
        ob_end_clean();

        do_action( 'stm_importer_done' );

        echo 'done';
        die();

    }

    add_action( 'wp_ajax_stm_demo_import_content', 'stm_demo_import_content' );

}