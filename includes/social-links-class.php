<?php

class Social_Links_Widget extends WP_Widget {
    /**
     * Setup the widgets name etc.
     */
    public function __construct() {
        parent::__construct(
            'social_links_widget',
            __( 'Social Links Widget', 'kmzsociallinks' ),
            array( 'description' => __( 'Outputs social icons linked to profiles' ) )

        );
    }

    /**
     * Outputs the content of the widget
     */
    public function widget( $args, $instance ){
        echo 'TEST FRONTEND';
    }

    /**
     * Outputs the options form on admin
     */
    public function form( $instance ){
        echo 'TEST BACKEND FORM';
    }

    /**
     * Processing widget options on save
     */
    public function update($new_instance, $old_instance){

    }
}