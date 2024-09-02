<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function create_breadcrumb() {
    $ci =& get_instance();
    $i=1;
    $uri = $ci->uri->segment($i);
    $link = '<ol class="breadcrumb">';
    $link .= '<li class="breadcrumb-item"><a href="'.base_url().'">Dashboard</a></li>';

    while($uri != '') {
        $prep_link = '';
        for($j=1; $j<=$i;$j++) {
            $prep_link .= $ci->uri->segment($j).'/';
        }

        if($ci->uri->segment($i+1) == '') {
            $link .= '<li class="breadcrumb-item active" aria-current="page">'.$ci->uri->segment($i).'</li>';
        } else {
            $link .= '<li class="breadcrumb-item"><a href="'.site_url($prep_link).'">'.$ci->uri->segment($i).'</a></li>';
        }
		
        $i++;
        $uri = $ci->uri->segment($i);
    }
    $link .= '</ol>';
    return $link;
}
