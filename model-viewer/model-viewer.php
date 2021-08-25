<?php
/**
 * Plugin Name: Model Viewer
 * Plugin URI: https://papamaakthetwel.be
 * Description: Use modelviewer to show 3D objects on you website
 * Version: 1.0
 * Author: Peter Moers
 * Author URI: https://papamaakthetwel.be
 */

if (!function_exists('normalize_empty_atts')) {
    function normalize_empty_atts ($atts) {
        foreach ($atts as $attribute => $value) {
            if (is_int($attribute)) {
                $atts[strtolower($value)] = true;
                unset($atts[$attribute]);
            }
        }
        return $atts;
    }
}


function papa_model_viewer($atts) {

    static $papa_model_viewer_count=0;
    
    $atts = normalize_empty_atts($atts);
 
    $src = $atts['src'];
    $alt = $atts['alt']?$atts['alt']:"Model Viewer";
    

    //<!-- Import the component -->
    if($papa_model_viewer_count<=1) {
        $content = "<script type=\"module\" src=\"https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js\"></script>";
    } else {
        $content = "";
    }


    //Wrapper div for better dimensions control
    $content .= "<div style=\"";
    if($atts['width']) {
        $content .= "width:".$atts['width'].";";
    }
    if($atts['height']) {
        $content .= "height:".$atts['height'].";";
    }
    if($atts['aspect-ratio']) {
        $content .= "aspect-ratio:".$atts['aspect-ratio'].";";
    }
    if($atts['border']) {
        $content .= "border:".$atts['border'].";";
    }

    $content .= "\">";
    

    //<!-- Use it like any other HTML element -->
    $content .= "<model-viewer ";
    $content .= "src=\"".$src."\" ";
    $content .= "alt=\"".$alt."\" ";
    $content .= "ar ar-modes=\"webxr scene-viewer quick-look\" ";
    $content .= "environment-image=\"neutral\" ";
    $content .= "auto-rotate camera-controls ";
    if($atts['disable-zoom']) {
        $content .= "disable-zoom ";
    }

    if($atts['exposure']) {
        $content .= "exposure=\"".$atts['exposure']."\" ";
    }

    if($atts['shadow_intensity']) {
        $content .= "shadow-intensity=\"".$atts['shadow_intensity']."\" ";
    }

    $content .= "style=\"";
    $content .= "width:100%;";
    $content .= "height:100%;";
    $content .= "\"";
    $content .= "></model-viewer>";
    $content .= "</div>";
    $papa_model_viewer_count++;
	 
    return $content;
}

add_shortcode('model-viewer', 'papa_model_viewer');

?>
