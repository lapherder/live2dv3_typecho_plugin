<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 支持 Live2D v3版本模型的插件，是融合了 <a href="https://github.com/Dreamer-Paul/Pio">@Dreamer-Paul</a> 和 <a href="https://github.com/HCLonely/Live2dV3">@HCLonely</a> 项目的产物
 *
 * @package live2dv3
 * @author lapherder
 * @version 0.1
 */

class live2dv3_Plugin implements Typecho_Plugin_Interface{

    /* 激活插件方法 */
    public static function activate(){
        Typecho_Plugin::factory('Widget_Archive') -> header = array('live2dv3_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive') -> footer = array('live2dv3_Plugin', 'footer');
    }

    /* 禁用插件方法 */
    public static function deactivate(){}

    /* 插件配置方法 */
    public static function config(Typecho_Widget_Helper_Form $form){

        // 读取模型文件夹
        $models = array();
        $load = glob("../usr/plugins/live2dv3/models/*");

        foreach($load as $key => $value){
            $single = substr($value, 31);
            $models[$single] = $single;
        };

        // 选择模型
        $choose_models = new Typecho_Widget_Helper_Form_Element_Radio('choose_models', $models, 'lar', _t('选择模型'), _t('选择插件 Models 目录下的模型，每个模型为一个文件夹，并确定配置文件名为 <a>name.model3.json</a>'));
        $form -> addInput($choose_models);

        // 自定义定位
        $position = new Typecho_Widget_Helper_Form_Element_Radio('position',
            array(
              'left' => _t('靠左'),
              'right' => _t('靠右'),
            ),
            'left', _t('自定义位置'), _t('自定义看板娘所在的位置'));
        $form -> addInput($position);

        // 自定义宽高
        $custom_width = new Typecho_Widget_Helper_Form_Element_Text('custom_width', NULL, NULL, _t('自定义宽度'), _t('在这里填入自定义宽度，部分模型需要修改'));
        $form -> addInput($custom_width);

        $custom_height = new Typecho_Widget_Helper_Form_Element_Text('custom_height', NULL, NULL, _t('自定义高度'), _t('在这里填入自定义高度，部分模型需要修改'));
        $form -> addInput($custom_height);

        // 移动设备隐藏看板娘
        $hidden = new Typecho_Widget_Helper_Form_Element_Radio('hidden',
            array(
              '0' => _t('关闭'),
              '1' => _t('开启'),
            ),
            '0', _t('移动设备隐藏看板娘'), _t('开启后将在移动设备上隐藏看板娘'));
        $form -> addInput($hidden);

    }

    /* 个人用户的配置方法 */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /* 插件实现方法 */
    public static function header(){
		echo '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"> </script>';
		echo '<script src="https://cdn.jsdelivr.net/npm/howler@2.1.3/dist/howler.min.js"></script>';
		echo '<script src="https://cubism.live2d.com/sdk-web/cubismcore/live2dcubismcore.min.js"></script>';
		echo '<script src="https://cdn.jsdelivr.net/npm/pixi.js@4.6.1/dist/pixi.min.js"></script>';
		echo '<script src="' . Helper::options() -> pluginUrl . '/live2dv3/js/live2dv3.js"></script>';
    }
	
    public static function footer(){
		$set_height = Typecho_Widget::widget('Widget_Options') -> Plugin('live2dv3') -> custom_height;
        $set_width  = Typecho_Widget::widget('Widget_Options') -> Plugin('live2dv3') -> custom_width;
		
		$basePath = Helper::options() -> pluginUrl;
		$modelName = Typecho_Widget::widget('Widget_Options') -> Plugin('live2dv3') -> choose_models;
		if(!$modelName)$modelName='lar debug';
		$width = !$set_width ? 300 : $set_width;
		$height = !$set_height ? 300: $set_height;
		$mobileLimit = Typecho_Widget::widget('Widget_Options') -> Plugin('live2dv3') -> hidden;
		
		echo '<div class="Canvas" style="position: fixed; ' . Typecho_Widget::widget('Widget_Options') -> Plugin('live2dv3') -> position . ': 0px; bottom: 0px;z-index: 99999999" id="L2dCanvas"></div>';


		echo str_replace(array("{basePath}", "{modelName}","{width}","{height}","{mobileLimit}"), array($basePath, $modelName,$width,$height,$mobileLimit),
"<script>
window.onload = () => {
	new l2dViewer({
	el: document.getElementById('L2dCanvas'),
	basePath:'{basePath}/live2dv3/models/',
	modelName:'{modelName}',
	width:{width},
	height:{height},
	sizeLimit: false,
	mobileLimit:{mobileLimit},
	sounds: false,
})
}
</script>"
        );
    } 
}