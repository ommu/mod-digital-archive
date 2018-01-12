<?php
/**
 * Digital History Prints (digital-history-print)
 * @var $this HistoryprintController
 * @var $model DigitalHistoryPrint
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital History Prints'=>array('manage'),
		$model->id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.libraries.core.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'id',
			'value'=>$model->id,
			//'value'=>$model->id != '' ? $model->id : '-',
		),
		array(
			'name'=>'digital_id',
			'value'=>$model->digital_id,
			//'value'=>$model->digital_id != '' ? $model->digital_id : '-',
		),
		array(
			'name'=>'print_price',
			'value'=>$model->print_price,
			//'value'=>$model->print_price != '' ? $model->print_price : '-',
		),
		array(
			'name'=>'print_request_date',
			'value'=>!in_array($model->print_request_date, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($model->print_request_date) : '-',
		),
		array(
			'name'=>'print_date',
			'value'=>!in_array($model->print_date, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($model->print_date) : '-',
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
