<?php

add_shortcode('_themename_slider', '_themename_slider');

function _themename_slider($atts = [], $content = null, $tag = '')
{

  extract(shortcode_atts([
    //attributes in our npm package (slickslider) that we want to control
    'autoplay' => false,
    'arrows' => false
  ], $atts, $tag));

  //using the example in the slickslider docs
  //boolval converts anything to a boolean. a way of excaping.
  $o = '<div class="_themename-slider" data-slick=\'{"autoplay":' . $autoplay . ', "arrows":' . $arrows . '}\'>';
  if(!is_null($content)) {
    $o .= do_shortcode($content);
  }
  $o .= '</div>';

  return $o;
  //shortcodes should always return a value, and variables should be escaped
  //do_shortcode allows outputting shortcodes inside shortcodes, always use it just incase
}



add_shortcode('_themename_slide','_themename_slide');

function _themename_slide($atts = [], $content = null, $tag = '')
{

  extract(shortcode_atts([
    //attributes in our npm package (slickslider) that we want to control
    'image' => null,
    'caption' => ''
  ], $atts, $tag));

  //using the example in the slickslider docs
  //boolval converts anything to a boolean. a way of excaping.
  $o = '<div class="_themename-slide">';
  if($image) {
    $o .= wp_get_attachment_image($image, 'large');
  }
  if($caption) {
    $o .= '<div class="_themename-slide-caption">' . esc_html($caption) . '</div>';
  }
  $o .= '</div>';

  return $o;
  //shortcodes should always return a value, and variables should be escaped
  //do_shortcode allows outputting shortcodes inside shortcodes, always use it just incase
}