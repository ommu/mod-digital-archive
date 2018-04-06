<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */
?>

<ul>
<?php foreach($covers as $key => $val) {
	if($val->cover_filename != '') {?>
	<li>
		<a href="<?php echo Yii::app()->controller->createUrl('media/cover', array('id'=>$val->cover_id,'abc'=>$val->md5coverpath));?>" title="<?php echo $val->cover_filename?>"><?php echo $val->cover_filename?></a> (<?php echo $val->publish == 1 ? Yii::t('phrase', 'Publish') : Yii::t('phrase', 'Unpublish') ?>) <?php echo $val->status == 1 ? '('.Yii::t('phrase', 'Cover').')' : '' ?>
	</li>
<?php }
}?>
</ul>