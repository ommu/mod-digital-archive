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
		<?php 
		echo $form->errorSummary($model);
		if(Yii::app()->user->hasFlash('error'))
			echo Utility::flashError(Yii::app()->user->getFlash('error'));
		if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
		?>
	</div>
	<?php //begin.Messages ?>

	<fieldset class="clearfix">
		<div class="clear">
			<div class="left">

				<div class="clearfix">
					<?php echo $form->labelEx($model,'digital_title'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'digital_title',array('rows'=>6, 'cols'=>50, 'class'=>'span-8')); ?>
						<?php echo $form->error($model,'digital_title'); ?>
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
					<?php echo $form->labelEx($publisher,'publisher_name'); ?>
					<div class="desc">
						<?php 
						//echo $form->textField($publisher,'publisher_name',array('maxlength'=>64,'class'=>'span-7'));		
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'model' => $publisher,
							'attribute' => 'publisher_name',
							'source' => Yii::app()->controller->createUrl('o/publisher/suggest'),
							'options' => array(
								//'delay '=> 50,
								'minLength' => 1,
								'showAnim' => 'fold',
								'select' => "js:function(event, ui) {
									$('form #KckrPublisher_publisher_name').val(ui.item.value);
									$('form #Kckrs_publisher_id').val(ui.item.id);
								}"
							),
							'htmlOptions' => array(
								'class'	=> 'span-6',
								'maxlength'=>64,
							),
						));
						echo $form->hiddenField($model,'publisher_id');?>
						<?php echo $form->error($publisher,'publisher_name'); ?>
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
						<?php echo $form->textField($model,'publish_location',array('rows'=>6, 'cols'=>50, 'class'=>'span-8')); ?>
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
						<?php echo $form->textArea($model,'series',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
						<?php echo $form->error($model,'series'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
			</div>
			
			<div class="right">
				<div class="clearfix">
					<?php echo $form->labelEx($model,'cat_id'); ?>
					<div class="desc">
						<?php
						$category = DigitalCategory::getCategory(null, true);
						if($category != null)
							echo $form->dropDownList($model,'cat_id', $category, array('prompt'=>Yii::t('phrase', 'Select One')));
						else
							echo $form->dropDownList($model,'cat_id', array('prompt'=>Yii::t('phrase', 'Select One')));?>
						<?php echo $form->error($model,'cat_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'subjects'); ?>
					<div class="desc">
						<?php 
						$model->subjects = unserialize($model->subjects);
						echo $form->checkBoxList($model,'subjects', DigitalSubject::getSubject()); ?>
						<?php echo $form->error($model,'subjects'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'language_id'); ?>
					<div class="desc">
						<?php 
						$language = DigitalLanguage::getLanguage(null, true);
						if($language != null)
							echo $form->dropDownList($model,'language_id', $language, array('prompt'=>Yii::t('phrase', 'Select One')));
						else
							echo $form->dropDownList($model,'language_id', array('prompt'=>Yii::t('phrase', 'Select One')));?>
						<?php echo $form->error($model,'language_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'opac_id'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'opac_id',array('class'=>'span-4')); ?>
						<?php echo $form->error($model,'opac_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'publish'); ?>
					<div class="desc">
						<?php echo $form->checkBox($model,'publish'); ?>
						<?php echo $form->error($model,'publish'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
		
	<fieldset>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_intro'); ?>
			<div class="desc">
				<?php 
				//echo $form->textArea($model,'digital_intro',array('rows'=>6, 'cols'=>50));
				$this->widget('application.extensions.imperavi.ImperaviRedactorWidget', array(
					'model'=>$model,
					'attribute'=>digital_intro,
					// Redactor options
					'options'=>array(
						//'lang'=>'fi',
						'buttons'=>array(
							'html', 'formatting', '|', 
							'bold', 'italic', 'deleted', '|',
							'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
							'link', '|',
						),
					),
					'plugins' => array(
						'fontcolor' => array('js' => array('fontcolor.js')),
						'table' => array('js' => array('table.js')),
						'fullscreen' => array('js' => array('fullscreen.js')),
					),
				)); ?>
				<?php echo $form->error($model,'digital_intro'); ?>
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


