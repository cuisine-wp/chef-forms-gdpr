<?php

	namespace ChefFormsGdpr\Front;

	use \ChefFormsGdpr\Facades\Processor;
	use \ChefFormsGdpr\Contracts\EventListener;

	class Events extends EventListener{


		/**
		 * Listen to front-end events
		 * 
		 * @return void
		 */
		public function listen(){


			//when a form gets submitted:
			add_action( 'form_submitted', function( $form, $entry ){
				Processor::setPrivacy();
			}, 1, 2 );


			//register event
			wp_schedule_event( time(), 'hourly', 'chef_forms_gdpr_bot' );
			
			//hook into the event:
			add_action( 'chef_forms_gdpr_bot', function(){
				Processor::autoRemove();
			});

		}

	}
