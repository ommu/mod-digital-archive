<?php
/**
 * Digital Categories (digital-category)
 * @var $this CategoryController
 * @var $model DigitalCategory
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'digital-category-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		'on_post' => true,
	),
)); ?>

<div class="dialog-content">
	<fieldset>

		<?php /*
		//begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages 
		*/?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_title'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'cat_title',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'cat_title'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_desc'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'cat_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'cat_desc'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_code'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'cat_code',array('maxlength'=>6)); ?>
				<?php echo $form->error($model,'cat_code'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_icon'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'cat_icon',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'cat_icon'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_icon_image'); ?>
			<div class="desc">
				<?php 
				if(!$model->isNewRecord) {
					if(!$model->getErrors())
						$model->old_cat_icon_image_input = $model->cat_icon_image;
					echo $form->hiddenField($model,'old_cat_icon_image_input');
					if($model->cat_icon_image != '') {
						$file = Yii::app()->request->baseUrl.'/public/digital/'.$model->old_cat_icon_image_input;?>
						<img class="mb-15" src="<?php echo Utility::getTimThumb($file, 200, 300, 3);?>" alt="">					
				<?php }
				}
				echo $form->fileField($model,'cat_icon_image'); ?>
				<?php echo $form->error($model,'cat_icon_image'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cat_cover'); ?>
			<div class="desc">
				<?php 
				if(!$model->isNewRecord) {
					if(!$model->getErrors())
						$model->old_cat_cover_input = $model->cat_cover;
					echo $form->hiddenField($model,'old_cat_cover_input');
					if($model->cat_cover != '') {
						$file = Yii::app()->request->baseUrl.'/public/digital/'.$model->old_cat_cover_input;?>
						<img class="mb-15" src="<?php echo Utility::getTimThumb($file, 300, 400, 3);?>" alt="">					
				<?php }
				}
				echo $form->fileField($model,'cat_cover'); ?>
				<?php echo $form->error($model,'cat_cover'); ?>
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

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>


