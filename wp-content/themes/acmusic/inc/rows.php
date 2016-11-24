<?php
/**
 * Dynamic styles for the Page Builder rows
 *
 * @package acmusic
 */
?>
<?php

function acmusic_panels_row_style_fields($fields) {

	$fields['color'] = array(
		'name' => __('Color', 'acmusic'),
		'type' => 'color',
	);
	$fields['background'] = array(
		'name' => __('Background Color', 'acmusic'),
		'type' => 'color',
	);
	$fields['background_image'] = array(
		'name' => __('Background Image', 'acmusic'),
		'type' => 'url',
	);
	$fields['class'] = array(
			'name' => __('Row Class', 'acmusic'),
			'type' => 'text',
			'group' => 'attributes',
			'description' => __('A CSS class', 'acmusic'),
			'priority' => 5,
	);
	$fields['cell_class'] = array(
			'name' => __('Cell Class', 'acmusic'),
			'type' => 'text',
			'group' => 'attributes',
			'description' => __('Class added to all cells in this row.', 'acmusic'),
			'priority' => 6,
	);
	return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'acmusic_panels_row_style_fields');
remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );

function acmusic_panels_panels_row_style_attributes($attr, $style) {
	$attr['style'] = '';

	if(!empty($style['background'])) $attr['style'] .= 'background-color: '.$style['background'].'; ';
	if(!empty($style['color'])) $attr['style'] .= 'color: '.$style['color'].'; ';
	if(!empty($style['background_image'])) $attr['style'] .= 'background-image: url('.esc_url($style['background_image']).'); ';

	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'acmusic_panels_panels_row_style_attributes', 10, 2);

/* Theme widgets */
function acmusic_theme_widgets($widgets) {
	$theme_widgets = array(
		'acmusic_connections',
		'acmusic_Programs',
		'acmusic_Fp_Social_Profile',
		'acmusic_Blockquote',
		'acmusic_Skills',
		'acmusic_Facts',
		'acmusic_members',
		'acmusic_Clients',
		'acmusic_Projects',
		'acmusic_Action',
		'acmusic_Latest_News',
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('acmusic-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'acmusic_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function acmusic_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('acmusic Theme Widgets', 'acmusic'),
		'filter' => array(
			'groups' => array('acmusic-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'acmusic_theme_widgets_tab', 20);
