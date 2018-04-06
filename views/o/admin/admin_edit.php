<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
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
		'cover_file_type'=>$cover_file_type,
		'form_custom_field'=>$form_custom_field,
	)); ?>
</div>

<?php if($setting->cover_limit != 1) {?>
<div class="boxed mt-15">
	<h3><?php echo Yii::t('phrase', 'Digital Cover'); ?></h3>
	<div class="clearfix horizontal-data" name="four">
		<ul id="media-render">
			<?php 
			$this->renderPartial('_form_cover', array('model'=>$model, 'covers'=>$covers, 'setting'=>$setting));
			if($covers != null) {
				foreach($covers as $key => $val)
					$this->renderPartial('_form_view_covers', array('data'=>$val));
			}?>
		</ul>
	</div>
</div>
<?php }?>
