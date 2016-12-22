<?php
/**
 * Digital Choices (digital-choice)
 * @var $this ChoiceController
 * @var $data DigitalChoice
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 22 December 2016, 10:35 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('choice_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->choice_id), array('view', 'id'=>$data->choice_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_id')); ?>:</b>
	<?php echo CHtml::encode($data->digital_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choice_date')); ?>:</b>
	<?php echo CHtml::encode($data->choice_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choice_ip')); ?>:</b>
	<?php echo CHtml::encode($data->choice_ip); ?>
	<br />


</div>