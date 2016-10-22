<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'digitals-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<?php //begin.Messages ?>
	<div id="ajax-message">
		<?php echo $form->errorSummary($model); ?>
	</div>
	<?php //begin.Messages ?>

	<fieldset>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'cat_id'); ?>
				<?php echo $form->error($model,'cat_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'publisher_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'publisher_id',array('maxlength'=>11)); ?>
				<?php echo $form->error($model,'publisher_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'language_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'language_id'); ?>
				<?php echo $form->error($model,'language_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'opac_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'opac_id'); ?>
				<?php echo $form->error($model,'opac_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_code'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'digital_code',array('maxlength'=>16)); ?>
				<?php echo $form->error($model,'digital_code'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_title'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'digital_title',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'digital_title'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_intro'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'digital_intro',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'digital_intro'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_cover'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'digital_cover',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'digital_cover'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'publish_year'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'publish_year',array('maxlength'=>4)); ?>
				<?php echo $form->error($model,'publish_year'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'publish_location'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'publish_location',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'publish_location'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'isbn'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'isbn',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'isbn'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'subjects'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'subjects',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'subjects'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'pages'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'pages',array('maxlength'=>5)); ?>
				<?php echo $form->error($model,'pages'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'series'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'series',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'series'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
			</div>
		</div>

	</fieldset>

<?php $this->endWidget(); ?>


