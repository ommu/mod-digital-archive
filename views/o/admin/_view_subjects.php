<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */
?>

<?php 
$count = count($subjects);
$i=0;
foreach($subjects as $key => $val) {
	$i++;
	if($count != $i) {?>
		<a href="<?php echo Yii::app()->controller->createUrl('o/subjects/manage', array('tag'=>$val->tag_id));?>" title="<?php echo $val->tag->body?>"><?php echo $val->tag->body?></a>, 
	<?php } else {?>
		<a href="<?php echo Yii::app()->controller->createUrl('o/subjects/manage', array('tag'=>$val->tag_id));?>" title="<?php echo $val->tag->body?>"><?php echo $val->tag->body?></a>
<?php }
}?>