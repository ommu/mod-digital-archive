<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
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