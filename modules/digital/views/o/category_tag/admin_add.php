<?php
/**
 * Digital Category Tags (digital-category-tag)
 * @var $this CategorytagController
 * @var $model DigitalCategoryTag
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 22 December 2016, 16:08 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Category Tags'=>array('manage'),
		'Create',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/category_tag/_form', array('model'=>$model)); ?>
</div>
