<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<li>
	<?php if($data->status == 0) {?>
		<a id="set-cover" href="<?php echo Yii::app()->controller->createUrl('o/cover/setcover', array('id'=>$data->cover_id,'hook'=>'admin'));?>" title="<?php echo Yii::t('phrase', 'Set Cover');?>"><?php echo Yii::t('phrase', 'Set Cover');?></a>
	<?php }?>
	<a id="set-delete" href="<?php echo Yii::app()->controller->createUrl('o/cover/delete', array('id'=>$data->cover_id,'hook'=>'admin'));?>" title="<?php echo Yii::t('phrase', 'Delete Photo');?>"><?php echo Yii::t('phrase', 'Delete Photo');?></a>
	<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/digital/'.$data->digital->view->uniquepath.'/'.$data->cover_filename, 320, 250, 1);?>" alt="<?php echo $data->digital->digital_title;?>" />
</li>