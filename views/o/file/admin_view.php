<?php
/**
 * Digital Files (digital-file)
 * @var $this FileController
 * @var $model DigitalFile
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital Files'=>array('manage'),
		$model->file_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'file_id',
				'value'=>$model->file_id,
			),
			array(
				'name'=>'publish',
				'value'=>$model->publish == 1 ? CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'digital_id',
				'value'=>$model->digital->digital_title,
			),
			array(
				'name'=>'digital_filename',
				//'value'=>$model->digital_filename != '' ? CHtml::link($model->digital_filename, Yii::app()->request->baseUrl.'/public/digital/'.$model->digital->view->uniquepath.'/'.$model->digital_filename) : '-',
				'value'=>$model->digital_filename != '' ? CHtml::link($model->digital_filename, Yii::app()->controller->createUrl('media/file', array('id'=>$model->file_id,'abc'=>$model->md5filepath))) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'downloads',
				'value'=>$model->view->downloads != null ? CHtml::link($model->view->downloads, Yii::app()->controller->createUrl('o/download/manage', array('file'=>$model->file_id))) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'creation_date',
				'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
			),
			array(
				'name'=>'creation_id',
				'value'=>$model->creation_id != 0 ? $model->creation->displayname : '-',
			),
			array(
				'name'=>'modified_date',
				'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
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
