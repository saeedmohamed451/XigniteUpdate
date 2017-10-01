<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

extract( shortcode_atts( array(
    'particles' => ''
), $atts ) );


$particles_id = uniqid( 'particles_' );
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Cta
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->buildTemplate( $atts, $content );
$containerClass = trim( 'vc_cta3-container ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'container-class' ) ) ) );
$cssClass = trim( 'vc_general ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'css-class' ) ) ) );
$wrapper_attributes = array();
if ( ! empty( $atts['el_id'] ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}
?>

<?php if( $particles ) : ?>
    <?php wp_enqueue_script( 'particles' ); ?>

    <div id="<?php echo esc_attr( $particles_id ); ?>"></div>

    <style>
        #<?php echo esc_attr( $particles_id ); ?> {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .vc_cta3_content-container {
            position: relative;
        }
    </style>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            var screenWidth = $(window).width();
            if(screenWidth < 1140) {
                var defaultWidth = screenWidth;
            } else {
                var defaultWidth = 1140;
            }
            var marginLeft = (screenWidth - defaultWidth) / 2;

            $('#<?php echo esc_js( $particles_id ); ?>').css({
                'width': screenWidth + 'px',
                'margin-left': '-' + marginLeft + 'px'
            });

            particlesJS('<?php echo esc_js( $particles_id ); ?>',

                {
                    "particles": {
                        "number": {
                            "value": 120,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": "#ffffff"
                        },
                        "opacity": {
                            "value": 0.5,
                            "random": false,
                            "anim": {
                                "enable": false,
                                "speed": 1,
                                "opacity_min": 0.1,
                                "sync": false
                            }
                        },
                        "size": {
                            "value": 8,
                            "random": true,
                            "anim": {
                                "enable": false,
                                "speed": 40,
                                "size_min": 0.1,
                                "sync": false
                            }
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.4,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": 6,
                            "direction": "none",
                            "random": false,
                            "straight": false,
                            "out_mode": "out",
                            "attract": {
                                "enable": false,
                                "rotateX": 600,
                                "rotateY": 1200
                            }
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "grab"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        }
                    },
                    "retina_detect": true
                }

            );
        });
    </script>
<?php endif; ?>

<section class="<?php echo esc_attr( $containerClass ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
    <div class="<?php echo esc_attr( $cssClass ); ?>"<?php
    if ( $this->getTemplateVariable( 'inline-css' ) ) {
        echo ' style="' . esc_attr( implode( ' ', $this->getTemplateVariable( 'inline-css' ) ) ) . '"';
    }
    ?>>
        <?php echo $this->getTemplateVariable( 'icons-top' ); ?>
        <?php echo $this->getTemplateVariable( 'icons-left' ); ?>
        <div class="vc_cta3_content-container">
            <?php echo $this->getTemplateVariable( 'actions-top' ); ?>
            <?php echo $this->getTemplateVariable( 'actions-left' ); ?>
            <div class="vc_cta3-content">
                <header class="vc_cta3-content-header">
                    <?php echo $this->getTemplateVariable( 'heading1' ); ?>
                    <?php echo $this->getTemplateVariable( 'heading2' ); ?>
                </header>
                <?php echo $this->getTemplateVariable( 'content' ); ?>
            </div>
            <?php echo $this->getTemplateVariable( 'actions-bottom' ); ?>
            <?php echo $this->getTemplateVariable( 'actions-right' ); ?>
        </div>
        <?php echo $this->getTemplateVariable( 'icons-bottom' ); ?>
        <?php echo $this->getTemplateVariable( 'icons-right' ); ?>
    </div>
</section>

