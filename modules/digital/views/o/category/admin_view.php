<?php
/**
 * Digital Categories (digital-category)
 * @var $this CategoryController
 * @var $model DigitalCategory
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/mod-digital-archive
 * @contact (+62)856-299-4114
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
				'value'=>$model->publish == 1 ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
				'type'=>'raw',
			),
			array(
				'name'=>'cat_title',
				'value'=>$model->cat_title != '' ? $model->cat_title : '-',
			),
			array(
				'name'=>'cat_desc',
				'value'=>$model->cat_desc != '' ? $model->cat_desc : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'cat_code',
				'value'=>$model->cat_code != '' ? $model->cat_code : '-',
			),
			array(
				'name'=>'cat_icon',
				'value'=>$model->cat_icon != '' ? $model->cat_icon : '-',
			),
			array(
				'name'=>'cat_icon_image',
				'value'=>$model->cat_icon_image != '' ? CHtml::link(Chtml::image(Yii::app()->request->baseUrl.'/public/digital/'.$model->cat_icon_image), '') : '-',
			),
			array(
				'name'=>'cat_cover',
				'value'=>$model->cat_cover != '' ? CHtml::link(Chtml::image(Yii::app()->request->baseUrl.'/public/digital/'.$model->cat_cover), '') : '-',
			),
			array(
				'name'=>'cat_file_type',
				'value'=>$model->cat_file_type != '' ? Utility::formatFileType(unserialize($model->cat_file_type), false) : '-',
			),
			array(
				'name'=>'tags',
				'value'=>$model->tags != null ? $this->renderPartial('_view_tags', array('tags'=>$model->tags), true, false) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'digitals',
				'value'=>$model->view->digitals != null || $model->view->digitals != 0 ? CHtml::link($model->view->digitals, Yii::app()->controller->createUrl('o/admin/manage',array('category'=>$model->cat_id))) : '-',
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
