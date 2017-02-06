<?php
/**
 * Digital Like Details (digital-like-detail)
 * @var $this LikedetailController
 * @var $model DigitalLikeDetail
 * @var $dataProvider CActiveDataProvider
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (ommu.co)
 * @created date 7 February 2017, 02:35 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Like Details',
	);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/o/like_detail/_view',
	'pager' => array(
		'header' => '',
	), 
	'summaryText' => '',
	'itemsCssClass' => 'items clearfix',
	'pagerCssClass'=>'pager clearfix',
)); ?>
