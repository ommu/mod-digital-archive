<?php
/**
 * Digital Like Details (digital-like-detail)
 * @var $this LikedetailController
 * @var $model DigitalLikeDetail
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (ommu.co)
 * @created date 7 February 2017, 02:35 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Like Details'=>array('manage'),
		$model->id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'id',
			'value'=>$model->id,
			//'value'=>$model->id != '' ? $model->id : '-',
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->publish,
		),
		array(
			'name'=>'like_id',
			'value'=>$model->like_id,
			//'value'=>$model->like_id != '' ? $model->like_id : '-',
		),
		array(
			'name'=>'likes_date',
			'value'=>!in_array($model->likes_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->likes_date, true) : '-',
		),
		array(
			'name'=>'likes_ip',
			'value'=>$model->likes_ip,
			//'value'=>$model->likes_ip != '' ? $model->likes_ip : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
