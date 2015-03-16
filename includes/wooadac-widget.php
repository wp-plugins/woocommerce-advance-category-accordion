<?php
/**
 * category Accordion Widget
 *
 * @author 		aumsrini
 * @category 	Widgets
 * @package 	woocommerce-advance-accordion/inc
 * @version 	1.1
 * @extends 	WP_Widget
 */
ob_start();
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


class wc_category_accordion extends WP_Widget {

	var $settings = array('title','wooadac_count','exclude_tree','hide_empty','sortby','order','ac_speed','arrow_color','accordion_bg','font_color','border_size','border_color','expand_color','font_size');
	
	
	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */

    function wc_category_accordion() {
		
		/* Widget settings. */
		$widget_ops = array( 'description' => __('list WooCommerce product categories and subcategories into a toggle accordion.','wooadac'));
		
		parent::WP_Widget( false, __( 'Woo Category Accordion', 'wooadac'), $widget_ops );
			
     }
		
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
    function widget($args, $instance) {

		extract( $args, EXTR_SKIP );
		
		$instance = $this->woocommerce_category_accordion_defaults( $instance );
		
		extract( $instance, EXTR_SKIP );
		
		echo $before_widget;
		
		echo $before_title;
		
		if ($title) echo $title;
		
		echo $after_title;				
			
		global $wp_query;		
		
		global $post, $product;				

			
		$exclude_tree = esc_attr($exclude_tree );
				
		$hide_empty = esc_attr($hide_empty );
		
		$ac_speed = esc_attr($ac_speed );
		
		$arrow_color = esc_attr($arrow_color );
		
		$accordion_bg= esc_attr($accordion_bg );
		
		$font_color= esc_attr($font_color );
		
		$border_size= esc_attr($border_size );
		
		$border_color= esc_attr($border_color);
		
		$expand_color= esc_attr($expand_color);
		
		$font_size= esc_attr($font_size);
		
		$sortby = esc_attr($sortby ); 
		 
		$order = esc_attr($order );
		
		$depth = esc_attr($depth );
		
		$instance_categories = get_terms( 'product_cat', '&parent=0&exclude='.$exclude_tree.'');		
			
		if (is_array($instance_categories)) {

			foreach($instance_categories as $categories) {

				 $term_id[]= $categories->term_id;

				$term_name = $categories->name;
			}
		}

		if(!empty($post->ID))
		{
			$terms =get_the_terms( $post->ID, 'product_cat' );
		}
		else {
		
			$terms="";
		}
				
		
	
		if (is_array($terms )) {

			foreach ( $terms as $term) {

				$_cat=$term->term_id;

				break;

			}

		}

		
        /*For current category highlight*/ 
		$current_cat= array();
		
		$cat = $wp_query->get_queried_object();	
			 
		if (!empty($cat->term_id))

		{

			$current_cat = $cat->term_id;

		}
		

         else

         {                
             $_cat_id="1";

             if (isset($term->term_id))

                {
                   $_cat=$term->term_id;

                    if (!empty($_cat))

                    {
                        $_cat_id=$_cat;

                    }

                    else {
                        $_cat_id=1;
                    }



                }
				if (is_shop())

                {

                    $_cat_id="1";
                }
				if (!is_shop()){
					
					if (is_array($terms )) {					
				
				foreach($terms as $term)
 {
	  $myterms[]= $term->term_id; 
 }
?>
<script type="text/javascript">
 var cats_id=<?php  echo end($myterms); ?>
</script>
<style type="text/css">
<?php foreach((get_the_terms($post->ID, 'product_cat')) as $term) {
 $myterms= $term->term_id;
 echo 'ul#outer_ul li.cat-item-'.$myterms.' > a{font-weight:bold;}';
}
				}
		 }
?>
</style>
<?php             
}
?>
<div class="block-content">
  <ul id="outer_ul">
<?php $show_count=esc_attr( $wooadac_count );

            $subcat_args = array(

                               'taxonomy' => 'product_cat',
                               'title_li' => '',
							   'orderby' => $sortby,
							   'order'    => $order,
							   'depth' => $depth,
                               'show_count' => $show_count,
                               'hide_empty' => $hide_empty,
                               'echo' => false,
                               'exclude'  => $exclude_tree,
                               'show_option_none'   => __('No Categories Found','wooadac'),
                               'link_after' => '',
                           );
?>
<?php $subcategories = wp_list_categories( $subcat_args );

      $subcategories = str_replace('<ul', '<em id="parent"></em><ul', $subcategories);

      $subcategories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">(\\1)</span></a>', $subcategories);
?>
<?php if ( $subcategories ) {?>
<script type="text/javascript">
	 var ac_speed=<?php  echo $ac_speed; ?>
</script>
<?php echo $subcategories; ?>
<?php
            } 
?>
</ul>
</div>
<?php

        echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {

            $new_instance = $this->woocommerce_category_accordion_defaults( $new_instance );
			
			return $new_instance;

        }

        function woocommerce_category_accordion_defaults( $instance ) {

            $defaults = $this->wc_cat_accordion_get_settings();

           $instance = wp_parse_args( $instance, $defaults );
		
           if ( $instance['wooadac_count'] =="" ) {

              $instance['wooadac_count'] = $defaults['wooadac_count'];

            }

            if ( $instance['hide_empty'] =="" ) {

                $instance['hide_empty'] = $defaults['hide_empty'];

            }
			 if ( $instance['ac_speed'] =="" ) {

                $instance['ac_speed'] = $defaults['hide_empty'];

            }
			
			 if ( $instance['arrow_color'] =="" ) {

                $instance['arrow_color'] = $defaults['hide_empty'];

            }
			
			 if ( $instance['border_size'] =="" ) {

                $instance['border_size'] = $defaults['hide_empty'];

            }
			
						
				 if ( $instance['accordion_bg'] =="" ) {

                $instance['accordion_bg'] = $defaults['hide_empty'];

            }
			
			 if ( $instance['font_color'] =="" ) {

                $instance['font_color'] = $defaults['hide_empty'];

            }
			
			 if ( $instance['border_color'] =="" ) {

                $instance['border_color'] = $defaults['hide_empty'];

            }
			
			 if ( $instance['expand_color'] =="" ) {

                $instance['expand_color'] = $defaults['hide_empty'];

            }
				 if ( $instance['font_size'] =="" ) {

                $instance['font_size'] = $defaults['hide_empty'];

            }
			
			if ( $instance['sortby'] =="" ) {

                $instance['sortby'] = $defaults['sortby'];

            }
			if ( $instance['order'] =="" ) {

                $instance['order'] = $defaults['order'];

            }
			if ( $instance['depth'] =="" ) {

                $instance['depth'] = $defaults['depth'];

            }

            return $instance;

        }

        function wc_cat_accordion_get_settings() {



            // Set the default to a blank string

            $settings = array_fill_keys( $this->settings, '' );

            // Now set the more specific defaults

            $settings['title']  = "Categories";
			
           	$settings['wooadac_count']  = 0;
			
            $settings['exclude_tree']  = ""; 
			  
            $settings['hide_empty']  = 0;
			
			$settings['ac_speed']  = 300;
			
			$settings['arrow_color']  = "#000";
			
			$settings['accordion_bg']  = "#fff";
			
			$settings['font_color']  = "#000";
			
			$settings['border_size']  = "1";
			
			$settings['border_color']  = "#EEEEEE";
			
			$settings['expand_color']  = "#000000";
			
			$settings['font_size']  = "12";
			
			$settings['depth']= 0;
			
			$settings['sortby']  = "name";
			
			$settings['order']  = "ASC";			

            return $settings;
        }

        function form($instance) {

            $instance = $this->woocommerce_category_accordion_defaults( $instance );
			
            extract( $instance, EXTR_SKIP );
?>

  <label for ="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title: ','wooadac'); ?></label>
  <input type="text" class="widefat"id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if(isset($title)) echo esc_attr($title) ?>"/>
</p>
<p>
<input type="checkbox" name="<?php echo $this->get_field_name('wooadac_count'); ?>" <?php if (esc_attr( $wooadac_count )) {
                    echo 'checked="checked"';
                } ?> class=""  size="4"  id="<?php echo $this->get_field_id('wooadac_count'); ?>" />
<label for ="<?php echo $this->get_field_id('wooadac_count'); ?>"><?php _e('Enable Products Count','wooadac_count'); ?></label>
</p>
<p>
  <input type="checkbox" name="<?php echo $this->get_field_name('hide_empty'); ?>" <?php if (esc_attr( $hide_empty )) {
                echo 'checked="checked"';
            } ?> class=""  size="4"  id="<?php echo $this->get_field_id('hide_empty'); ?>" />
  <label for ="<?php echo $this->get_field_id('hide_empty'); ?>"><?php _e('Hide If Empty','wooadac'); ?></label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e('Sort by:','wooadac'); ?> 
        <select class='widefat' id="<?php echo $this->get_field_id('sortby'); ?>" name="<?php echo $this->get_field_name('sortby'); ?>">
          <option value='ID'<?php echo ($sortby=='ID')?'selected':''; ?>>ID</option>
          <option value='name'<?php echo ($sortby=='name')?'selected="selected"':''; ?>>Name</option> 
          <option value='slug'<?php echo ($sortby=='slug')?'selected="selected"':''; ?>>Slug</option> 
        </select>                
      </label>
</p>
<p>
      <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:','wooadac'); ?> 
        <select class='widefat' id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
          <option value='ASC'<?php echo ($order=='ASC')?'selected="selected"':''; ?>>Ascending</option>
          <option value='DESC'<?php echo ($order=='DESC')?'selected="selected"':''; ?>>Descending</option> 
        </select>                
      </label>
</p>
<p>
      <label for="<?php echo $this->get_field_id('depth'); ?>"><?php _e('Level:','wooadac'); ?> 
      <select class='widefat' id="<?php echo $this->get_field_id('depth'); ?>" name="<?php echo $this->get_field_name('depth'); ?>">
<?php for ($i=0; $i<=10; $i++) : ?>
       <option value="<?php echo $i; ?>" <?php echo ($i == $depth) ? "selected='selected'" : ""; ?>><?php echo $i; ?></option>
<?php endfor; ?>
       </select>               
      </label>
<small>0 -> show all levels</small>
</p>
<p>
  <label for ="<?php echo $this->get_field_id('exclude_tree'); ?>"><?php echo __('Exclude Category (ID): ','wooadac');
            ?></label>
  <input type="text" class="widefat"id="<?php echo $this->get_field_id('exclude_tree'); ?>" name="<?php echo $this->get_field_name('exclude_tree'); ?>" value="<?php if(isset($exclude_tree)) echo esc_attr($exclude_tree) ?>"/>
  <small>category IDs, separated by commas.</small>
</p>
<p>
  <label for ="<?php echo $this->get_field_id('ac_speed'); ?>"><?php echo __('Accodion Speed: ','wooadac'); ?></label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('ac_speed'); ?>" size="5" name="<?php echo $this->get_field_name('ac_speed'); ?>" value="<?php if(isset($ac_speed)) echo esc_attr($ac_speed) ?>"/>
 <small>Accordion speed(slideup / slidedown) in Milliseconds</small>
</p>
<p>
<label >Category List Arrow Color:</label>
  <input id="<?php echo $this->get_field_id('arrow_color'); ?>" class="color-picker" name="<?php echo $this->get_field_name('arrow_color'); ?>" type="text" value="<?php if(isset($arrow_color)) echo esc_attr($arrow_color) ?>" />
</p>

<p>
<label >Acoordion Bg Color:</label>
  <input id="<?php echo $this->get_field_id('accordion_bg'); ?>" class="color-picker" name="<?php echo $this->get_field_name('accordion_bg'); ?>" type="text" value="<?php if(isset($accordion_bg)) echo esc_attr($accordion_bg) ?>" />
</p>
<p>
<label >Font Color:</label>
  <input id="<?php echo $this->get_field_id('font_color'); ?>" class="color-picker" name="<?php echo $this->get_field_name('font_color'); ?>" type="text" value="<?php if(isset($font_color)) echo esc_attr($font_color) ?>" />
</p>
<p>
<label >Bottom Border Size:</label>
  <input id="<?php echo $this->get_field_id('border_size'); ?>"  name="<?php echo $this->get_field_name('border_size'); ?>" type="text" value="<?php if(isset($border_size)) echo esc_attr($border_size) ?>" />example:2
</p>
<p>
<label >Border Color:</label>
  <input id="<?php echo $this->get_field_id('border_color'); ?>" class="color-picker" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php if(isset($border_color)) echo esc_attr($border_color) ?>" />
</p>

<p>
<label >Expander Icon Color:</label>
  <input id="<?php echo $this->get_field_id('expand_color'); ?>" class="color-picker" name="<?php echo $this->get_field_name('expand_color'); ?>" type="text" value="<?php if(isset($expand_color)) echo esc_attr($expand_color) ?>" />
</p><p>
<label >Font Size:</label>
  <input id="<?php echo $this->get_field_id('font_size'); ?>"  name="<?php echo $this->get_field_name('font_size'); ?>" type="text" value="<?php if(isset($font_size)) echo esc_attr($font_size) ?>" />
</p>
<?php
}
 }

add_action('widgets_init', 'wc_category_accordion_fn');

    function wc_category_accordion_fn()

	{
        register_widget('wc_category_accordion');

    }

}
?>