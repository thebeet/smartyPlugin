<?php
/**
 * Smarty plugin
 *
 */

/**
 * Smarty less compiler plugin
 * Type:     compiler<br>
 * Name:     less<br>
 * Example:  {less file="static/less/index.css"}
 * @return less with md5-version code
 */

function smarty_compiler_less($params, Smarty $smarty) {
    if ($params['debug'] && YII_DEBUG===false) {
        return false;
    }

    $module = $params['module'];
    $module = preg_replace('/"/', '', $module);

    $file = $params['file'];
    $file = preg_replace('/"/', '', $file);

    $fileMap = $smarty->staticFileMap($file, 'less', $module);

    $dupDetect = '<?php
    $_static_temp_file = \'' . $fileMap['realFile'] . '\';
    global $_static_map;
    if (!$_static_map) {
        $_static_map = array();
    }
    if (array_key_exists($_static_temp_file, $_static_map) === false) {
        $_static_map[$_static_temp_file] = true;
        echo \'' . $fileMap['html'] . '\'; 
    }
    ?>';
    return $dupDetect;
}



