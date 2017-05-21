<?php
/**
 * Digital History Prints (digital-history-print)
 * @var $this HistoryprintController
 * @var $data DigitalHistoryPrint
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/mod-digital-archive
 * @contact (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digital_id')); ?>:</b>
	<?php echo CHtml::encode($data->digital_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('print_price')); ?>:</b>
	<?php echo CHtml::encode($data->print_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('print_request_date')); ?>:</b>
	<?php echo CHtml::encode($data->print_request_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('print_date')); ?>:</b>
	<?php echo CHtml::encode($data->print_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />

	*/ ?>

</div>