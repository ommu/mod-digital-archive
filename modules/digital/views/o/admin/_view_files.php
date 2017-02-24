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

<ul>
<?php foreach($files as $key => $val) {?>
	<li>
		<a href="<?php echo Yii::app()->controller->createUrl('media/file', array('id'=>$val->file_id,'abc'=>$val->md5filepath));?>" title="<?php echo $val->digital_filename?>"><?php echo $val->digital_filename?></a> (<?php echo $val->publish == 1 ? Yii::t('phrase', 'Publish') : Yii::t('phrase', 'Unpublish') ?>)
	</li>
<?php }?>
</ul>