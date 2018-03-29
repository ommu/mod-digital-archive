<?php
/**
 * Digital History Prints (digital-history-print)
 * @var $this HistoryprintController
 * @var $model DigitalHistoryPrint
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.core.components.system.OActiveForm', array(
	'id'=>'digital-history-print-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'digital_id', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'digital_id',array('maxlength'=>11, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'digital_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'print_price', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'print_price',array('maxlength'=>32, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'print_price'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'print_request_date', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php
			$model->print_request_date = !$model->isNewRecord ? (!in_array($model->print_request_date, array('0000-00-00','1970-01-01')) ? date('d-m-Y', strtotime($model->print_request_date)) : '') : '';
			//echo $form->textField($model,'print_request_date');
			$this->widget('application.libraries.core.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'print_request_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'form-control',
				 ),
			)); ?>
			<?php echo $form->error($model,'print_request_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'print_date', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php
			$model->print_date = !$model->isNewRecord ? (!in_array($model->print_date, array('0000-00-00','1970-01-01')) ? date('d-m-Y', strtotime($model->print_date)) : '') : '';
			//echo $form->textField($model,'print_date');
			$this->widget('application.libraries.core.components.system.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'print_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'form-control',
				 ),
			)); ?>
			<?php echo $form->error($model,'print_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'creation_date', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'creation_date', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'creation_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'creation_id', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'creation_id',array('maxlength'=>11, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'creation_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'modified_date', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'modified_date', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'modified_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'modified_id', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'modified_id',array('maxlength'=>11, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'modified_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row submit">
		<label class="col-form-label col-lg-4 col-md-3 col-sm-12">&nbsp;</label>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>

</fieldset>
<?php /*
<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
*/?>
<?php $this->endWidget(); ?>

