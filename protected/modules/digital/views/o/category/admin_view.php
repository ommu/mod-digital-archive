<?php
/**
 * Digital Categories (digital-category)
 * @var $this CategoryController
 * @var $model DigitalCategory
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Categories'=>array('manage'),
		$model->cat_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'cat_id',
				'value'=>$model->cat_id,
				//'value'=>$model->cat_id != '' ? $model->cat_id : '-',
			),
			array(
				'name'=>'publish',
				'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				//'value'=>$model->publish,
			),
			array(
				'name'=>'cat_title',
				'value'=>$model->cat_title,
				//'value'=>$model->cat_title != '' ? $model->cat_title : '-',
			),
			array(
				'name'=>'cat_desc',
				'value'=>$model->cat_desc != '' ? $model->cat_desc : '-',
				//'value'=>$model->cat_desc != '' ? CHtml::link($model->cat_desc, Yii::app()->request->baseUrl.'/public/visit/'.$model->cat_desc, array('target' => '_blank')) : '-',
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
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
