<?php

	namespace ChefFormsGdpr\Admin;

	use \Cuisine\Wrappers\Field;
	use \ChefFormsGdpr\Helpers\Settings;
    use \ChefFormsGdpr\Contracts\EventListener;
	use \Cuisine\Wrappers\SettingsPage as SettingsPageBuilder;

	class SettingsPage extends EventListener{


		/**
		 * The settingspage used by this plugin
		 *
		 * @return void
		 */
		public function listen(){

            $fields = $this->getFields();
			$options = [
				'parent'		=> 'form',
				'menu_title'	=> __( 'Privacy Settings', 'chefformsgdpr' )
			];

			SettingsPageBuilder::make(
				__( 'Privacy Settings', 'chefformsgdpr' ),
				'gdpr-settings',
				$options

			)->set( $fields );

		}

		/**
		 * Return fields
		 *
		 * @return array
		 */
		protected function getFields(){

			$fields = [
				Field::text(
					'privacy_label',
					__( 'Label for the checkbox', 'cheformsgdpr' ),
					array(
						'defaultValue' => Settings::get( 'privacy_label' )
					)
				),

				Field::text(
					'privacy_url',
                    __( 'Url to Privacy Page', 'chefformsgdpr' ),
                    array(
						'defaultValue' => Settings::get( 'privacy_url' )
					)
				)
			];

			return $fields;
		}
	}
