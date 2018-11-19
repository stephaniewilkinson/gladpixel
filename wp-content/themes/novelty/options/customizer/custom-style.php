<?php
global $smof_data, $customizer ;

$br      = "\r\n";
$str     = array(THEME_NAME, "[", "]");
$options = get_option(THEME_NAME);

foreach ($customizer as $value) :
    if ($value['type'] != 'section' && isset($value['exclude']) != true) :

        $val   = str_replace( $str, '', $value['id'] );
        $color = isset($options[$val]) ? $options[$val] : $value['default'];

        switch ($value['type']) {
            
            case 'color':
                foreach ($value['style'] as $val) {
                   echo $value['selector'].'{ ' . $val . ': ' . $color . '; }' . $br;
                }
                break;

            case 'image':
                echo $value['selector'] . '{ background-image: url(' . $color . '); }' . $br;
                break;
            
            case 'text':
                foreach ($value['style'] as $val) {
                    echo $value['selector'].'{ '.$val.': '.$color.'px; }'.$br;
                }
                break;

            case 'select':
                if ($value['style'] == 'font-family') {

                    $font     = explode( ":", $color );
                    $font_fam = str_replace( "+", " ", $font[0] );

                    echo $value['selector'].'{ ';
                        echo 'font-family: '.$font_fam.'; ';
                        if ($font[1])
                            echo 'font-weight: '.$font[1].'; ';
                        if (isset($font[2]))
                            echo 'font-style: '.$font[2].'; ';

                    echo '}'.$br;
                }

                elseif ($value['style'] == 'font-size') {
                    echo $value['selector'].'{ font-size: '.$color.'; }'.$br;
                }
                break;
        }

    endif;
endforeach;

?>

input[type="text"], input[type="email"], textarea {
    background: #FEFEFE;
    border: 1px solid #E0E0E0;
    color: #666666;
    font-size: 13px;
    -webkit-box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1) inset;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1) inset;
}
input[type="text"]:focus, 
input[type="email"]:focus,
textarea:focus {
    background: #ffffff;
    border-color: #E8E7E7;
    -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.05) inset;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05) inset;
}

body div.wpcf7 .watermark{ color: #B8B8B8; }