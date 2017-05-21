<?php
/**
 * Digital Settings (digital-setting)
 * @var $this SettingController
 * @var $model DigitalSetting
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
 * @contact (+62)856-299-4114
 *
 */

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('select#DigitalSetting_headline').on('change', function() {
		var id = $(this).val();
		if(id == '1') {
			$('div#headline').slideDown();
		} else {
			$('div#headline').slideUp();
		}
	});
EOP;
	$cs->registerScript('js', $js, CClientScript::POS_END);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'digital-setting-form',
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
			<label>
				<?php echo $model->getAttributeLabel('license');?> <span class="required">*</span><br/>
				<span><?php echo Yii::t('phrase', 'Enter the your license key that is provided to you when you purchased this plugin. If you do not know your license key, please contact support team.');?></span>
			</label>
			<div class="desc">
				<?php 
				if($model->isNewRecord || (!$model->isNewRecord && $model->license == ''))
					$model->license = DigitalSetting::getLicense();
			
				if($model->isNewRecord || (!$model->isNewRecord && $model->license == ''))
					echo $form->textField($model,'license',array('maxlength'=>32,'class'=>'span-4'));
				else
					echo $form->textField($model,'license',array('maxlength'=>32,'class'=>'span-4','disabled'=>'disabled'));?>
				<?php echo $form->error($model,'license'); ?>
				<span class="small-px"><?php echo Yii::t('phrase', 'Format: XXXX-XXXX-XXXX-XXXX');?></span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'permission'); ?>
			<div class="desc">
				<span class="small-px"><?php echo Yii::t('phrase', 'Select whether or not you want to let the public (visitors that are not logged-in) to view the following sections of your social network. In some cases (such as Profiles, Blogs, and Albums), if you have given them the option, your users will be able to make their pages private even though you have made them publically viewable here. For more permissions settings, please visit the General Settings page.');?></span>
				<?php echo $form->radioButtonList($model, 'permission', array(
					1 => Yii::t('phrase', 'Yes, the public can view articles unless they are made private.'),
					0 => Yii::t('phrase', 'No, the public cannot view articles.'),
				)); ?>
				<?php echo $form->error($model,'permission'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'meta_description'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50, 'class'=>'span-7 smaller')); ?>
				<?php echo $form->error($model,'meta_description'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'meta_keyword'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'meta_keyword',array('rows'=>6, 'cols'=>50, 'class'=>'span-7 smaller')); ?>
				<?php echo $form->error($model,'meta_keyword'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cover_unlimit_input'); ?>
			<div class="desc">
				<?php 
				if(!$model->getErrors())
					$model->cover_unlimit_input = $model->cover_limit == 0 ? 1 : 0;
				echo $form->checkBox($model,'cover_unlimit_input'); ?>
				<?php echo $form->error($model,'cover_unlimit_input'); ?>
			</div>
		</div>

		<div id="cover-limit" class="clearfix <?php echo $model->cover_limit == 0 ? 'hide' : '';?>">
			<?php echo $form->labelEx($model,'cover_limit'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'cover_limit', array('maxlength'=>2, 'class'=>'span-2')); ?>
				<?php echo $form->error($model,'cover_limit'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo Yii::t('phrase', 'Cover Setting');?> <span class="required">*</span></label>
			<div class="desc">
				<p><?php echo $model->getAttributeLabel('cover_resize');?></p>
				<?php echo $form->radioButtonList($model, 'cover_resize', array(
					0 => Yii::t('phrase', 'No, not resize cover after upload.'),
					1 => Yii::t('phrase', 'Yes, resize cover after upload.'),
				)); ?>
				
				<?php if(!$model->getErrors()) {
					$model->cover_resize_size = unserialize($model->cover_resize_size);
					$model->cover_view_size = unserialize($model->cover_view_size);
				}?>
				
				<div id="resize_size" class="mt-15 <?php echo $model->cover_resize == 0 ? 'hide' : '';?>">
					<?php echo Yii::t('phrase', 'Width').': ';?><?php echo $form->textField($model,'cover_resize_size[width]',array('maxlength'=>4,'class'=>'span-2')); ?>&nbsp;&nbsp;&nbsp;
					<?php echo Yii::t('phrase', 'Height').': ';?><?php echo $form->textField($model,'cover_resize_size[height]',array('maxlength'=>4,'class'=>'span-2')); ?>
					<?php echo $form->error($model,'cover_resize_size'); ?>
				</div>
				
				<p><?php echo Yii::t('phrase', 'Large Size');?></p>				
				<?php echo Yii::t('phrase', 'Width').': ';?><?php echo $form->textField($model,'cover_view_size[large][width]',array('maxlength'=>4,'class'=>'span-2')); ?>&nbsp;&nbsp;&nbsp;
				<?php echo Yii::t('phrase', 'Height').': ';?><?php echo $form->textField($model,'cover_view_size[large][height]',array('maxlength'=>4,'class'=>'span-2')); ?>
				<?php echo $form->error($model,'cover_view_size[large]'); ?>
				
				<p><?php echo Yii::t('phrase', 'Medium Size');?></p>
				<?php echo Yii::t('phrase', 'Width').': ';?><?php echo $form->textField($model,'cover_view_size[medium][width]',array('maxlength'=>3,'class'=>'span-2')); ?>&nbsp;&nbsp;&nbsp;
				<?php echo Yii::t('phrase', 'Height').': ';?><?php echo $form->textField($model,'cover_view_size[medium][height]',array('maxlength'=>3,'class'=>'span-2')); ?>
				<?php echo $form->error($model,'cover_view_size[medium]'); ?>
				
				<p><?php echo Yii::t('phrase', 'Small Size');?></p>
				<?php echo Yii::t('phrase', 'Width').': ';?><?php echo $form->textField($model,'cover_view_size[small][width]',array('maxlength'=>3,'class'=>'span-2')); ?>&nbsp;&nbsp;&nbsp;
				<?php echo Yii::t('phrase', 'Height').': ';?><?php echo $form->textField($model,'cover_view_size[small][height]',array('maxlength'=>3,'class'=>'span-2')); ?>
				<?php echo $form->error($model,'cover_view_size[small]'); ?>
			</div>
		</div>

		<?php if(!$model->isNewRecord && $model->digital_admin == 1) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'form_standard'); ?>
			<div class="desc">
				<?php echo $form->radioButtonList($model, 'form_standard', array(
					1 => Yii::t('phrase', 'Standard'),
					0 => Yii::t('phrase', 'Custom'),
				)); ?>
				<?php echo $form->error($model,'form_standard'); ?>
			</div>
		</div>

		<div class="clearfix <?php echo $model->form_standard == 1 ? 'hide' : '';?>" id="custom_field">
			<label><?php echo $model->getAttributeLabel('form_custom_field');?></label>
			<div class="desc">
				<?php 				
				$customField = array(
					'cat_id' => $digital->getAttributeLabel('cat_id'),
					'publisher_id' => $digital->getAttributeLabel('publisher_id'),
					'language_id' => $digital->getAttributeLabel('language_id'),
					'digital_code' => $digital->getAttributeLabel('digital_code'),
					'publish_year' => $digital->getAttributeLabel('publish_year'),
					'publish_location' => $digital->getAttributeLabel('publish_location'),
					'author_input' => $digital->getAttributeLabel('author_input'),
					'isbn' => $digital->getAttributeLabel('isbn'),
					'pages' => $digital->getAttributeLabel('pages'),
					'series' => $digital->getAttributeLabel('series'),
					'subject_input' => $digital->getAttributeLabel('subject_input'),
					'tag_input' => $digital->getAttributeLabel('tag_input'),
					'opac_id' => $digital->getAttributeLabel('opac_id'),
				);
				if(!$model->getErrors())
					$model->form_custom_field = unserialize($model->form_custom_field);
				
				echo $form->checkBoxList($model, 'form_custom_field', $customField); ?>
				<?php echo $form->error($model,'form_custom_field'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'headline'); ?>
			<div class="desc">
				<?php echo $form->dropDownLIst($model,'headline', array(
					'1' => Yii::t('phrase', 'Enable'),
					'0' => Yii::t('phrase', 'Disable'),
				)); ?>
				<?php echo $form->error($model,'headline'); ?>
			</div>
		</div>
		
		<div id="headline" class="<?php echo $model->headline == 0 ? 'hide' : '';?>">
			<div class="clearfix">
				<?php echo $form->labelEx($model,'headline_limit'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'headline_limit', array('maxlength'=>3, 'class'=>'span-2')); ?>
					<?php echo $form->error($model,'headline_limit'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'headline_category'); ?>
				<div class="desc">
					<?php 
					$category = DigitalCategory::getCategory(1);
					if(!$model->getErrors())
						$model->headline_category = unserialize($model->headline_category);
					echo $form->checkBoxList($model,'headline_category', $category); ?>
					<?php echo $form->error($model,'headline_category'); ?>
				</div>
			</div>
		</div>		

		<div class="clearfix">
			<?php echo $form->labelEx($model,'editor_choice_status'); ?>
			<div class="desc">
				<?php echo $form->radioButtonList($model, 'editor_choice_status', array(
					1 => Yii::t('phrase', 'Enable'),
					0 => Yii::t('phrase', 'Disable'),
				)); ?>
				<?php echo $form->error($model,'editor_choice_status'); ?>
			</div>
		</div>

		<div <?php echo $model->editor_choice_status == 0 ? 'class="hide"' : '';?> id="editor_choice">
			<div class="clearfix">
				<?php echo $form->labelEx($model,'editor_choice_limit'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'editor_choice_limit', array('maxlength'=>2, 'class'=>'span-2')); ?>
					<?php echo $form->error($model,'editor_choice_limit'); ?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'editor_choice_userlevel'); ?>
				<div class="desc">
					<?php 
					if(!$model->getErrors())
						$model->editor_choice_userlevel = unserialize($model->editor_choice_userlevel);
					echo $form->checkBoxList($model,'editor_choice_userlevel', UserLevel::getUserLevel()); ?>
					<?php echo $form->error($model,'editor_choice_userlevel'); ?>
				</div>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'content_verified'); ?>
			<div class="desc">
				<?php echo $form->radioButtonList($model, 'content_verified', array(
					1 => Yii::t('phrase', 'Enable'),
					0 => Yii::t('phrase', 'Disable'),
				)); ?>
				<?php echo $form->error($model,'content_verified'); ?>
			</div>
		</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'cover_file_type'); ?>
			<div class="desc">
				<?php 
				if(!$model->getErrors()) {
					$cover_file_type = unserialize($model->cover_file_type);
					if(!empty($cover_file_type))
						$model->cover_file_type = Utility::formatFileType($cover_file_type, false);
				}
				echo $form->textField($model,'cover_file_type', array('class'=>'span-8')); ?>
				<?php echo $form->error($model,'cover_file_type'); ?>
				<span class="small-px">pisahkan jenis file dengan koma (,). example: "jpg, png, bmp"</span>
			</div>
		</div>

		<?php 
		$form_custom_field = $model->form_custom_field;
		if($model->digital_global_file_type == 1 || ($model->digital_global_file_type == 0 && ($model->form_standard == 1 || ($model->form_standard == 0 && !in_array('cat_id', $form_custom_field))))) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_file_type'); ?>
			<div class="desc">
				<?php				
				if(!$model->getErrors()) {
					$digital_file_type = unserialize($model->digital_file_type);
					if(!empty($digital_file_type))
						$model->digital_file_type = Utility::formatFileType($digital_file_type, false);
				}
				echo $form->textField($model,'digital_file_type', array('class'=>'span-8')); ?>
				<?php echo $form->error($model,'digital_file_type'); ?>
				<span class="small-px">pisahkan type file dengan koma (,). example: "mp3, mp4, pdf, doc, docx"</span>
			</div>
		</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_path'); ?>
			<div class="desc">
				<?php 
				if($model->isNewRecord || (!$model->isNewRecord && $model->digital_path == ''))
					$model->digital_path = YiiBase::getPathOfAlias('webroot.public.digital');
				echo $form->textField($model,'digital_path', array('class'=>'span-9')); ?>
				<?php echo $form->error($model,'digital_path'); ?>
				<span class="small-px">example: "<?php echo YiiBase::getPathOfAlias('webroot.public.digital')?>"</span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'digital_sync_path'); ?>
			<div class="desc">
				<?php 
				if($model->isNewRecord || (!$model->isNewRecord && $model->digital_sync_path == ''))
					$model->digital_sync_path = YiiBase::getPathOfAlias('webroot.public.digital.__');
				echo $form->textField($model,'digital_sync_path', array('class'=>'span-9')); ?>
				<?php echo $form->error($model,'digital_sync_path'); ?>
				<span class="small-px">example: "<?php echo YiiBase::getPathOfAlias('webroot.public.digital.__')?>"</span>
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


