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

<?php if($data->cover_filename != '') {?>
<li>
	<?php if($data->status == 0) {?>
		<a id="set-cover" href="<?php echo Yii::app()->controller->createUrl('o/cover/setcover', array('id'=>$data->cover_id,'hook'=>'admin'));?>" title="<?php echo Yii::t('phrase', 'Set Cover');?>"><?php echo Yii::t('phrase', 'Set Cover');?></a>
	<?php }?>
	<a id="set-delete" href="<?php echo Yii::app()->controller->createUrl('o/cover/delete', array('id'=>$data->cover_id,'hook'=>'admin'));?>" title="<?php echo Yii::t('phrase', 'Delete Photo');?>"><?php echo Yii::t('phrase', 'Delete Photo');?></a>
	<?php 
	//$cover = Yii::app()->request->baseUrl.'/public/digital/'.$data->digital->view->uniquepath.'/'.$data->cover_filename;
	$cover = Yii::app()->controller->createUrl('media/cover', array('id'=>$data->cover_id,'abc'=>$data->md5coverpath));?>
	<img src="<?php echo Utility::getTimThumb($cover, 320, 250, 1);?>" alt="<?php echo $data->digital->digital_title;?>" />
</li>
<?php }?>