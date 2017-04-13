<?php
/**
 * Digital Choices (digital-choice)
 * @var $this ChoiceController
 * @var $model DigitalChoice
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 22 December 2016, 10:35 WIB
 * @link https://github.com/ommu/Digital-Archive
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('choice_id'); ?><br/>
			<?php echo $form->textField($model,'choice_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('digital_id'); ?><br/>
			<?php echo $form->textField($model,'digital_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('choice_date'); ?><br/>
			<?php echo $form->textField($model,'choice_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('choice_ip'); ?><br/>
			<?php echo $form->textField($model,'choice_ip',array('size'=>20,'maxlength'=>20)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
