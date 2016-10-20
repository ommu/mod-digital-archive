<?php
/**
 * Digital Settings (digital-setting)
 * @var $this SettingController
 * @var $model DigitalSetting
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
			'name'=>'license',
			'value'=>$model->license,
			//'value'=>$model->license != '' ? $model->license : '-',
		),
		array(
			'name'=>'permission',
			'value'=>$model->permission,
			//'value'=>$model->permission != '' ? $model->permission : '-',
		),
		array(
			'name'=>'meta_keyword',
			'value'=>$model->meta_keyword != '' ? $model->meta_keyword : '-',
			//'value'=>$model->meta_keyword != '' ? CHtml::link($model->meta_keyword, Yii::app()->request->baseUrl.'/public/visit/'.$model->meta_keyword, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'meta_description',
			'value'=>$model->meta_description != '' ? $model->meta_description : '-',
			//'value'=>$model->meta_description != '' ? CHtml::link($model->meta_description, Yii::app()->request->baseUrl.'/public/visit/'.$model->meta_description, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'cover_limit',
			'value'=>$model->cover_limit,
			//'value'=>$model->cover_limit != '' ? $model->cover_limit : '-',
		),
		array(
			'name'=>'cover_resize',
			'value'=>$model->cover_resize,
			//'value'=>$model->cover_resize != '' ? $model->cover_resize : '-',
		),
		array(
			'name'=>'cover_resize_size',
			'value'=>$model->cover_resize_size != '' ? $model->cover_resize_size : '-',
			//'value'=>$model->cover_resize_size != '' ? CHtml::link($model->cover_resize_size, Yii::app()->request->baseUrl.'/public/visit/'.$model->cover_resize_size, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'cover_view_size',
			'value'=>$model->cover_view_size != '' ? $model->cover_view_size : '-',
			//'value'=>$model->cover_view_size != '' ? CHtml::link($model->cover_view_size, Yii::app()->request->baseUrl.'/public/visit/'.$model->cover_view_size, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'modified_date',
			'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
		),
		array(
			'name'=>'modified_id',
			'value'=>$model->modified_id,
			//'value'=>$model->modified_id != 0 ? $model->modified_id : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
