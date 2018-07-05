<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */
?>

<li id="upload" <?php echo $setting->cover_limit != 0 && count($covers) == $setting->cover_limit ? 'class="hide"' : '' ?>>
	<a id="upload-gallery" href="<?php echo Yii::app()->controller->createUrl('o/admin/insertcover', array('id'=>$model->digital_id,'hook'=>'admin'));?>" title="<?php echo Yii::t('phrase', 'Upload Cover'); ?>"><?php echo Yii::t('phrase', 'Upload Cover'); ?></a>
	<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/digital/digital_default.png', 320, 250, 1);?>" alt="" />
</li>