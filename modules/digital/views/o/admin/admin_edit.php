<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digitals'=>array('manage'),
		$model->digital_id=>array('view','id'=>$model->digital_id),
		'Update',
	);
	$covers = $model->covers;
?>

<div class="form">
	<?php echo $this->renderPartial('_form', array(
		'model'=>$model,
		'publisher'=>$publisher,
		'setting'=>$setting,
	)); ?>
</div>

<?php if($setting->cover_limit != 1) {?>
<div class="boxed mt-15">
	<h3><?php echo Yii::t('phrase', 'Digital Cover'); ?></h3>
	<div class="clearfix horizontal-data" name="four">
		<ul id="media-render">
			<?php 
			$this->renderPartial('_view_cover_add', array('covers'=>$covers, 'setting'=>$setting));
			if($covers != null) {
				foreach($covers as $key => $val) {
					$this->renderPartial('_view_covers', array('data'=>$val));
				}
			}?>
		</ul>
	</div>
</div>
<?php }?>
