<?php
global $smof_data;
require_once(BMD_SERVER_PATH . '/options/customizer/google_fonts.php');

$fonts_size = array();
for ($i = 8; $i < 251; $i++) { 
    $size = $i.'px';
    $fonts_size[$size] = $size;
}

$customizer = array();


/*-----------------------------------------------------------------------------------*/
/* BODY COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array('type' => 'section', 'id' => 'body', 'title' => 'Body: Color');

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_text_color]',
					'title'    => __('Text Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => 'body',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_heading_color]',
					'title'    => __('Heading Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => 'h1, h2, h3, h4, h5, h6',
					'js'       => '#content-area :header:not(.features :header), #header :header'
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_border_color]',
					'title'    => __('Border Color', 'bmd'),
					'default'  => '#eeeeee',
					'style'    => array('border-color'),
					'selector' => '.team-social, #header nav, .page-title:before, .portfolio-single-link, .container.bb, .portfolio-single h1, .testimonial-texts p:last-child, .portfolio-single ul.p-info li, .client div, .portfolio-single ul.p-info, #page-nav, .tagcloud a, .testimonials, .tab-header, ol.commentlist li, .client [class*="span"], .widget.widget_categories li, .widget.widget_archive li, .divider-single, .divider-double, #crumbs .container',
	            );


	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_link_color]',
					'title'    => __('Link Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => 'a, .color, #sidebar .tab-header li.active',
					'hover'    => 'body|body_l|body_h',
					'js'       => 'a:not(.title a, .meta a, #copyright-area a, #footer a, #sidebar a, #top-area a, .menu a, .features a, .slidecontrols a, .tweet_time a), .color'
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_link_color_hover]',
					'title'    => __('Link Hover Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => 'a:hover',
					'hover'    => 'bodyh|body_h|body_l',
					'js'       => 'a:not(.title a, .meta a, #copyright-area a, #footer a, #sidebar a, #top-area a, .menu a, .features a, .slidecontrols a, .tweet_time a)'
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_post_title_color]',
					'title'    => __('Post Title Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => '.title a, .post-title a, .tweet_time a',
					'hover'    => 'title|title_l|title_h',
					'js'       => '.title a'
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_post_title_color_hover]',
					'title'    => __('Post Title Hover Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => '.title a:hover, .post-title a:hover, .tweet_time a:hover',
					'hover'    => 'titleh|title_h|title_l',
					'js'       => '.title a'
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_meta_color]',
					'title'    => __('Meta Color', 'bmd'),
					'default'  => '#9D9D9D',
					'style'    => array('color'),
					'selector' => '.meta a, .meta, .tweet_time a',
					'hover'    => 'meta|meta_l|meta_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[body_meta_hover_color]',
					'title'    => __('Meta Hover Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => '.meta a:hover, .tweet_time a:hover',
					'hover'    => 'metah|meta_h|meta_l',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[headin_404_color]',
					'title'    => __('404 Heading Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => '.page-404 h1',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[text_404_color]',
					'title'    => __('404 Text Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => '.page-404 h3',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[wrapper_bg_color]',
					'title'    => __('Wrapper Background Color', 'bmd'),
					'default'  => '#ffffff',	
					'style'    => array('background-color'),
					'selector' => '#wrapper, .page-title h1, .page-title h2, .page-title h3, .page-title h4, .page-title h5, .page-title h6, #filtrable, #reply-title a',
				);



	if ($smof_data['layout'] == 0 ) :

		$customizer[] = array( 
						'type'     => 'image',
						'id'       => THEME_NAME.'[wrapper_bg_img]',
						'title'    => __('Wrapper Background Color', 'bmd'),
						'default'  => '',	
						'style'    => array('background-image'),
						'selector' => '#wrapper, .page-title h1, .page-title h2, .page-title h3, .page-title h4, .page-title h5, .page-title h6, #filtrable, #reply-title a',
					);

		$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[body_bg_color]',
						'title'    => __('Body Background Color', 'bmd'),
						'default'  => '#ffffff',	
						'style'    => array('background-color'),
						'selector' => 'body',
					);

		$customizer[] = array( 
						'type'     => 'image',
						'id'       => THEME_NAME.'[body_bg_img]',
						'title'    => __('Body Background Color', 'bmd'),
						'default'  => BMD_PATH . '/images/bg.png',	
						'style'    => array('background-image'),
						'selector' => 'body',
					);
	endif;


/*-----------------------------------------------------------------------------------*/
/* FONT STYLE
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'font_style', 'title' => 'Body: Font Style' );
	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_heading]',
					'title'    => __('Heading Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => 'h1, h2, h3, h4, h5, h6, #sidebar .tab-header li',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
					'js'       => '#content-area :header:not(.title), #header :header'	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_body]',
					'title'    => __('Body Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => 'body',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_post_title]',
					'title'    => __('Block Post Title Font Style', 'bmd'),
					'default'  => 'Arial:700',
					'selector' => '.title',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[read_title]',
					'title'    => __('Read More Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '.readmore',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[meta_title]',
					'title'    => __('Meta Font Style', 'bmd'),
					'default'  => 'Arial:400:Italic',
					'selector' => '.meta a, .meta, .tweet_time a, p.team-function',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[heading_404_font]',
					'title'    => __('404 Heading Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => '.page-404 h1',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[text_404_font]',
					'title'    => __('404 Text Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => '.page-404 h3',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );


/*-----------------------------------------------------------------------------------*/
/* FONT SIZE
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'font_size', 'title' => 'Body: Font Size' );
	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_h1_size]',
					'title'    => __('H1 Font Size', 'bmd'),
					'default'  => '26px',
					'selector' => 'h1',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_h2_size]',
					'title'    => __('H2 Font Size', 'bmd'),
					'default'  => '18px',
					'selector' => 'h2',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_h3_size]',
					'title'    => __('H3 Font Size', 'bmd'),
					'default'  => '14px',
					'selector' => 'h3',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_h4_size]',
					'title'    => __('H4 Font Size', 'bmd'),
					'default'  => '18px',
					'selector' => 'h4',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_h5_size]',
					'title'    => __('H5 Font Size', 'bmd'),
					'default'  => '16px',
					'selector' => 'h5',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_h6_size]',
					'title'    => __('H6 Font Size', 'bmd'),
					'default'  => '14px',
					'selector' => 'h6',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[body_size]',
					'title'    => __('body Font Size', 'bmd'),
					'default'  => '13px',
					'selector' => 'body',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[post_title_size]',
					'title'    => __('Latest Post Title Font Size', 'bmd'),
					'default'  => '13px',
					'selector' => '.title',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[read_size]',
					'title'    => __('Read More Font Size', 'bmd'),
					'default'  => '12px',
					'selector' => '.readmore',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[meta_size]',
					'title'    => __('Meta Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => '.meta a, .meta, .tweet_time a, p.team-function, .team-social a',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[breadcrumbs_size]',
					'title'    => __('Breadcrumbs Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => '#crumbs',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[error_size]',
					'title'    => __('Blog Post Font Size', 'bmd'),
					'default'  => '16px',
					'selector' => '.blog-post-wrapper .title',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[heading_404_size]',
					'title'    => __('404 Heading Font Size', 'bmd'),
					'default'  => '150px',
					'selector' => '.page-404 h1',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[text_404_size]',
					'title'    => __('404 Text Font Size', 'bmd'),
					'default'  => '14px',
					'selector' => '.page-404 h3',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* TOP COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'logo_area', 'title' => 'Top Area: Options' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[top_bg_color]',
					'title'    => __('Background Color', 'bmd'),
					'default'  => '#242429',
					'style'    => array('background-color'),
					'selector' => '#top-area',
	            );
	
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[top_social_color]',
					'title'    => __('Social Icon Color', 'bmd'),
					'default'  => '#58585F',
					'style'    => array('color'),
					'selector' => '#top-area ul.social a',
					'hover'    => 'top|top_l|top_h',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[top_social_hover_color]',
					'title'    => __('Social Icon Hover Color', 'bmd'),
					'default'  => '#CACAD2',
					'style'    => array('color'),
					'selector' => '#top-area ul.social a:hover',
					'hover'    => 'top2|top_h|top_l',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[top_link_color]',
					'title'    => __('Link Color', 'bmd'),
					'default'  => '#38b7a5',
					'style'    => array('color'),
					'selector' => '#top-area #top-menu a, #top-area .top-text a',
					'hover'    => 'toplink|toplink_l|toplink_h',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[top_link_hover_color]',
					'title'    => __('Link Hover Color', 'bmd'),
					'default'  => '#dddddd',
					'style'    => array('color'),
					'selector' => '#top-area #top-menu a:hover, #top-area .top-text a:hover',
					'hover'    => 'toplinkk|toplink_h|toplink_l',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[top_text_color]',
					'title'    => __('Text Color', 'bmd'),
					'default'  => '#DDDDDD',
					'style'    => array('color'),
					'selector' => '#top-area .top-text',
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[top_text_size]',
					'title'    => __('Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => '#top-area #top-menu a, #top-area .top-text',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[header_border_top_color]',
					'title'    => __('Header Border Top Color', 'bmd'),
					'default'  => '#242429',
					'style'    => array('border-color'),
					'selector' => '#header.style3, #header.style10',
	            );


/*-----------------------------------------------------------------------------------*/
/* MENU AREA
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'menu_area', 'title' => 'Menu: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_link_color]',
					'title'    => __('Link Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => '#menu > li > a',
					'js'       => '#menu > li:not(.current-menu-item) > a',
					'hover'    => 'menu|menu_l|menu_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_link_hover_color]',
					'title'    => __('Link Hover Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => '#menu > li > a:hover',
					'js'       => '#menu > li:not(.current-menu-item) > a',
					'hover'    => 'menuh|menu_h|menu_l',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_link_current_color]',
					'title'    => __('Current Link Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => '#menu > li.current-menu-item > a, #menu > li.current-menu-ancestor > a',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_menu]',
					'title'    => __('Menu Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => '#menu > li > a, .res-menu > li > a',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[menu_font_size]',
					'title'    => __('Menu Font Size', 'bmd'),
					'default'  => '14px',
					'selector' => '#menu > li > a',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );





	/* Sublnk Option */
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_sub_link_color]',
					'title'    => __('Sub Link Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => '#menu ul a',
					'hover'    => 'sub|sub_l|sub_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_sub_link_hover_color]',
					'title'    => __('Sub Link Hover Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => '#menu ul a:hover, #menu ul .page_item > a',
					'hover'    => 'subh|sub_h|sub_l',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_sub_border]',
					'title'    => __('Sub Link Border Color', 'bmd'),
					'default'  => '#2D2D33',
					'style'    => array('border-color'),
					'selector' => '#menu ul a',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_sub_bg]',
					'title'    => __('Sub Background Color', 'bmd'),
					'default'  => '#242429',
					'style'    => array('background-color'),
					'selector' => '#menu ul',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[menu_sub_borderr]',
					'title'    => __('Sub Border Color', 'bmd'),
					'default'  => '#1C1C1F',
					'style'    => array('border-color'),
					'selector' => '#menu ul',
				);
	
	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[sub_font_menu]',
					'title'    => __('Sub Menu Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '#menu ul a',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[sub_menu_font_size]',
					'title'    => __('Sub Menu Font Size', 'bmd'),
					'default'  => '12px',
					'selector' => '#menu ul a',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );


	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[res_menu_bg_color]',
					'title'    => __('Reponsive Menu Background Color', 'bmd'),
					'default'  => '#242429',
					'style'    => array('background-color'),
					'selector' => '.res-menu',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[res_menu_border_color]',
					'title'    => __('Reponsive Menu Border Color', 'bmd'),
					'default'  => '#373737',
					'style'    => array('border-color'),
					'selector' => '.res-menu li',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[res_menu_link_color]',
					'title'    => __('Reponsive Menu Link Color', 'bmd'),
					'default'  => '#cacad2',
					'style'    => array('color'),
					'selector' => '.res-menu a',
					'hover'    => 'res|res_l|res_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[res_menu_link_hover_color]',
					'title'    => __('Reponsive Menu Hover Color', 'bmd'),
					'default'  => '#ffffff',
					'style'    => array('color'),
					'selector' => '.res-menu a:hover',
					'hover'    => 'ress|res_h|res_l',
				);




/*-----------------------------------------------------------------------------------*/
/* PORTFOLIO OPTION
/*-----------------------------------------------------------------------------------*/
		$customizer[] = array( 'type' => 'section', 'id' => 'portfolio', 'title' => 'Portfolio Block: Color & Font' );

		$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[portfolio_text_color]',
						'title'    => __('Text Color', 'bmd'),
						'default'  => '#103C35',
						'style'    => array('color','border-color'),
						'selector' => '.portfolio-context span, .portfolio-context h2, .portfolio-context',
					);

		$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[portfolio_hover_color]',
						'title'    => __('Hover Background Color', 'bmd'),
						'default'  => '#38B7A5',
						'style'    => array('background-color'),
						'selector' => '.portfolio-items .portfolio-item-wrapper, .flickr-widget li a, .overlay',
					);

		$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[portfolio_filtrable_link_color]',
						'title'    => __('Filtrable Link Color', 'bmd'),
						'default'  => '#717171',
						'style'    => array('color'),
						'selector' => '#filtrable a',
						'hover'	   => 'filt|filt_l|filt_h',
						'js'       => '#filtrable  a:not(#filtrable  a.active)'
					);

		$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[portfolio_filtrable_link_hover_color]',
						'title'    => __('Filtrable Link Hover Color', 'bmd'),
						'default'  => '#38B7A5',
						'style'    => array('color'),
						'selector' => '#filtrable a:hover',
						'hover'	   => 'filth|filt_h|filt_l',
						'js'       => '#filtrable  a:not(#filtrable  a.active)'
					);

		$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[portfolio_filtrable_curent_link_color]',
						'title'    => __('Filtrable Curent Link Color', 'bmd'),
						'default'  => '#38B7A5',
						'style'    => array('color'),
						'selector' => '#filtrable a.active',
					);

		$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[filtrable_font]',
					'title'    => __('Filtrable Font Style', 'bmd'),
					'default'  => 'Arial:700',
					'selector' => '#filtrable a',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

		$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[filtrable_size]',
					'title'    => __('Filtrable Font size', 'bmd'),
					'default'  => '12px',
					'selector' => '#filtrable a',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,
	            );



/*-----------------------------------------------------------------------------------*/
/* ICON & BUTTON STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'icon', 'title' => 'Social Icon: Color' );
	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[social_color]',
						'title'    => __('Social Color', 'bmd'),
						'default'  => '#717171',
						'style'    => array('color'),
						'selector' => '.social a',
						'hover'    => 'social|social_l|social_h',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[social_color]',
						'title'    => __('Social Hover Color', 'bmd'),
						'default'  => '#333333',
						'style'    => array('color'),
						'selector' => '.social a:hover',
						'hover'    => 'sociall|social_h|social_l',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[social_border_color]',
						'title'    => __('Social Border Color', 'bmd'),
						'default'  => '#eeeeee',
						'style'    => array('border-color'),
						'selector' => '.social a',
						'hover'    => 'socialb|socialb_l|socialb_h',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[social_border_color]',
						'title'    => __('Social Hover Border Color', 'bmd'),
						'default'  => '#dddddd',
						'style'    => array('border-color'),
						'selector' => '.social a:hover',
						'hover'    => 'socialbb|socialb_h|socialb_l',
		            );





	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[button_color]',
						'title'    => __('Button Text Color', 'bmd'),
						'default'  => '#ffffff',
						'style'    => array('color'),
						'selector' => '.button, #button',
						'hover'    => 'bt|bt_l|bt_h',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[button_hover_color]',
						'title'    => __('Button Text Hover Color', 'bmd'),
						'default'  => '#ffffff',
						'style'    => array('color'),
						'selector' => '.button:hover, #button:hover',
						'hover'    => 'bt2|bt_h|bt_l',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[button_bg_color]',
						'title'    => __('Button Background Color', 'bmd'),
						'default'  => '#38B7A5',
						'style'    => array('background-color'),
						'selector' => '.button, #button',
						'hover'    => 'btbg|btbg_l|btbg_h',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[button_bg_hover_color]',
						'title'    => __('Button Hover Background Color', 'bmd'),
						'default'  => '#13BC9D',
						'style'    => array('background-color', 'border-color'),
						'selector' => '.button:hover, #button:hover',
						'hover'    => 'btbg2|btbg_h|btbg_l',
		            );

	$customizer[] = array( 
						'type'     => 'color',
						'id'       => THEME_NAME.'[button_border_color]',
						'title'    => __('Button Border Color', 'bmd'),
						'default'  => '#14B194',
						'style'    => array('border-color'),
						'selector' => '.button, #button',
		            );

	$customizer[] = array( 
						'type'     => 'select',
						'id'       => THEME_NAME.'[button_font_style]',
						'title'    => __('Button Font Style', 'bmd'),
						'default'  => 'Arial:700',
						'selector' => '.button, #button',
						'style'	   => 'font-family',
						'choices'  => $google_fonts,
		            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[button_font_size]',
					'title'    => __('Button Font Size', 'bmd'),
					'default'  => '12px',
					'selector' => '.button, #button',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* SLIDER STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'slider', 'title' => 'Flexslider Slider: Color' );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[slider_nav]',
				'title'    => __('Slider Text Color', 'bmd'),
				'default'  => '#ffffff',
				'style'    => array('color'),
				'selector' => '.flexslider h5',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[slider_nav]',
				'title'    => __('Slider Nav Color', 'bmd'),
				'default'  => '#ffffff',
				'style'    => array('color'),
				'selector' => '.flex-direction-nav a',
				'hover'    => 'slider|slider_link|slider_link_h',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[slider_nav_hover]',
				'title'    => __('Slider Nav Hover Color', 'bmd'),
				'default'  => '#ffffff',
				'style'    => array('color'),
				'selector' => '.flex-direction-nav a:hover',
				'hover'    => 'sliderh|slider_link_h|slider_link',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[slider_nav_bg]',
				'title'    => __('Slider Nav Background Color', 'bmd'),
				'default'  => '#3D3D3D',
				'style'    => array('background-color'),
				'selector' => '.flex-direction-nav a',
				'hover'    => 'sliderbg|sliderbg_link|sliderbg_link_h',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[slider_nav_hover_bg]',
				'title'    => __('Slider Nav Hover Background Color', 'bmd'),
				'default'  => '#38B7A5',
				'style'    => array('background-color'),
				'selector' => '.flex-direction-nav a:hover',
				'hover'    => 'sliderbgh|sliderbg_link_h|sliderbg_link',
            );



/*-----------------------------------------------------------------------------------*/
/* FEATURES BLOCK STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'features', 'title' => 'Features: Color' );
	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[features_text_color]',
				'title'    => __('Text Color', 'bmd'),
				'default'  => '#9C9C9C',
				'style'    => array('color'),
				'selector' => '.features p',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[features_heading_color]',
				'title'    => __('Heading Color', 'bmd'),
				'default'  => '#3D3D3D',
				'style'    => array('color'),
				'selector' => '.features h3',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[features_icon_color]',
				'title'    => __('Icon Color', 'bmd'),
				'default'  => '#3D3D3D',
				'style'    => array('color'),
				'selector' => '.features i',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[features_border_color]',
				'title'    => __('Border Color', 'bmd'),
				'default'  => '#eeeeee',
				'style'    => array('border-color'),
				'selector' => '.features',
    );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[features_border_hover_color]',
				'title'    => __('Hover Border Color', 'bmd'),
				'default'  => '#dddddd',
				'style'    => array('border-color'),
				'selector' => '.features:hover',
				'hover'    => 'featuresh|features_h|features_l',
            );



/*-----------------------------------------------------------------------------------*/
/* PRICE BLOCK STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'price', 'title' => 'Price Table: Color' );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_title_font]',
					'title'    => __('Title Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => '.pricetable-wrapper li.pricetable-title h3',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_title_font_size]',
					'title'    => __('Title Font Size', 'bmd'),
					'default'  => '22px',
					'selector' => '.pricetable-wrapper li.pricetable-title h3',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_price_font]',
					'title'    => __('Price Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => '.pricetable-wrapper .pricetable-price h3',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_price_font_size]',
					'title'    => __('Price Font Size', 'bmd'),
					'default'  => '40px',
					'selector' => '.pricetable-wrapper .pricetable-price h3',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_timeline_font]',
					'title'    => __('Pricing Timeline Font Style', 'bmd'),
					'default'  => 'Arial:400:italic',
					'selector' => '.pricetable-wrapper .pricetable-price span',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_timeline_font_size]',
					'title'    => __('Pricing Timeline Size', 'bmd'),
					'default'  => '12px',
					'selector' => '.pricetable-wrapper .pricetable-price span',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_item_font]',
					'title'    => __('Pricing Item Font Style', 'bmd'),
					'default'  => 'Arial:700',
					'selector' => '.pricetable-wrapper li.pricetable-item',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[price_item_font_size]',
					'title'    => __('Pricing Item Size', 'bmd'),
					'default'  => '11px',
					'selector' => '.pricetable-wrapper li.pricetable-item',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );


	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price_bg_color]',
				'title'    => __('Style 1 Background Color', 'bmd'),
				'default'  => '#ffffff',
				'style'    => array('background-color'),
				'selector' => '.pricetable-wrapper.style1',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price_border_color]',
				'title'    => __('Style 1 Border Color', 'bmd'),
				'default'  => '#EBEBEB',
				'style'    => array('border-color'),
				'selector' => '.pricetable-wrapper.style1, .pricetable-wrapper li.pricetable-item span',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price_price_border_color]',
				'title'    => __('Price Style 1 Background Color', 'bmd'),
				'default'  => '#242429',
				'style'    => array('background-color'),
				'selector' => '.pricetable-wrapper.style1 .pricetable-price',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price_color]',
				'title'    => __('Price Style 1 Color', 'bmd'),
				'default'  => '#242429',
				'style'    => array('color'),
				'selector' => '.pricetable-wrapper.style1 .pricetable-title h3, .pricetable-wrapper.style1 li.pricetable-item span',
            );


	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price_bg_color]',
				'title'    => __('Style 2 Background Color', 'bmd'),
				'default'  => '#ffffff',
				'style'    => array('background-color'),
				'selector' => '.pricetable-wrapper.style2',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price_border_color]',
				'title'    => __('Style 2 Border Color', 'bmd'),
				'default'  => '#EBEBEB',
				'style'    => array('border-color'),
				'selector' => '.pricetable-wrapper.style2, .pricetable-wrapper li.pricetable-item span',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price2_price_border_color]',
				'title'    => __('Price Style 2 Background Color', 'bmd'),
				'default'  => '#38B7A5',
				'style'    => array('background-color'),
				'selector' => '.pricetable-wrapper.style2 .pricetable-price',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[price2_color]',
				'title'    => __('Price Style 2 Color', 'bmd'),
				'default'  => '#38B7A5',
				'style'    => array('color'),
				'selector' => '.pricetable-wrapper.style2 .pricetable-title h3, .pricetable-wrapper.style2 li.pricetable-item span',
            );



/*-----------------------------------------------------------------------------------*/
/* ALERT BOX STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'alert', 'title' => 'Alert Box: Color' );

	/* Standart Box */
	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_standart_text_color]',
				'title'    => __('Standart Box Text', 'bmd'),
				'default'  => '#888888',
				'style'    => array('color'),
				'selector' => '.alert.default',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_standart_bg]',
				'title'    => __('Standart Box Background', 'bmd'),
				'default'  => '#FCFCFC',
				'style'    => array('background-color'),
				'selector' => '.alert.default',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_standart_b]',
				'title'    => __('Standart Box Border', 'bmd'),
				'default'  => '#eeeeee',
				'style'    => array('border-color'),
				'selector' => '.alert.default',
            );


	/* Info Box */
	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_info_text_color]',
				'title'    => __('Info Box Text', 'bmd'),
				'default'  => '#547A92',
				'style'    => array('color'),
				'selector' => '.alert.info',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_info_bg]',
				'title'    => __('Info Box Background', 'bmd'),
				'default'  => '#EAF6FE',
				'style'    => array('background-color'),
				'selector' => '.alert.info',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_info_b]',
				'title'    => __('Info Box Border', 'bmd'),
				'default'  => '#C2E6FF',
				'style'    => array('border-color'),
				'selector' => '.alert.info',
            );


	/* Notification Box */
	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_notification_text_color]',
				'title'    => __('Notification Box Text', 'bmd'),
				'default'  => '#C4A658',
				'style'    => array('color'),
				'selector' => '.alert.note',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_notification_bg]',
				'title'    => __('Notification Box Background', 'bmd'),
				'default'  => '#FFFBF1',
				'style'    => array('background-color'),
				'selector' => '.alert.note',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_notification_b]',
				'title'    => __('Notification Box Border', 'bmd'),
				'default'  => '#F4E9CB',
				'style'    => array('border-color'),
				'selector' => '.alert.note',
            );


	/* Warning Box */
	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_warning_text_color]',
				'title'    => __('Warning Box Text', 'bmd'),
				'default'  => '#B85353',
				'style'    => array('color'),
				'selector' => '.alert.warning',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_warning_bg]',
				'title'    => __('Warning Box Background', 'bmd'),
				'default'  => '#FFE0E0',
				'style'    => array('background-color'),
				'selector' => '.alert.warning',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_warning_b]',
				'title'    => __('Warning Box Border', 'bmd'),
				'default'  => '#FEBBBB',
				'style'    => array('border-color'),
				'selector' => '.alert.warning',
            );


	/* Tips Box */
	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_tips_text_color]',
				'title'    => __('Tips Box Text', 'bmd'),
				'default'  => '#5A8861',
				'style'    => array('color'),
				'selector' => '.alert.tips',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_tips_bg]',
				'title'    => __('Tips Box Background', 'bmd'),
				'default'  => '#EAFFEE',
				'style'    => array('background-color'),
				'selector' => '.alert.tips',
            );

	$customizer[] = array( 
				'type'     => 'color',
				'id'       => THEME_NAME.'[alert_tips_b]',
				'title'    => __('Tips Box Border', 'bmd'),
				'default'  => '#86D492',
				'style'    => array('border-color'),
				'selector' => '.alert.tips',
            );



/*-----------------------------------------------------------------------------------*/
/* Toggles & Accordion STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'toggle', 'title' => 'Toggles & Accordion: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[toggle_bg]',
					'title'    => __('Background Color', 'bmd'),
					'default'  => '#fff',
					'style'    => array('background-color'),
					'selector' => '.toggle-block, .accordion-block, .tab-head.active');

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[toggle_border]',
					'title'    => __('Border Color', 'bmd'),
					'default'  => '#eeeeee',
					'style'    => array('border-color'),
					'selector' => '.toggle-block, .accordion-block, .toggle-block .tab-body, .accordion-block .tab-body');

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[toggle_heading]',
					'title'    => __('Heading Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => '.toggle-block .tab-head, .accordion-block .tab-head, .toggle-block .arrow, .accordion-block .arrow');


	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[toggle_icon]',
					'title'    => __('Icon Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => '.toggle-block .tab-head i, .accordion-block .tab-head i, .arrow i');


	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[toggle_font_heading]',
					'title'    => __('Heading Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '.toggle-block .tab-head, .accordion-block .tab-head',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[toggle_heading_size]',
					'title'    => __('Heading Font Size', 'bmd'),
					'default'  => '14px',
					'selector' => '.toggle-block .tab-head, .accordion-block .tab-head',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* TABS STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'tabs', 'title' => 'Tabs: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[tab_bg]',
					'title'    => __('Background Color', 'bmd'),
					'default'  => '#fff',
					'style'    => array('background-color'),
					'selector' => '.tab-content, .tab-nav li.ui-tabs-active a',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[tab_current_bg]',
					'title'    => __('Nav Background Color', 'bmd'),
					'default'  => '#FBFBFB',
					'style'    => array('background-color'),
					'selector' => '.tab-nav li:not(.ui-tabs-active) a, .tab-head',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[tab_border]',
					'title'    => __('Current Nav Border Top Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('border-top-color'),
					'selector' => '.tab-nav li.ui-tabs-active a'
				);


	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[tab_border]',
					'title'    => __('Border Color', 'bmd'),
					'default'  => '#eeeeee',
					'style'    => array('border-color'),
					'selector' => '.tab-content, .tab-nav li a'
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[tab_text]',
					'title'    => __('Nav Text Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('color'),
					'selector' => '.tab-nav li a',
					'hover'    => 'tab|tab_l|tab_h',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[tab_font_heading]',
					'title'    => __('Nav Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '.tab-nav li a',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[tab_heading_size]',
					'title'    => __('Nav Font Size', 'bmd'),
					'default'  => '13px',
					'selector' => '.tab-nav li a',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* PAGINATIO STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'pagination', 'title' => 'Pagination: Color' );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[pagination_link_color]',
					'title'    => __('Link Color', 'bmd'),
					'default'  => '#ffffff',
					'style'    => array('color'),
					'selector' => '#page-nav a',
					'js'       => '#page-nav a:not(.current)',
					'hover'    => 'pag|pag_l|pag_h',	
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[pagination_link_color_hover]',
					'title'    => __('Link Hover Color', 'bmd'),
					'default'  => '#ffffff',
					'style'    => array('color'),
					'selector' => '#page-nav a:hover',
					'js'       => '#page-nav a:not(.current)',
					'hover'    => 'pagh|pag_h|pag_l',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[pagination_link_bg_color]',
					'title'    => __('Link Background Color', 'bmd'),
					'default'  => '#3D3D3D',
					'style'    => array('background-color'),
					'selector' => '#page-nav a',
					'js'       => '#page-nav a:not(.current)',
					'hover'    => 'pagbg|pagbg_l|pagbg_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[pagination_link_bg_color_hover]',
					'title'    => __('Link Background Hover Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('background-color'),
					'selector' => '#page-nav a:hover',
					'js'       => '#page-nav a:not(.current)',
					'hover'    => 'pagbgh|pagbg_h|pagbg_l',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[pagination_link_curent_bg]',
					'title'    => __('Current Background', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('background-color'),
					'selector' => '#page-nav a.current',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[pag_font]',
					'title'    => __('Font Style', 'bmd'),
					'default'  => 'Arial:700',
					'selector' => '#page-nav',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[pag_size]',
					'title'    => __('Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => '#page-nav',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* BLOCKQUOTE & TESTIMONIALS STYLE COLOR
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'quote', 'title' => 'Blockquote & Testimonials: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',		
					'id'       => THEME_NAME.'[quote_bg]',
					'title'    => __('Blockquote Background Color', 'bmd'),
					'default'  => '#F8F8F8',
					'style'    => array('background-color'),
					'selector' => 'blockquote',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[quote_text]',
					'title'    => __('Blockquote Text Color', 'bmd'),
					'default'  => '#888888',
					'style'    => array('color'),
					'selector' => 'blockquote',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[quote_border]',
					'title'    => __('Blockquote Border Left Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('border-color'),
					'selector' => 'blockquote',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[quote_font]',
					'title'    => __('Blockquote & Testimonials Font Style', 'bmd'),
					'default'  => 'Merriweather:400',
					'selector' => 'blockquote, .testimonial-texts',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[quote_size]',
					'title'    => __('Blockquote & Testimonials Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => 'blockquote, .testimonial-texts',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* SIDEBAR OPTIONS
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'sidebar', 'title' => 'Sidebar: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[sidebar_heading]',
					'title'    => __('Widget Title Color', 'bmd'),
					'default'  => '#B8B8B8',
					'style'    => array('color'),
					'selector' => '#sidebar h3, #sidebar .tab-header li',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[sidebar_heading_size]',
					'title'    => __('Widget Title Size', 'bmd'),
					'default'  => '12px',
					'selector' => '#sidebar h3, #sidebar .tab-header li',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[sidebar_text]',
					'title'    => __('Text Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => '#sidebar',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[sidebar_text_font]',
					'title'    => __('Text Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '#sidebar',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[sidebar_text_size]',
					'title'    => __('Text Font Size', 'bmd'),
					'default'  => '12px',
					'selector' => '#sidebar',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );


	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[sidebar_link]',
					'title'    => __('Link Color', 'bmd'),
					'default'  => '#717171',
					'style'    => array('color'),
					'selector' => '#sidebar a',
					'hover'    => 'sidebar|sidebar_l|sidebar_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[sidebar_link_hover]',
					'title'    => __('Link Hover Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => '#sidebar a:hover, #sidebar li.current-menu-item a',
					'hover'    => 'sidebarh|sidebar_h|sidebar_l',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[sidebar_link_font]',
					'title'    => __('Link Font Style', 'bmd'),
					'default'  => 'Arial:700',
					'selector' => '#sidebar a',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );



/*-----------------------------------------------------------------------------------*/
/* FOOTER OPTIONS
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'footer', 'title' => 'Footer: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_bg_color]',
					'title'    => __('Background Color', 'bmd'),
					'default'  => '#242429',
					'style'    => array('background-color'),
					'selector' => '#footer',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_border_top_color]',
					'title'    => __('Boorder Top Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('border-color'),
					'selector' => '#footer',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_heading_color]',
					'title'    => __('Widget Title Color', 'bmd'),
					'default'  => '#ffffff',
					'style'    => array('color'),
					'selector' => '#footer h3',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_text_color]',
					'title'    => __('Text Color', 'bmd'),
					'default'  => '#909096',
					'style'    => array('color'),
					'selector' => '#footer',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_link_color]',
					'title'    => __('Link Color', 'bmd'),
					'default'  => '#DDDDDD',
					'style'    => array('color'),
					'selector' => '#footer a',
					'hover'    => 'footer|footer_l|footer_h',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_link_hover_color]',
					'title'    => __('Link Hover Color', 'bmd'),
					'default'  => '#38B7A5',
					'style'    => array('color'),
					'selector' => '#footer a:hover',
					'hover'    => 'footerh|footer_h|footer_l',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_tag_bg]',
					'title'    => __('Tag Background Color', 'bmd'),
					'default'  => '#1F1F1F',
					'style'    => array('background-color'),
					'selector' => '#footer .tagcloud a',
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_form_border]',
					'title'    => __('Form Border Color', 'bmd'),
					'default'  => '#33333A',
					'style'    => array('border-color'),
					'selector' => "#footer input[type='text'], #footer input[type='email'], #footer textarea",
					'js'       => "#footer input:text, #footer input:email, #footer textarea",
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_form_bg]',
					'title'    => __('Form Background Color', 'bmd'),
					'default'  => '#2A2A2F',
					'style'    => array('background-color'),
					'selector' => "#footer input[type='text'], #footer input[type='email'], #footer textarea",
					'js'       => "#footer input:text, #footer input:email, #footer textarea",
				);

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[footer_form_text]',
					'title'    => __('Form Text Color', 'bmd'),
					'default'  => '#CFCFCF',
					'style'    => array('color'),
					'selector' => "#footer input[type='text'], #footer input[type='email'], #footer textarea",
					'js'       => "#footer input:text, #footer input:email, #footer textarea",
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_footer_heading]',
					'title'    => __('Widget Title Font Style', 'bmd'),
					'default'  => 'Fjalla+One:400',
					'selector' => '#footer h3',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[font_text_heading]',
					'title'    => __('Content Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '#footer',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[footer_heading_size]',
					'title'    => __('Widget Title Size', 'bmd'),
					'default'  => '14px',
					'selector' => '#footer h3',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[footer_text_size]',
					'title'    => __('Text Font Size', 'bmd'),
					'default'  => '12px',
					'selector' => '#footer',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[footer_meta_size]',
					'title'    => __('Footer Meta Font Size', 'bmd'),
					'default'  => '10px',
					'selector' => '#footer .tweet_time, #footer .widget-comment',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[footer_form]',
					'title'    => __('Footer Contact Form Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => "#footer .wpcf7, #footer input[type='text'], #footer input[type='email'], #footer textarea",
					'js'       => "#footer .wpcf7, #footer input:text, #footer input:email, #footer textarea",
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );



/*-----------------------------------------------------------------------------------*/
/* COPYRIGHT OPTIONS
/*-----------------------------------------------------------------------------------*/
	$customizer[] = array( 'type' => 'section', 'id' => 'copyright', 'title' => 'Copyright: Color & Font' );
	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[copyright_bg_color]',
					'title'    => __('Background Color', 'bmd'),
					'default'  => '#222226',
					'style'    => array('background-color'),
					'selector' => '.copyright-area',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[copyright_border_top_color]',
					'title'    => __('Boorder Top Color', 'bmd'),
					'default'  => '#2B2B2F',
					'style'    => array('border-color'),
					'selector' => '.copyright-area',
	            );

	$customizer[] = array( 
					'type'     => 'color',
					'id'       => THEME_NAME.'[copyright_text_color]',
					'title'    => __('Text Color', 'bmd'),
					'default'  => '#656565',
					'style'    => array('color'),
					'selector' => '.copyright-area',
				);

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[copyright_font_style]',
					'title'    => __('Text Font Style', 'bmd'),
					'default'  => 'Arial:400',
					'selector' => '.copyright-area',
					'style'	   => 'font-family',
					'choices'  => $google_fonts,
	            );

	$customizer[] = array( 
					'type'     => 'select',
					'id'       => THEME_NAME.'[copyright_font_size]',
					'title'    => __('Text Font Size', 'bmd'),
					'default'  => '11px',
					'selector' => '.copyright-area',
					'style'	   => 'font-size',
					'choices'  => $fonts_size,	
	            );