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

			$this->handleExlusions();


			//when a form gets submitted:
			add_action( 'form_submitted', function( $form, $entry ){
				Processor::setPrivacy();
			}, 1, 2 );


			//register event
			/*wp_schedule_event( time(), 'hourly', 'chef_forms_gdpr_bot' );
			
			//hook into the event:
			add_action( 'chef_forms_gdpr_bot', function(){
				Processor::autoRemove();
			});*/

		}

		/*
		 * Register Exclusions	
		 *
		 * @return void
		 */
		public function handleExlusions()
		{
		
			//don't process default GDPR stuff in some cases:
			add_filter( 'do_gdpr_check', function( $boolean, $formId ){

				//Chef Users:
				if( class_exists( '\ChefUsers\Profiles\FormData' ) ){
					$ids = \ChefUsers\Profiles\FormData::getIds();
					if( in_array( $formId, $ids ) ){
						return false;
					}
				}


				//Chef Cart:
				if( class_exists( '\ChefCart\Helpers\Checkout' ) ){
					if( $formId == \ChefCart\Helpers\Checkout::getFormId() ){
						return false;
					}
				}


				return $boolean;

			}, 100, 2 );
		
		}

	}
