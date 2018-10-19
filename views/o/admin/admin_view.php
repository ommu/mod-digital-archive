<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digitals'=>array('manage'),
		$model->digital_id,
	);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'digital_id',
			'value'=>$model->digital_id,
		),
		array(
			'name'=>'publish',
			'value'=>$this->quickAction(Yii::app()->controller->createUrl('publish', array('id'=>$model->digital_id)), $model->publish),
			'type'=>'raw',
		),
		array(
			'name'=>'content_verified',
			'value'=>$model->content_verified == 1 ? CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			'type'=>'raw',
		),
		array(
			'name'=>'cat_id',
			'value'=>$model->cat_id != null ? CHtml::link($model->category->cat_title, Yii::app()->controller->createUrl('o/admin/manage', array('category'=>$model->cat_id))) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'digital_code',
			'value'=>$model->digital_code != '' ? $model->digital_code : '-',
		),
		array(
			'name'=>'digital_title',
			'value'=>$model->digital_title != '' ? $model->digital_title : '-',
		),
		array(
			'name'=>'digital_intro',
			'value'=>$model->digital_intro != '' ? $model->digital_intro : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'publisher_id',
			'value'=>$model->publisher_id != null ? $model->publisher->publisher_name : '-',
		),
		array(
			'name'=>'publish_year',
			'value'=>$model->publish_year,
			'value'=>!in_array($model->publish_year, array('0000','1970')) ? $model->publish_year : '-',
		),
		array(
			'name'=>'publish_location',
			'value'=>$model->publish_location != '' ? $model->publish_location : '-',
		),
		array(
			'name'=>'language_id',
			'value'=>$model->language_id != null ? $model->language->language_name : '-',
		),
		array(
			'name'=>'authors',
			'value'=>$model->authors != null ? $this->renderPartial('_view_authors', array('authors'=>$model->authors), true, false) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'covers',
			'value'=>$model->covers != null ? $this->renderPartial('_view_covers', array('covers'=>$model->covers), true, false) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'files',
			'value'=>$model->files != null ? $this->renderPartial('_view_files', array('files'=>$model->files), true, false) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'subjects',
			'value'=>$model->subjects != null ? $this->renderPartial('_view_subjects', array('subjects'=>$model->subjects), true, false) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'tags',
			'value'=>$model->tags != null ? $this->renderPartial('_view_tags', array('tags'=>$model->tags), true, false) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'isbn',
			'value'=>$model->isbn != '' ? $model->isbn : '-',
		),
		array(
			'name'=>'pages',
			'value'=>$model->pages != '' ? $model->pages : '-',
		),
		array(
			'name'=>'series',
			'value'=>$model->series != '' ? $model->series : '-',
		),
		array(
			'name'=>'opac_id',
			'value'=>$model->opac_id != 0 ? $model->opac_id : '-',
		),
		array(
			'name'=>'choices',
			'value'=>$model->choices != null ? CHtml::link($model->view->choices, Yii::app()->controller->createUrl('o/choice/manage', array('digital'=>$model->digital_id))) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'views',
			'value'=>$model->views != null ? CHtml::link($model->view->views, Yii::app()->controller->createUrl('o/views/manage', array('digital'=>$model->digital_id))) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'likes',
			'value'=>$model->likes != null ? CHtml::link($model->view->likes, Yii::app()->controller->createUrl('o/likes/manage', array('digital'=>$model->digital_id))) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'downloads',
			'value'=>$model->view->downloads != null ? $model->view->downloads : '-',
		),
		array(
			'name'=>'digital_path',
			'value'=>$model->digital_path != '' ? $model->digital_path : '-',
		),
		array(
			'name'=>'salt',
			'value'=>$model->salt != '' ? $model->salt : '-',
		),
		array(
			'name'=>'creation_date',
			'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')) ? $this->dateFormat($model->creation_date) : '-',
		),
		array(
			'name'=>'creation_search',
			'value'=>$model->creation_id != 0 ? $model->creation->displayname : '-',
		),
		array(
			'name'=>'modified_date',
			'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')) ? $this->dateFormat($model->modified_date) : '-',
		),
		array(
			'name'=>'modified_search',
			'value'=>$model->modified_id != 0 ? $model->modified->displayname : '-',
		),
	),
)); ?>