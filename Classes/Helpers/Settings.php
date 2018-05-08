<?php

    namespace ChefFormsGdpr\Helpers;

    class Settings{


        /**
		 * Get a setting
		 *
		 * @param  string $key
		 * @return mixed
		 */
		public static function get( $key ){

			$settings = self::findSettings();

			if( isset( $settings[ $key ] ) )
				return $settings[ $key ];

			return false;

		}



		/**
		 * Get the settings
		 *
		 * @return array
		 */
		private static function findSettings(){

			$defaults = [
                'privacy_label' => __( 'I agree with your privacy statement', 'chefformsgdpr' ),
                'privacy_url' => '',
			];

			return get_option( 'gdpr-settings', $defaults );

		}
    }