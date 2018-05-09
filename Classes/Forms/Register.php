<?php

    namespace ChefFormsGdpr\Forms;

    use ChefFormsGdpr\Helpers\Settings;
    use ChefFormsGdpr\Contracts\EventListener;

    class Register extends EventListener{

        /**
         * Listen for the form field filter and register our new fields
         *
         * @return void
         */
        public function listen()
        {
            
            //register the field-type:
            add_filter( 'chef_forms_field_types', [ $this, 'register' ], 200);
            add_filter( 'cuisine_forms_field_types', [ $this, 'register'], 200 );  

            //register the overwrite:
			add_filter( 'get_post_metadata', [ $this, 'addPrivacySetting'], 100, 4 );

        }


        /**
         * Register the field types:
         *
         * @param Array $types
         * 
         * @return Array
         */
        public function register( $types )
        {
            $types['gdpr-checkbox'] = array(
                'name'  => 'GDPR Checkbox',
                'class' => 'ChefFormsGdpr\\Forms\\GdprCheckboxField',
                'icon'  => ''
            );

            return $types;
        }


        /**
		 * Add a privacy setting from the post-meta
		 *
		 * @param String $metadata
		 * @param Int $object_id
		 * @param String $meta_key
		 * @param Boolean $single
		 * 
		 * @return void
		 */
		public function addPrivacySetting( $metadata, $post_id, $meta_key, $single )
		{
		
			if( 
				!is_admin() && 
				$meta_key == 'fields' && 
				get_post_type( $post_id ) == 'form' &&
				apply_filters( 'do_gdpr_check', true, $post_id )
			){
		
				//temporary remove the filter:
				remove_filter( 'get_post_metadata', [$this, 'addPrivacySetting'], 100 );

					$data = get_post_meta( $post_id, 'fields', true );
					$ignorePrivacy = get_post_meta( $post_id, 'ignore_privacy', true );
				
				//re-add the filter
				add_filter( 'get_post_metadata', [$this, 'addPrivacySetting'], 100, 4 );

				if( !empty( $data ) && $ignorePrivacy !== 'true' ){

					$data[] = [
						'label' => Settings::get( 'privacy_label' ),
						'placeholder' => '',
						'defaultValue' => false,
						'required' => false,
						'validation' => '',
						'type' => 'gdpr-checkbox',
						'deletable' => false,
						'position' => 9999,
						'row' => 9999,
						'classes' => ['gdpr-checkbox']
					];
				}
				
				return [$data];
			}

			return $metadata;	
        }
        
    }