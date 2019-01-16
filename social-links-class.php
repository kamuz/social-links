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
        $title = esc_attr($instance['title']);
        $links = array(
            'facebook' => esc_attr($instance['facebook_link']),
            'twitter' => esc_attr($instance['twitter_link']),
            'linkedin' => esc_attr($instance['linkedin_link']),
        );
        $icons = array(
            'facebook' => esc_attr($instance['facebook_icon']),
            'twitter' => esc_attr($instance['twitter_icon']),
            'linkedin' => esc_attr($instance['linkedin_icon']),
        );
        $icon_width = esc_attr($instance['icon_width']);

        echo $args['before_widget'];

        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $this->getSocialLinks($links, $icons, $icon_width);

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     */
    public function form( $instance ){

        // Set title
        if(isset($instance['title'])){
            $title = $instance['title'];
        } else{
            $title = 'Social Links';
        }

        // Get Links
        if(isset($instance['facebook_link'])){
            $facebook_link = $instance['facebook_link'];
        } else{
            $facebook_link = 'https://facebook.com';
        }
        if(isset($instance['twitter_link'])){
            $twitter_link = $instance['twitter_link'];
        } else{
            $twitter_link = 'https://twitter.com';
        }
        if(isset($instance['linkedin_link'])){
            $linkedin_link = $instance['linkedin_link'];
        } else{
            $linkedin_link = 'https://linkedin.com';
        }

        // Get Icons
        if(isset($instance['facebook_icon'])){
            $facebook_icon = esc_attr($instance['facebook_icon']);
        } else{
            $facebook_icon = plugin_dir_url(__FILE__) . 'img/facebook.png';
        }
        if(isset($instance['twitter_icon'])){
            $twitter_icon = esc_attr($instance['twitter_icon']);
        } else{
            $twitter_icon = plugin_dir_url(__FILE__) . 'img/twitter.png';
        }
        if(isset($instance['linkedin_icon'])){
            $linkedin_icon = esc_attr($instance['linkedin_icon']);
        } else{
            $linkedin_icon = plugin_dir_url(__FILE__) . 'img/linkedin.png';
        }

        // Get Icon site
        if(isset($instance['icon_width'])){
            $icon_width = esc_attr($instance['icon_width']);
        } else{
            $icon_width = 32;
        }
        ?>
        <h4>Widget Title</h4>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php echo _e('Title:') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <h4>Facebook</h4>
        <p>
            <label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Link:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" value="<?php echo esc_attr($facebook_link) ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook_icon'); ?>"><?php _e('Icon:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('facebook_icon'); ?>" name="<?php echo $this->get_field_name('facebook_icon'); ?>" value="<?php echo esc_attr($facebook_icon) ?>">
        </p>
        <h4>Twitter</h4>
        <p>
            <label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e(' Link:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" value="<?php echo esc_attr($twitter_link) ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter_icon'); ?>"><?php _e(' Icon:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('twitter_icon'); ?>" name="<?php echo $this->get_field_name('twitter_icon'); ?>" value="<?php echo esc_attr($twitter_icon) ?>">
        </p>
        <h4>LinkedIn</h4>
        <p>
            <label for="<?php echo $this->get_field_id('linkedin_link'); ?>"><?php _e('Link:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" value="<?php echo esc_attr($linkedin_link) ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('linkedin_icon'); ?>"><?php _e('Icon:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('linkedin_icon'); ?>" name="<?php echo $this->get_field_name('linkedin_icon'); ?>" value="<?php echo esc_attr($linkedin_icon) ?>">
        </p>
        <h4>Sizes</h4>
        <p>
            <label for="<?php echo $this->get_field_id('icon_width'); ?>"><?php _e('Width:', 'kmzsociallinks') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('icon_width'); ?>" name="<?php echo $this->get_field_name('icon_width'); ?>" value="<?php echo esc_attr($icon_width) ?>">
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     */
    public function update($new_instance, $old_instance){
        $instance = array(
            'title' => (!empty($new_instance['title']) ? strip_tags($new_instance['title']) : ''),
            'facebook_link' => (!empty($new_instance['facebook_link']) ? strip_tags($new_instance['facebook_link']) : ''),
            'twitter_link' => (!empty($new_instance['twitter_link']) ? strip_tags($new_instance['twitter_link']) : ''),
            'linkedin_link' => (!empty($new_instance['linkedin_link']) ? strip_tags($new_instance['linkedin_link']) : ''),
            'facebook_icon' => (!empty($new_instance['facebook_icon']) ? strip_tags($new_instance['facebook_icon']) : ''),
            'twitter_icon' => (!empty($new_instance['twitter_icon']) ? strip_tags($new_instance['twitter_icon']) : ''),
            'linkedin_icon' => (!empty($new_instance['linkedin_icon']) ? strip_tags($new_instance['linkedin_icon']) : ''),
            'icon_width' => (!empty($new_instance['icon_width']) ? strip_tags($new_instance['icon_width']) : '')
        );

        return $instance;
    }

    public function getSocialLinks($links, $icons, $icon_width){
        ?>
        <div class="social-links">
            <a href="<?php echo esc_attr($links['facebook']) ?>" target="_blank"><img width="<?php echo esc_attr($icon_width) ?>" src="<?php echo esc_attr($icons['facebook']) ?>" alt="facebook"></a>
            <a href="<?php echo esc_attr($links['twitter']) ?>" target="_blank"><img width="<?php echo esc_attr($icon_width) ?>" src="<?php echo esc_attr($icons['twitter']) ?>" alt="twitter"></a>
            <a href="<?php echo esc_attr($links['linkedin']) ?>" target="_blank"><img width="<?php echo esc_attr($icon_width) ?>" src="<?php echo esc_attr($icons['linkedin']) ?>" alt="linkedin"></a>
        </div>
        <?php
    }
}