<?php
namespace ChefFormsGdpr;

class Autoloader
{

    /**
     * Load the initial static files:
     *
     * @return void
     */
    public function load()
    {
        //register the custom field type:
        Forms\Register::getInstance();

        //register events and assets:
        Front\Events::getInstance();
        Front\Assets::getInstance();

        //and the admin:
        if (is_admin()) {
            Admin\SettingsPage::getInstance();
        }
    }


    /**
     * Register the autoloader
     *
     * @return ChefFormsGdpr\Autoloader
     */
    public function register()
    {
        spl_autoload_register(function ($class) {

            if ( stripos( $class, __NAMESPACE__ ) === 0 ) {

                $filePath = str_replace( '\\', DS, substr( $class, strlen( __NAMESPACE__ ) ) );
                include( __DIR__ . DS . 'Classes' . $filePath . '.php' );

            }

        });

        return $this;
    }
}