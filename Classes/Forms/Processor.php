<?php

    namespace ChefFormsGdpr\Forms;

    use WP_Query;

    class Processor{


        /**
         * Set the privacy preferences of a particular entry
         *
         * @param Entry $entry
         * @return void
         */
        public function setPrivacy()
        {
            if( apply_filters( 'do_gdpr_check', true, $_POST['_fid'] ) ){
                
                $saveEntry = false;
                
                if( 
                    isset( $_POST['gdpr_permission'] ) && 
                    $_POST['gdpr_permission'] == 'true'
                ){
                    $saveEntry = true;
                }


                
                if( !$saveEntry && isset( $_POST['entry_id'] ) ){
                    add_post_meta( $_POST['entry_id'], 'gdpr_remove', 'true' );
                }
            }
        }


        /**
         * Auto-remove all entries that are marked
         * 
         */
        public function autoRemove()
        {
            $query = $this->getQuery();
            
            if( $query->have_posts() ){
                while( $query->have_posts() ){
                    $query->the_post();
                    wp_delete_post( get_the_ID() );
                }
            }
        }


        /**
         * Returns a WP_Query of all non-processed Entries:
         *
         * @return void
         */
        public function getQuery()
        {   

            $time = time() - ( 60 * 30 ); //half an hour

            $args = [
                'post_type' => 'form-entry',
                'post_status' => 'publish',
                'meta_key' => 'gdpr_remove',
                'meta_value' => 'true',
                'date_query' => [
                    'before' => date( 'Y-m-d H:i:s', $time )
                ]
            ];

            return new WP_Query( $args );
        }
    }   