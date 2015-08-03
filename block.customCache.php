
<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.customCache.php
 * Type:     block
 * Name:     customCache
 * Purpose:  使用Yii框架的缓存来缓存指定区域
 * -------------------------------------------------------------
 */
function smarty_block_customCache($params, $content, Smarty_Internal_Template $template, &$repeat)
{
    if ($repeat) {
        if (YII_DEBUG) {
            return;
        }
        $content = Yii::app()->cache->get($params['id']);
        if ($content) {
            $repeat = false;
            return $content;
        }
    } else {
        $expire = intval($params['expire']);
        if ($expire <= 0) {
            $expire = 60;
        }
        Yii::app()->cache->set($params['id'], $content, $expire);
        return $content;
    }
}
