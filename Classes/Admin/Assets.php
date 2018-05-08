<?php

	namespace ChefFormsGdpr\Admin;

	use \Cuisine\Utilities\Url;
	use \ChefFormsGdpr\Contracts\AssetLoader;

	class Assets extends AssetLoader{

		/**
		 * Enqueue scripts & Styles
		 * 
		 * @return void
		 */
		public function load(){

			/**
			 * Below are just some examples
			 */
			add_action( 'admin_menu', function(){

				//$url = Url::plugin( 'ChefFormsGdpr', true ).'Assets';

				//enqueue a script
				//wp_enqueue_script( 'ChefFormsGdpr_admin', $url.'/js/Admin.js' );

				//enqueue a stylesheet:
				//wp_enqueue_style( 'ChefFormsGdpr_style', $url, '/css/admin.css' );
				
			});
		}
	}