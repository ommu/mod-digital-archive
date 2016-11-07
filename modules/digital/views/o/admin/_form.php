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
						<?php 
						$model->publish_year = !in_array($model->publish_year, array('0000','1970')) ? $model->publish_year : '';
						echo $form->textField($model,'publish_year',array('maxlength'=>4)); ?>
						<?php echo $form->error($model,'publish_year'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'publish_location'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'publish_location',array('rows'=>6, 'cols'=>50, 'class'=>'span-7')); ?>
						<?php echo $form->error($model,'publish_location'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'isbn'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'isbn',array('maxlength'=>32, 'class'=>'span-7')); ?>
						<?php echo $form->error($model,'isbn'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'pages'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'pages',array('maxlength'=>5, 'class'=>'span-7')); ?>
						<?php echo $form->error($model,'pages'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'series'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'series',array('rows'=>6, 'cols'=>50, 'class'=>'span-7')); ?>
						<?php echo $form->error($model,'series'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
				
				<div class="clearfix">
					<?php echo $form->labelEx($model,'author_input'); ?>
					<div class="desc">
						<?php 
						if($model->isNewRecord) {
							echo $form->textArea($model,'author_input',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller'));
							
						} else {
							//echo $form->textField($model,'author_input',array('maxlength'=>32,'class'=>'span-6'));
							$url = Yii::app()->controller->createUrl('o/authors/add', array('type'=>'digital'));
							$digital = $model->digital_id;
							$authorId = 'Digitals_author_input';
							$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
								'model' => $model,
								'attribute' => 'author_input',
								'source' => Yii::app()->controller->createUrl('o/author/suggest'),
								'options' => array(
									//'delay '=> 50,
									'minLength' => 1,
									'showAnim' => 'fold',
									'select' => "js:function(event, ui) {
										$.ajax({
											type: 'post',
											url: '$url',
											data: { digital_id: '$digital', author_id: ui.item.id, author: ui.item.value },
											dataType: 'json',
											success: function(response) {
												$('form #$authorId').val('');
												$('form #author-suggest').append(response.data);
											}
										});

									}"
								),
								'htmlOptions' => array(
									'class'	=> 'span-7',
								),
							));
							echo $form->error($model,'author_input');
						}?>
						<div id="author-suggest" class="suggest clearfix">
							<?php 
							if(!$model->isNewRecord) {
								$authors = $model->authors;
								if(!empty($authors)) {
									foreach($authors as $key => $val) {?>
									<div><?php echo $val->author->author_name;?><a href="<?php echo Yii::app()->controller->createUrl('o/authors/delete',array('id'=>$val->id,'type'=>'digital'));?>" title="<?php echo Yii::t('phrase', 'Delete');?>"><?php echo Yii::t('phrase', 'Delete');?></a></div>
								<?php }
								}
							}?>				
						</div>
						<?php if($model->isNewRecord) {?><span class="small-px">tambahkan tanda pagar (#) jika ingin menambahkan aothor lebih dari satu</span><?php }?>
					</div>
				</div>
				
				<div class="clearfix">
					<?php echo $form->labelEx($model,'subject_input'); ?>
					<div class="desc">
						<?php 
						if($model->isNewRecord) {
							echo $form->textArea($model,'subject_input',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller'));
							
						} else {
							//echo $form->textField($model,'subject_input',array('maxlength'=>32,'class'=>'span-6'));
							$url = Yii::app()->controller->createUrl('o/subjects/add', array('type'=>'digital'));
							$digital = $model->digital_id;
							$subjectId = 'Digitals_subject_input';
							$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
								'model' => $model,
								'attribute' => 'subject_input',
								'source' => Yii::app()->createUrl('globaltag/suggest'),
								'options' => array(
									//'delay '=> 50,
									'minLength' => 1,
									'showAnim' => 'fold',
									'select' => "js:function(event, ui) {
										$.ajax({
											type: 'post',
											url: '$url',
											data: { digital_id: '$digital', tag_id: ui.item.id, subject: ui.item.value },
											dataType: 'json',
											success: function(response) {
												$('form #$subjectId').val('');
												$('form #subject-suggest').append(response.data);
											}
										});

									}"
								),
								'htmlOptions' => array(
									'class'	=> 'span-7',
								),
							));
							echo $form->error($model,'subject_input');
						}?>
						<div id="subject-suggest" class="suggest clearfix">
							<?php 
							if(!$model->isNewRecord) {
								$subjects = $model->subjects;
								if(!empty($subjects)) {
									foreach($subjects as $key => $val) {?>
									<div><?php echo $val->tag->body;?><a href="<?php echo Yii::app()->controller->createUrl('o/subjects/delete',array('id'=>$val->id,'type'=>'digital'));?>" title="<?php echo Yii::t('phrase', 'Delete');?>"><?php echo Yii::t('phrase', 'Delete');?></a></div>
								<?php }
								}
							}?>				
						</div>
						<?php if($model->isNewRecord) {?><span class="small-px">tambahkan tanda koma (,) jika ingin menambahkan subject lebih dari satu</span><?php }?>
					</div>
				</div>
			</div>
			
			<div class="right">
				<?php if($model->isNewRecord) {?>
				<div class="clearfix">
					<?php echo $form->labelEx($model,'digital_file_input'); ?>
					<div class="desc">
						<?php echo $form->fileField($model,'digital_file_input'); ?>
						<?php echo $form->error($model,'digital_file_input'); ?>
						<span class="small-px">extensions are allowed: <?php echo Utility::formatFileType(unserialize($setting->digital_file_type), false);?></span>
					</div>
				</div>

				<div class="clearfix">
					<?php echo $form->labelEx($model,'multiple_file_input'); ?>
					<div class="desc">
						<?php echo $form->checkBox($model,'multiple_file_input'); ?>
						<?php echo $form->error($model,'multiple_file_input'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
				<?php }?>
				
				<div class="clearfix">
					<?php echo $form->labelEx($model,'digital_code'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'digital_code',array('maxlength'=>16)); ?>
						<?php echo $form->error($model,'digital_code'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
				
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


