<?php
/**
 * Digital Category Tags (digital-category-tag)
 * @var $this CategorytagController
 * @var $model DigitalCategoryTag
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 22 December 2016, 16:08 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.core.components.system.OActiveForm', array(
	'id'=>'digital-category-tag-form',
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
		<?php echo $form->labelEx($model,'cat_id', array('class'=>'col-form-label col-lg-12 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'cat_id', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'cat_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'tag_id', array('class'=>'col-form-label col-lg-12 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'tag_id',array('maxlength'=>11, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'tag_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'creation_date', array('class'=>'col-form-label col-lg-12 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'creation_date', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'creation_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'creation_id', array('class'=>'col-form-label col-lg-12 col-md-3 col-sm-12')); ?>
		<div class="col-lg-8 col-md-9 col-sm-12">
			<?php echo $form->textField($model,'creation_id', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'creation_id'); ?>
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


