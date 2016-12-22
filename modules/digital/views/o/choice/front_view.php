<?php
/**
 * Digital Choices (digital-choice)
 * @var $this ChoiceController
 * @var $model DigitalChoice
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 22 December 2016, 10:35 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Choices'=>array('manage'),
		$model->choice_id,
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
			'name'=>'choice_id',
			'value'=>$model->choice_id,
			//'value'=>$model->choice_id != '' ? $model->choice_id : '-',
		),
		array(
			'name'=>'digital_id',
			'value'=>$model->digital_id,
			//'value'=>$model->digital_id != '' ? $model->digital_id : '-',
		),
		array(
			'name'=>'user_id',
			'value'=>$model->user_id,
			//'value'=>$model->user_id != '' ? $model->user_id : '-',
		),
		array(
			'name'=>'choice_date',
			'value'=>!in_array($model->choice_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->choice_date, true) : '-',
		),
		array(
			'name'=>'choice_ip',
			'value'=>$model->choice_ip,
			//'value'=>$model->choice_ip != '' ? $model->choice_ip : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
