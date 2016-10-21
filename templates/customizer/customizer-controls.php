<?php
/**
 * Sortable multi check boxes custom control.
 * @since 0.1.0
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2015, Genbu Media
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class fx_Share_Customize_Control_Sortable_Checkboxes extends WP_Customize_Control {

	/**
	 * Control Type
	 */
	public $type = 'fx-share-multicheck-sortable';

	/**
	 * Enqueue Scripts
	 */
	public function enqueue() {
		wp_enqueue_style( 'ampforwp-share-customize' );
		wp_enqueue_script( 'ampforwp-share-customize' );
	}

	/**
	 * Render Settings
	 */
	public function render_content() {

		/* if no choices, bail. */
		if ( empty( $this->choices ) ){
			return;
		} ?>

		<?php if ( !empty( $this->label ) ){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php } // add label if needed. ?>

		<?php if ( !empty( $this->description ) ){ ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php } // add desc if needed. ?>

		<?php
		/* Data */
		$values = explode( ',', $this->value() );
		$choices = $this->choices;

		/* If values exist, use it. */
		$options = array();
		if( $values ){

			/* get individual item */
			foreach( $values as $value ){

				/* separate item with option */
				$value = explode( ':', $value );

				/* build the array. remove options not listed on choices. */
				if ( array_key_exists( $value[0], $choices ) ){
					$options[$value[0]] = $value[1] ? '1' : '0'; 
				}
			}
		}
		/* if there's new options (not saved yet), add it in the end. */
		foreach( $choices as $key => $val ){

			/* if not exist, add it in the end. */
			if ( ! array_key_exists( $key, $options ) ){
				$options[$key] = '0'; // use zero to deactivate as default for new items.
			}
		}
		?>

		<ul class="fx-share-multicheck-sortable-list">

			<?php foreach ( $options as $key => $value ){ ?>

				<li>
					<label>
						<input name="<?php echo esc_attr( $key ); ?>" class="fx-share-multicheck-sortable-item" type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( $value ); ?> /> 
						<?php echo esc_html( $choices[$key] ); ?>
					</label>
					<i class="dashicons dashicons-menu fx-share-multicheck-sortable-handle"></i>
				</li>

			<?php } // end choices. ?>

				<li class="fx-share-hideme">
					<input type="hidden" class="fx-share-multicheck-sortable" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				</li>

		</ul><!-- .fx-share-multicheck-sortable-list -->


	<?php
	}
}

/**
 * Multi check boxes custom control.
 * @since 0.1.0
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2015, Genbu Media
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class fx_Share_Customize_Control_Checkboxes extends WP_Customize_Control {

	/**
	 * Control Type
	 */
	public $type = 'fx-share-multicheck';

	/**
	 * Enqueue Scripts
	 */
	public function enqueue() {
		wp_enqueue_style( 'fx-share-customize' );
		wp_enqueue_script( 'fx-share-customize' );
	}

	/**
	 * Render Settings
	 */
	public function render_content() {

		/* if no choices, bail. */
		if ( empty( $this->choices ) ){
			return;
		} ?>

		<?php if ( !empty( $this->label ) ){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php } // add label if needed. ?>

		<?php if ( !empty( $this->description ) ){ ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php } // add desc if needed. ?>

		<?php
		/* Data */
		$values = explode( ',', $this->value() );
		$choices = $this->choices;

		/* If values exist, use it. */
		$options = array();

		/* get individual post type */
		foreach( $choices as $key => $label ){
			$options[$key] = in_array( $key, $values ) ? '1' : '0';
		}
		?>

		<ul class="fx-share-multicheck-list">

			<?php foreach ( $choices as $key => $label ){ ?>

				<li>
					<label>
						<input name="<?php echo esc_attr( $key ); ?>" class="fx-share-multicheck-item" type="checkbox" value="<?php echo esc_attr( $options[$key] ); ?>" <?php checked( $options[$key] ); ?> /> 
						<?php echo esc_html( $label ); ?>
					</label>
				</li>

			<?php } // end choices. ?>

			<li class="fx-share-hideme">
				<input type="hidden" class="fx-share-multicheck" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
			</li>

		</ul><!-- .fx-share-multicheck-list -->

	<?php
	}
}
