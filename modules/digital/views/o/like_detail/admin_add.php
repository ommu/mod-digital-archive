<?php
/**
 * Digital Like Details (digital-like-detail)
 * @var $this LikedetailController
 * @var $model DigitalLikeDetail
 * @var $form CActiveForm
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
		'Digital Like Details'=>array('manage'),
		'Create',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/o/like_detail/_form', array('model'=>$model)); ?>
</div>
