<?php
/**
 * @package mam-sales-board
 */

namespace Mam\SalesBoard\Admin;


use Mam\SalesBoard\Base\ServiceInterface;

class OptionPage implements ServiceInterface{

    public function register() {
        add_action( 'plugins_loaded', [$this, 'add_option_page']);
        add_action( 'plugins_loaded', [$this, 'add_custom_fields']);
    }

    public static function add_custom_fields() {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_5ed5e628d23f7',
                'title' => 'Sales Board',
                'fields' => array(
                    array(
                        'key' => 'field_5ed5e63b86dd4',
                        'label' => 'Sales',
                        'name' => 'sales',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5ed5e65b86dd5',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5ed5e66a86dd6',
                                'label' => 'Country',
                                'name' => 'country',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    'AUD' => 'AUD',
                                    'THB' => 'THB',
                                    'GBP' => 'GBP',
                                ),
                                'default_value' => false,
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                            array(
                                'key' => 'field_5ed5e68686dd7',
                                'label' => 'Recurring Target',
                                'name' => 'recurring_target',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5ed5e69a86dd8',
                                'label' => 'Recurring Collected',
                                'name' => 'recurring_collected',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 0,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5edf006f7dfa3',
                                'label' => 'New Recurring',
                                'name' => 'new_recurring',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 0,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5ed5e6b886dd9',
                                'label' => 'Singles',
                                'name' => 'singles',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 0,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_5ed7000233213',
                        'label' => 'UK Record Month',
                        'name' => 'uk_record_month',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5ed7001333214',
                        'label' => 'Thai Record Month',
                        'name' => 'thai_record_month',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5ed7001f33215',
                        'label' => 'Aus Record Month',
                        'name' => 'aus_record_month',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'mam-sales-board',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));

        endif;
    }

    public static function add_option_page() {
        // Register the option page using ACF
        if ( function_exists( 'acf_add_options_page' ) ) {

            // parent page
            acf_add_options_page(array(
                'page_title' 	=> 'MAM',
                'menu_title'	=> 'MAM',
                'menu_slug' 	=> 'mam',
                'capability'	=> 'read',
                'redirect'		=> true
            ));

            // child page
            acf_add_options_sub_page(array(
                'page_title' => 'Sales Board',
                'menu_title' => 'Sales Board',
                'menu_slug'  => 'mam-sales-board',
                'capability'	=> 'read',
                'parent_slug'	=> 'mam'
            ));
        }
    }

}