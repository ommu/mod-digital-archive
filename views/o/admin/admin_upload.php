<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 *
 */
	
	$this->breadcrumbs=array(
		'Digital Categories'=>array('manage'),
		$model->cat_id=>array('view','id'=>$model->cat_id),
		'Update',
	);
?>

<?php $form=$this->beginWidget('application.libraries.core.components.system.OActiveForm', array(
	'id'=>'digital-category-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		'on_post' => '',
	),
)); ?>

<div class="dialog-content">
	<fieldset>

		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php //echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_file_input'); ?>
			<div class="desc">
				<?php echo $form->fileField($model,'digital_file_input'); ?>
				<?php echo $form->error($model,'digital_file_input'); ?>
				<span class="small-px">extensions are allowed: <?php echo Utility::formatFileType($digital_file_type, false);?></span>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'multiple_file_input'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'multiple_file_input'); ?>
				<?php echo $form->labelEx($model,'multiple_file_input'); ?>
				<?php echo $form->error($model,'multiple_file_input'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>