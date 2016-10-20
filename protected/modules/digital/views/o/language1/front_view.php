<?php
/**
 * Digital Languages (digital-language)
 * @var $this LanguageController
 * @var $model DigitalLanguage
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
		'Digital Languages'=>array('manage'),
		$model->language_id,
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
			'name'=>'language_id',
			'value'=>$model->language_id,
			//'value'=>$model->language_id != '' ? $model->language_id : '-',
		),
		array(
			'name'=>'language_name',
			'value'=>$model->language_name,
			//'value'=>$model->language_name != '' ? $model->language_name : '-',
		),
		array(
			'name'=>'language_desc',
			'value'=>$model->language_desc != '' ? $model->language_desc : '-',
			//'value'=>$model->language_desc != '' ? CHtml::link($model->language_desc, Yii::app()->request->baseUrl.'/public/visit/'.$model->language_desc, array('target' => '_blank')) : '-',
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
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
