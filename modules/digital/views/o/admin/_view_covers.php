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
<?php foreach($covers as $key => $val) {?>
	<li>
		<a href="<?php echo Yii::app()->controller->createUrl('media/cover', array('id'=>$val->cover_id,'abc'=>$val->md5coverpath));?>" title="<?php echo $val->cover_filename?>"><?php echo $val->cover_filename?></a> (<?php echo $val->publish == 1 ? Yii::t('attribute', 'Publish') : Yii::t('attribute', 'Unpublish') ?>) <?php echo $val->status == 1 ? '('.Yii::t('attribute', 'Cover').')' : '' ?>
	</li>
<?php }?>
</ul>