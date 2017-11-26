<?php
/**
 * Digital Publishers (digital-publisher)
 * @var $this PublisherController
 * @var $model DigitalPublisher
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Publishers'=>array('manage'),
		$model->publisher_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.libraries.core.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'publisher_id',
				'value'=>$model->publisher_id,
				//'value'=>$model->publisher_id != '' ? $model->publisher_id : '-',
			),
			array(
				'name'=>'publish',
				'value'=>$model->publish == '1' ? CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'publisher_name',
				'value'=>$model->publisher_name != '' ? $model->publisher_name : '-',
			),
			array(
				'name'=>'publisher_location',
				'value'=>$model->publisher_location != '' ? $model->publisher_location : '-',
			),
			array(
				'name'=>'publisher_address',
				'value'=>$model->publisher_address != '' ? $model->publisher_address : '-',
			),
			array(
				'name'=>'digitals',
				'value'=>$model->view->digitals != null || $model->view->digitals != 0 ? CHtml::link($model->view->digitals, Yii::app()->controller->createUrl('o/admin/manage',array('publisher'=>$model->publisher_id))) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'creation_date',
				'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
			),
			array(
				'name'=>'creation_id',
				'value'=>$model->creation_id != 0 ? $model->creation->displayname : '-',
			),
			array(
				'name'=>'modified_date',
				'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
			),
			array(
				'name'=>'modified_id',
				'value'=>$model->modified_id != 0 ? $model->modified->displayname : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
