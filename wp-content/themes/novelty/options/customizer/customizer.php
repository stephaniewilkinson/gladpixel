<?php
require_once(BMD_SERVER_PATH . '/options/customizer/options.php');

add_action( 'customize_register', 'bmd_theme_customizer' );
function bmd_theme_customizer ($wp_customize) {
    global $customizer;

    $section_priority = 1000;
    $setting_priority = 1;
    $section = '';

    foreach ($customizer as $value) :

        if ($value['type'] == 'section') :

            // Sections
            $section = $value['id'];
            $wp_customize->add_section( $value['id'], array( 'title' => $value['title'], 'priority' => $section_priority++ ) );

        else :

            // Settings
            $wp_customize->add_setting( $value['id'], array(
                'default'    => $value['default'],
                'type'       => 'option',
                'capability' => 'edit_theme_options',
                'transport'  => 'postMessage',
            ));

            $control_args = array(
                'label'    => $value['title'],
                'section'  => $section,
                'settings' => $value['id'],
                'priority' => $setting_priority++,
            );


            switch ($value['type']) {

                // Simple controls
                case 'text':
                    $control_args['type'] = $value['type'];
                    $wp_customize->add_control($value['id'], $control_args);
                    break;
                
                // Controls with choices
                case 'select':
                    $control_args['type'] = $value['type'];
                    $control_args['choices'] = $value['choices'];
                    $wp_customize->add_control($value['id'], $control_args);
                    break;


                // Extended controls (based on classes)
                case 'color':
                case 'image':
                case 'divider':
                    $control_classes = array(
                        'color'   => 'WP_Customize_Color_Control',
                        'image'   => 'WP_Customize_Image_Control',
                        'divider' => 'WP_Customize_Divider_Control',
                    );
                    $control_class = $control_classes[$value['type']];

                    $wp_customize->add_control(new $control_class(
                        $wp_customize,
                        $value['id'],
                        $control_args
                    ));
                    break;
            }

        endif;
    endforeach;

    // Print jQuery on top of the live preview
    if( $wp_customize->is_preview() && !is_admin() )
        add_action( 'wp_footer', 'bmd_theme_preview', 21);

}


/* The classes extend `WP_Customize_Control`, so it needs to be loaded */
if(!class_exists('WP_Customize_Control')) return;

/* Divider Controlr */
class WP_Customize_Divider_Control extends WP_Customize_Control {

    public $type = 'divider';

    public function render_content() {
        echo '<div class="divider_custom">';
        echo '<span>'.esc_html($this->label).'</span>';
        echo '</div>';

        ?>

        <style>
            .divider_custom{ 
                height: 2px; 
                background: #444; 
                margin: 25px 0; 
                font-weight: 700; 
                position: relative; 
            }
            .divider_custom span{
                display: inline-block; 
                padding: 5px 10px 5px 0; 
                background: #fff; 
                position: absolute; 
                top: -10px; 
                font-size: 14px;
            }
        </style>

        <?php

    }
}



function bmd_theme_preview(){
    global $customizer;

    echo '<script type="text/javascript">';
        echo 'jQuery.c = {};'; 

        foreach ($customizer as $value) :
            if ($value['type'] != 'section' && isset($value['exclude']) != true) :

                $to = 'to';
                if (isset($value['hover'])) {
                    $explode = explode( "|", $value['hover'] );
                    $to          = $explode[0];
                    $color       = $explode[1];
                    $color_hover = $explode[2];
                }

                $select = isset($value['js']) ? $value['js'] : $value['selector'];

                echo 'wp.customize("'.$value['id'].'", function(value){';
                    echo 'value.bind(function('.$to.'){';

                        switch ($value['type']) {
                            
                            case 'text':
                                foreach ($value['style'] as $val) {
                                    echo "jQuery('" . $select . "').css('" . $val . "', " . $to . " + 'px');";
                                }
                                break;

                            case 'image':
                                echo "jQuery('" . $select . "').css('background-image', 'url(' + " . $to . " + ')');";
                                break;

                            case 'select':
                                if ($value['style'] == 'font-size') {
                                    echo "jQuery('" . $select . "').css('font-size', " . $to . ");";
                                }

                                elseif ($value['style'] == 'font-family') {
                                    echo 'var font     = ' . $to . ';';
                                    echo 'var font     = font.split(":");';
                                    echo 'var font_fam = font[0];';
                                    echo 'var font_fam = font_fam.replace("+", " ");';
                                    echo 'var google   = ' . $to . '.replace("00:", "00");'; 
                                    echo 'font_w      = font[2] ? font[2] : "normal";';

                                    echo 'if (font_fam)';
                                        echo 'jQuery("' . $select . '").css("font-family", font_fam);';

                                    echo 'if (font[1])';
                                        echo 'jQuery("' . $select . '").css("font-weight", font[1]);';

                                    echo 'jQuery("' . $select .'").css("font-style", font_w);';

                                    echo "jQuery('head').append('<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family=' + google + '&subset=latin,cyrillic\" type=\"text/css\" />');"; 
                                }
                                break;

                            case 'color':
                                if (isset($value['hover']) && strpos( $color, '_l') > 0) { 
                                    foreach ($value['style'] as $val) {
                                        $selector = str_replace(':hover', '', $select);
                                        echo 'jQuery.c.' . $color . ' = ' . $to . ';';
                                        echo 'jQuery("'.$selector.'").css("'.$val.'", '.$to.');';
                                        echo 'jQuery("'.$selector.'").hover(function(){';
                                            echo 'if(jQuery.c.'.$color_hover.' == null){';
                                                echo 'jQuery(this).css("'.$val.'", "");';
                                            echo '}else{';
                                                echo 'jQuery(this).css("'.$val.'", jQuery.c.'.$color_hover.');';
                                            echo '}';
                                        echo '},function(){';
                                            echo 'jQuery(this).css("'.$val.'", jQuery.c.'.$color.');';
                                        echo '});';
                                    }

                                }

                                elseif (isset($value['hover']) && strpos( $color, '_h') > 0) {
                                    foreach ($value['style'] as $val) {
                                        $selector = str_replace(':hover', '', $select);
                                        echo 'jQuery.c.'.$color.' = '.$to.';';
                                        echo 'if(jQuery.c.'.$color_hover.' == null )';
                                                echo 'jQuery.c.'.$color_hover.' = jQuery("'.$selector.'").css("'.$val.'");';
                                        echo 'jQuery("'.$selector.'").hover(function(){';
                                                echo 'jQuery(this).css("'.$val.'", '.$to.');';
                                        echo '},function(){';
                                                echo 'jQuery(this).css("'.$val.'", jQuery.c.'.$color_hover.');';
                                        echo '});';
                                    }
                                }

                                else {
                                    foreach ($value['style'] as $val) {
                                        echo "jQuery('" . $select . "').css('" . $val . "', " . $to . ');';
                                    }
                                }
                                break;
                        }

                    echo '});';
                echo '});';
            endif;
        endforeach;

    echo '</script>';
}