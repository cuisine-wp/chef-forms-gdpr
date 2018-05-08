<?php
namespace ChefFormsGdpr\Forms;

use ChefForms\Fields\DefaultField;
use ChefFormsGdpr\Helpers\Settings;


class GdprCheckboxField extends DefaultField{


    /**
     * Method to override to define the input type
     * that handles the value.
     *
     * @return void
     */
    protected function fieldType(){
        $this->type = 'gdpr-checkbox';
    }

    /**
     * Render this checkbox
     */
    public function render(  )
    {
        $this->id = 'gdpr_permission';
        $this->sanitizeProperties();

        
        $html = '';
        $html .= '<div class="field-wrapper gdpr-checkbox">';

            //add a hidden field before the checkbox, if not checked:
            $html .= '<input type="hidden" name="gdpr_permission" value="false"/>';
            $html .= '<input type="checkbox" ';

                $html .= 'id="'.$this->id.'" ';

                $html .= 'class="gdpr-permission permission-checkbox" ';

                $html .= 'name="gdpr_permission" ';

                $html .= 'value="true" '; 

                if( $this->getValue() == 'true' || $this->getValue() == '1' )
                    $html .= ' checked';

                $html .= ' '.$this->getValidation();

            $html .= '/>';

            $html .= '<label for="'.$this->id.'">'.$this->getLabel().'</label>';
        
        $html .= '</div>';
       
        echo $html;
    }

    /**
     * Generate the preview for this field:
     * 
     * @return string (html)
     */
    public function buildPreview( $mainOverview = false ){
        echo '';
    }


    /**
     * Get the validation data-attribute
     * 
     * @return String
     */
    public function getValidation(){

        if( $this->properties['required'] )
            $this->addValidation( 'required' );

        if( !empty( $this->properties['validation'] ) )
            return ' data-validate="'.implode( ',', $this->properties['validation'] ).'"';

    }

    
    /**
     * Get the value of this field:
     * 
     * @return String
     */
    public function getValue(){

        global $post;
        $value = $val = false;

        if( $value && !$val )
            $val = $value;

        if( $this->properties['defaultValue'] && !$val )
            $val = $this->getDefault();

        if( $this->getProperty('stripSlashes') == true )
            $val = stripcslashes( $val );


        return $val;
    }

    /**
     * Get the label
     */
    public function getLabel()
    {
        $label = $this->properties['label'];
        $strings = $this->getPrivacyStrings();
        $url = Settings::get( 'privacy_url' );

        if( $url && filter_var( $url, FILTER_VALIDATE_URL ) != '' ){
            
            foreach( $strings as $string ){
                
                //hyphenated
                $label = str_replace( 
                    ucwords( $string ), 
                    '<a href="'.$url.'" title="'.$string.'" target="_blank">'.ucwords( $string ).'</a>',
                     $label
                );

                //lowercase:
                $label = str_replace( 
                    $string, 
                    '<a href="'.$url.'" title="'.$string.'" target="_blank">'.$string.'</a>',
                     $label
                );
            
            }
        }

        return $label;
    }


    /**
     * Get different privacy strings
     *
     * @return Array
     */
    public function getPrivacyStrings()
    {
        $strings = [
            'privacy statement',
            'privacy pagina',
            'privacy policy',
            'privacy overeenkomst',
            'rivacyovereenkomst',
        ];

        $strings = apply_filters( 'chef_forms_gdrp_privacy_names', $strings );
        return $strings;
    }



}