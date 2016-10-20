<?php
/**
 * Digitals (digitals)
 * @var $this SiteController
 * @var $data Digitals
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

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->digital_id), array('view', 'id'=>$data->digital_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cat_id')); ?>:</b>
	<?php echo CHtml::encode($data->cat_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher_id')); ?>:</b>
	<?php echo CHtml::encode($data->publisher_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	<?php echo CHtml::encode($data->language_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opac_id')); ?>:</b>
	<?php echo CHtml::encode($data->opac_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_code')); ?>:</b>
	<?php echo CHtml::encode($data->digital_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_title')); ?>:</b>
	<?php echo CHtml::encode($data->digital_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_intro')); ?>:</b>
	<?php echo CHtml::encode($data->digital_intro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_cover')); ?>:</b>
	<?php echo CHtml::encode($data->digital_cover); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish_year')); ?>:</b>
	<?php echo CHtml::encode($data->publish_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish_location')); ?>:</b>
	<?php echo CHtml::encode($data->publish_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isbn')); ?>:</b>
	<?php echo CHtml::encode($data->isbn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subjects')); ?>:</b>
	<?php echo CHtml::encode($data->subjects); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages')); ?>:</b>
	<?php echo CHtml::encode($data->pages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('series')); ?>:</b>
	<?php echo CHtml::encode($data->series); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />

	*/ ?>

</div>