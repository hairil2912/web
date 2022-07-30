<?php 

if (!function_exists('stack')) {
    /*
    * @param string | js, css
    */
    function stack($type)
    {
        $ci = &get_instance();
        $html = '';
        if ($type == 'css') {
            if (!empty($ci->config->item('css'))) {
                if (is_array($ci->config->item('css'))) {
                    foreach ($ci->config->item('css') as $css) {
                        $html .= '<link rel="stylesheet" href="' . base_url($css) . '"/>';
                    }
                } else {
                    $html = '<link rel="stylesheet" href="' . base_url($ci->config->item('css')) . '"/>';
                }
            }
        } else if ($type == 'js') {
            if (!empty($ci->config->item('js'))) {
                if (is_array($ci->config->item('js'))) {
                    foreach ($ci->config->item('js') as $js) {
                        $html .= '<script src="' . base_url($js) . '"></script>';
                    }
                } else {
                    $html = '<script src="' . base_url($ci->config->item('js')) . '"></script>';
                }
            }
        }

        return $html;
    }
}

if (!function_exists('fix_date')) {
    function fix_date($date = null)
    {
        if ($data = null) {
            return null;
        }

        $date = str_replace('/', '-', $date);
        return date('Y-m-d', strtotime($date));
    }
}


?>