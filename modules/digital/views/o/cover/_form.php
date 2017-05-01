<?php
/**
 * Digital Covers (digital-cover)
 * @var $this CoverController
 * @var $model DigitalCover
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/Digital-Archive
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
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
			<div class="clearfix">
				<?php echo $form->labelEx($model,'digital_title_input'); ?>
				<div class="desc">
					<?php 
					//echo $form->textField($model,'digital_title_input', array('class'=>'span-8'));		
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
							'class'	=> 'span-8',
						),
					));
					echo $form->hiddenField($model,'digital_id'); ?>
					<?php echo $form->error($model,'digital_title_input'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cover_filename'); ?>
			<div class="desc">
				<?php 
				if(!$model->getErrors())
					$model->old_cover_filename_input = $model->cover_filename;
				if(!$model->isNewRecord && $model->old_cover_filename_input != '') {
					echo $form->hiddenField($model,'old_cover_filename_input');
					//$cover = Yii::app()->request->baseUrl.'/public/digital/'.$model->digital->view->uniquepath.'/'.$model->old_cover_filename_input;
					$cover = Yii::app()->controller->createUrl('media/cover', array('id'=>$model->cover_id,'abc'=>$model->md5coverpath));?>
						<img class="mb-10" src="<?php echo Utility::getTimThumb($cover, 300, 400, 3);?>" alt="">
				<?php }
				echo $form->fileField($model,'cover_filename'); ?>
				<?php echo $form->error($model,'cover_filename'); ?>
				<span class="small-px">extensions are allowed: <?php echo Utility::formatFileType($cover_file_type, false);?></span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cover_caption'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'cover_caption',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'cover_caption'); ?>
			</div>
		</div>

		<?php if($setting->cover_limit == 1) {
			$model->status = 1;
			echo $form->hiddenField($model,'status');?>
		<?php } else {?>
			<div class="clearfix publish">
				<?php echo $form->labelEx($model,'status'); ?>
				<div class="desc">
					<?php echo $form->checkBox($model,'status'); ?>
					<?php echo $form->labelEx($model,'status'); ?>
					<?php echo $form->error($model,'status'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
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


