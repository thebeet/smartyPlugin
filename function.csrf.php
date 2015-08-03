<?php
/**
 * Smarty plugin
 *
 */
function smarty_function_csrf($params, $template) {
    return htmlspecialchars(Yii::app()->request->getCsrfToken(), ENT_QUOTES);
}



