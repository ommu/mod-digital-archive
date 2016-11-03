<?php
/**
 * View Digital Subjects (view-digital-subject)
 * @var $this SubjectController
 * @var $data ViewDigitalSubject
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 3 November 2016, 16:42 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tag_id), array('view', 'id'=>$data->tag_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digitals')); ?>:</b>
	<?php echo CHtml::encode($data->digitals); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_publish')); ?>:</b>
	<?php echo CHtml::encode($data->digital_publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_unpublish')); ?>:</b>
	<?php echo CHtml::encode($data->digital_unpublish); ?>
	<br />


</div>