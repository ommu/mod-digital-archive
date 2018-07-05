<?php
/**
 * Digital Authors (digital-author)
 * @var $this AuthorController
 * @var $model DigitalAuthor
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:12 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital Authors'=>array('manage'),
		$model->author_id=>array('view','id'=>$model->author_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>