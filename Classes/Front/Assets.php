<?php

    namespace ChefFormsGdpr\Front;

    use ChefFormsGdpr\Contracts\AssetLoader;

    class Assets extends AssetLoader{

        /**
         * Load various assets
         *
         * @return void
         */
        public function load()
        {
            add_action( 'wp_head', function(){
                echo '<style>';
                    echo '.form-fields .field-row .field-wrapper.gdpr-checkbox, .form-fields .field-wrapper.gdpr-checkbox{';
                        echo 'display: flex;';
                    echo '}';
                    echo '.form-fields .field-row .field-wrapper.gdpr-checkbox input, .form-fields .field-wrapper.gdpr-checkbox input{';
                        echo 'width: 30px !important; margin-right: 5px;';
                    echo '}';
                echo '</style>';
            });
        }

    }