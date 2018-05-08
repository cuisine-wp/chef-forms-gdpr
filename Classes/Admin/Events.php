<?php

	namespace ChefFormsGdpr\Admin;

	use \Cuisine\Utilities\Url;
    use \ChefFormsGdpr\Contracts\EventListener;
    use \ChefFormsGdpr\Facades\Example;

	class Events extends EventListener{

		/**
		 * Listen for admin events
		 * 
		 * @return void
		 */
		public function listen(){

			add_action( 'admin_init', function(){
				
                //do something
                
			});

		}
	}
