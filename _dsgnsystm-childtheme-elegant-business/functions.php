<?php
/**
 * One Theme Alt functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage _One_Theme_Alt
 * @since 1.0.0
 */

if ( ! function_exists( '_dsgnsystm_elegant_business_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _dsgnsystm_elegant_business_setup() {

		// Enqueue CSS-Variables for editor.
		add_editor_style( 'style.css' );

		// Add custom editor font sizes to match CSS-Variables.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', '_dsgnsystm' ),
					'shortName' => __( 'S', '_dsgnsystm' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', '_dsgnsystm' ),
					'shortName' => __( 'M', '_dsgnsystm' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', '_dsgnsystm' ),
					'shortName' => __( 'L', '_dsgnsystm' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', '_dsgnsystm' ),
					'shortName' => __( 'XL', '_dsgnsystm' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

/*
		Custom Customizer Colors?

		$default_hue     = _dsgnsystm_elegant_business_get_default_hue();
		$saturation      = _dsgnsystm_elegant_business_get_default_saturation();
		$lightness       = _dsgnsystm_elegant_business_get_default_lightness();
		$lightness_hover = _dsgnsystm_elegant_business_get_default_lightness_hover();

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', '_dsgnsystm' ),
					'slug'  => 'primary',
					'color' => _dsgnsystm_elegant_business_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? $default_hue : get_theme_mod( 'primary_color_hue', $default_hue ), $saturation, $lightness ),
				),
				array(
					'name'  => __( 'Secondary', '_dsgnsystm' ),
					'slug'  => 'secondary',
					'color' => _dsgnsystm_elegant_business_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? $default_hue : get_theme_mod( 'primary_color_hue', $default_hue ), $saturation, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', '_dsgnsystm' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', '_dsgnsystm' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', '_dsgnsystm' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);
*/
	}
endif;
add_action( 'after_setup_theme', '_dsgnsystm_elegant_business_setup' );

/**
 * Set the content width in pixels, based on the child-theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function _dsgnsystm_elegant_business_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( '_dsgnsystm_elegant_business_content_width', 640 );
}
add_action( 'after_setup_theme', '_dsgnsystm_elegant_business_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function _dsgnsystm_elegant_business_scripts() {
	// enqueue parent styles
	wp_enqueue_style('_dsgnsystm-style', get_template_directory_uri() .'/style.css', array(), wp_get_theme()->get( 'Version' ));
	// enqueue child styles
	wp_enqueue_style('_dsgnsystm-elegant-business', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ));
}
add_action( 'wp_enqueue_scripts', '_dsgnsystm_elegant_business_scripts' );

/**
 * Enqueue supplemental block editor styles.
 */
function _dsgnsystm_elegant_business_editor_customizer_styles() {

	wp_enqueue_style( '_dsgnsystm-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( '_dsgnsystm-editor-customizer-styles', _dsgnsystm_elegant_business_custom_colors_css() );
	}
}
// add_action( 'enqueue_block_editor_assets', '_dsgnsystm_elegant_business_editor_customizer_styles' );

/**
 * Enqueue theme styles for the block editor.
 */
function _dsgnsystm_elegant_business_editor_theme_variables() {
	/* Add Child Theme CSS-Variables to Editor */
	wp_enqueue_style( '_dsgnsystm-alt-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'enqueue_block_editor_assets', '_dsgnsystm_elegant_business_editor_theme_variables' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function _dsgnsystm_elegant_business_colors_css_wrap() {

	// Only bother if we haven't customized the color.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = _dsgnsystm_elegant_business_get_default_hue();
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', $primary_color );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo _dsgnsystm_elegant_business_custom_colors_css(); ?>
	</style>
	<?php
}
// add_action( 'wp_head', '_dsgnsystm_elegant_business_colors_css_wrap' );
