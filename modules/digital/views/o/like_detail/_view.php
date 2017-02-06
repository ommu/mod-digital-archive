<?php
/**
 * Digital Like Details (digital-like-detail)
 * @var $this LikedetailController
 * @var $data DigitalLikeDetail
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (ommu.co)
 * @created date 7 February 2017, 02:35 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_id')); ?>:</b>
	<?php echo CHtml::encode($data->like_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('likes_date')); ?>:</b>
	<?php echo CHtml::encode($data->likes_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('likes_ip')); ?>:</b>
	<?php echo CHtml::encode($data->likes_ip); ?>
	<br />


</div>