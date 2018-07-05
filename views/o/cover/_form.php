<?php
/**
 * Digital Covers (digital-cover)
 * @var $this CoverController
 * @var $model DigitalCover
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.core.components.system.OActiveForm', array(
	'id'=>'digital-cover-form',
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
		
		<?php if($model->isNewRecord && $digital == null) {?>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'digital_title_input', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
				<div class="col-lg-8 col-md-9 col-sm-12">
					<?php 
					//echo $form->textField($model,'digital_title_input', array('class'=>'form-control'));
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'model' => $model,
						'attribute' => 'digital_title_input',
						'source' => Yii::app()->controller->createUrl('o/admin/suggest'),
						'options' => array(
							//'delay '=> 50,
							'minLength' => 1,
							'showAnim' => 'fold',
							'select' => "js:function(event, ui) {
								$('form #DigitalCover_digital_title_input').val(ui.item.value);
								$('form #DigitalCover_digital_id').val(ui.item.id);
							}"
						),
						'htmlOptions' => array(
							'class'	=> 'form-control',
						),
					));
					echo $form->hiddenField($model,'digital_id'); ?>
					<?php echo $form->error($model,'digital_title_input'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="form-group row">
			<?php echo $form->labelEx($model,'cover_filename', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
			<div class="col-lg-8 col-md-9 col-sm-12">
				<?php 
				if(!$model->getErrors())
					$model->old_cover_filename_input = $model->cover_filename;
				if(!$model->isNewRecord && $model->old_cover_filename_input != '') {
					echo $form->hiddenField($model,'old_cover_filename_input');
					//$cover = Yii::app()->request->baseUrl.'/public/digital/'.$model->digital->view->uniquepath.'/'.$model->old_cover_filename_input;
					$cover = Yii::app()->controller->createUrl('media/cover', array('id'=>$model->cover_id,'abc'=>$model->md5coverpath));?>
						<img class="mb-10" src="<?php echo Utility::getTimThumb($cover, 300, 400, 3);?>" alt="">
				<?php }
				echo $form->fileField($model,'cover_filename', array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'cover_filename'); ?>
				<span class="small-px">extensions are allowed: <?php echo Utility::formatFileType($cover_file_type, false);?></span>
			</div>
		</div>

		<div class="form-group row">
			<?php echo $form->labelEx($model,'cover_caption', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
			<div class="col-lg-8 col-md-9 col-sm-12">
				<?php echo $form->textArea($model,'cover_caption', array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
				<?php echo $form->error($model,'cover_caption'); ?>
			</div>
		</div>

		<?php if($setting->cover_limit == 1) {
			$model->status = 1;
			echo $form->hiddenField($model,'status');?>
		<?php } else {?>
			<div class="form-group row publish">
				<?php echo $form->labelEx($model,'status', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
				<div class="col-lg-8 col-md-9 col-sm-12">
					<?php echo $form->checkBox($model,'status', array('class'=>'form-control')); ?>
					<?php echo $form->labelEx($model,'status'); ?>
					<?php echo $form->error($model,'status'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="form-group row publish">
			<?php echo $form->labelEx($model,'publish', array('class'=>'col-form-label col-lg-4 col-md-3 col-sm-12')); ?>
			<div class="col-lg-8 col-md-9 col-sm-12">
				<?php echo $form->checkBox($model,'publish', array('class'=>'form-control')); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') , array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>


