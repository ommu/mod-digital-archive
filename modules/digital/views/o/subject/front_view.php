<?php
/**
 * View Digital Subjects (view-digital-subject)
 * @var $this SubjectController
 * @var $model ViewDigitalSubject
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 3 November 2016, 16:42 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'View Digital Subjects'=>array('manage'),
		$model->tag_id,
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
			'name'=>'tag_id',
			'value'=>$model->tag_id,
			//'value'=>$model->tag_id != '' ? $model->tag_id : '-',
		),
		array(
			'name'=>'digitals',
			'value'=>$model->digitals,
			//'value'=>$model->digitals != '' ? $model->digitals : '-',
		),
		array(
			'name'=>'digital_publish',
			'value'=>$model->digital_publish,
			//'value'=>$model->digital_publish != '' ? $model->digital_publish : '-',
		),
		array(
			'name'=>'digital_unpublish',
			'value'=>$model->digital_unpublish,
			//'value'=>$model->digital_unpublish != '' ? $model->digital_unpublish : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
