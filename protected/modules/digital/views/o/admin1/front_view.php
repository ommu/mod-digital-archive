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

	$this->breadcrumbs=array(
		'Digitals'=>array('manage'),
		$model->digital_id,
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
			'name'=>'digital_id',
			'value'=>$model->digital_id,
			//'value'=>$model->digital_id != '' ? $model->digital_id : '-',
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->publish,
		),
		array(
			'name'=>'cat_id',
			'value'=>$model->cat_id,
			//'value'=>$model->cat_id != '' ? $model->cat_id : '-',
		),
		array(
			'name'=>'publisher_id',
			'value'=>$model->publisher_id,
			//'value'=>$model->publisher_id != '' ? $model->publisher_id : '-',
		),
		array(
			'name'=>'language_id',
			'value'=>$model->language_id,
			//'value'=>$model->language_id != '' ? $model->language_id : '-',
		),
		array(
			'name'=>'opac_id',
			'value'=>$model->opac_id,
			//'value'=>$model->opac_id != '' ? $model->opac_id : '-',
		),
		array(
			'name'=>'digital_code',
			'value'=>$model->digital_code,
			//'value'=>$model->digital_code != '' ? $model->digital_code : '-',
		),
		array(
			'name'=>'digital_title',
			'value'=>$model->digital_title != '' ? $model->digital_title : '-',
			//'value'=>$model->digital_title != '' ? CHtml::link($model->digital_title, Yii::app()->request->baseUrl.'/public/visit/'.$model->digital_title, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'digital_intro',
			'value'=>$model->digital_intro != '' ? $model->digital_intro : '-',
			//'value'=>$model->digital_intro != '' ? CHtml::link($model->digital_intro, Yii::app()->request->baseUrl.'/public/visit/'.$model->digital_intro, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'digital_cover',
			'value'=>$model->digital_cover != '' ? $model->digital_cover : '-',
			//'value'=>$model->digital_cover != '' ? CHtml::link($model->digital_cover, Yii::app()->request->baseUrl.'/public/visit/'.$model->digital_cover, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'publish_year',
			'value'=>$model->publish_year,
			//'value'=>$model->publish_year != '' ? $model->publish_year : '-',
		),
		array(
			'name'=>'publish_location',
			'value'=>$model->publish_location != '' ? $model->publish_location : '-',
			//'value'=>$model->publish_location != '' ? CHtml::link($model->publish_location, Yii::app()->request->baseUrl.'/public/visit/'.$model->publish_location, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'isbn',
			'value'=>$model->isbn,
			//'value'=>$model->isbn != '' ? $model->isbn : '-',
		),
		array(
			'name'=>'subjects',
			'value'=>$model->subjects != '' ? $model->subjects : '-',
			//'value'=>$model->subjects != '' ? CHtml::link($model->subjects, Yii::app()->request->baseUrl.'/public/visit/'.$model->subjects, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'pages',
			'value'=>$model->pages,
			//'value'=>$model->pages != '' ? $model->pages : '-',
		),
		array(
			'name'=>'series',
			'value'=>$model->series != '' ? $model->series : '-',
			//'value'=>$model->series != '' ? CHtml::link($model->series, Yii::app()->request->baseUrl.'/public/visit/'.$model->series, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'creation_date',
			'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
		),
		array(
			'name'=>'creation_id',
			'value'=>$model->creation_id,
			//'value'=>$model->creation_id != 0 ? $model->creation_id : '-',
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
