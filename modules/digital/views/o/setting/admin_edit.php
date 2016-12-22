<?php
/**
 * Digital Settings (digital-setting)
 * @var $this SettingController
 * @var $model DigitalSetting
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Settings'=>array('manage'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);
	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('input[name="DigitalSetting[cover_resize]"]').live('change', function() {
		var id = $(this).val();
		if(id == '1') {
			$('div#resize_size').slideDown();
		} else {
			$('div#resize_size').slideUp();
		}
	});
	$('input[name="DigitalSetting[form_standard]"]').live('change', function() {
		var id = $(this).val();
		if(id == '1') {
			$('div#custom_field').slideUp();
		} else {
			$('div#custom_field').slideDown();
		}
	});
	$('input[name="DigitalSetting[editor_choice_status]"]').live('change', function() {
		var id = $(this).val();
		if(id == '1') {
			$('div#editor_choice').slideDown();
		} else {
			$('div#editor_choice').slideUp();
		}
	});
EOP;
	$cs->registerScript('resize', $js, CClientScript::POS_END);
?>

<div class="form" name="post-on">
	<?php echo $this->renderPartial('_form', array(
		'model'=>$model,
		'digital'=>$digital,
	)); ?>
</div>
