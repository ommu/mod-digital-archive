<?php $this->beginContent('//layouts/default');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.public.*');
	
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	if($module == null) {
		if($controller == 'site') {
			if($action == 'index')
				$class = 'main';
			else if($action == 'login')
				$class = 'login';
			else
				$class = $action;
		} else
			$class = Utility::getUrlTitle($controller);
	} else {
		if($controller == 'site') {
			if($module == 'article')
				$class = 'blog';
			else
				$class = $module;
		} else
			$class = Utility::getUrlTitle($module.'-'.$controller);
	}
?>
<?php //echo $this->dialogDetail == true ? (empty($this->dialogWidth) ? 'class="boxed clearfix"' : 'class="clearfix"') : 'class="clearfix"';?>

<?php if($this->dialogDetail == false && $this->pageTitleShow == true) {?>
<!-- Page Header - litle-header or bigger-header - soft-header, dark-header or background -->
<section id="page-header" class="soft-header <?php echo in_array($controller, array('jateng','jabar','jatim','banten','jogja','jakarta')) ? 'big-header' : 'little-header';?> parallax3">
	<!-- Page Header Inner -->
	<div class="page_header_inner clearfix dark">
		<!-- Left -->
		<div class="left f-left">
			<!-- Header -->
			<h2 class="page_header light"><?php echo CHtml::encode(in_array($controller, array('jateng','jabar','jatim','banten','jogja','jakarta')) ? $this->location_name : $this->pageTitle); ?></h2>
		</div>
		<?php /*
		<ul id="breadcrumbs" class="breadcrumbs page-title-side right f-right light">
			<li><a href="http://veented.info/crexis/">Home</a></li>
			<li>Blog</li>
		</ul>
		*/?>
	</div>
	<!-- End Inner -->
</section>
<!-- End #page-header -->	
<?php }?>

<div class="page-holder <?php echo $this->adsSidebar == false ? 'page-layout-fullwidth' : 'blog blog-index page-layout-sidebar_right blog-style-classic';?>">
	<?php if($module == null && $currentAction == 'site/index')
		echo $content;
		
	else {?>
	<div id="<?php echo $class;?>" class="inner clearfix">
		<?php if($this->adsSidebar == true) {?>				
		<div class="page_inner">
			<?php echo $content;?>
		</div>
		<div id="sidebar" class="page_sidebar sidebar-style-default">
			<div id="search-2" class="widget bar widget_search">
				<h5>Search</h5>
				<form class="search-form relative" id="search-form" action="<?php echo Yii::app()->createUrl('search/result');?>">
					<input name="keyword" id="s" type="text" value="" placeholder="Search..." class="search">
					<button class="search-button"><i class="fa fa-search"></i></button>
				</form>
			</div>
			<?php /*
			<div id="recent-posts-2" class="widget bar widget_recent_entries">
				<h5>Recent Posts</h5>
				<ul>
					<li>
						<a href="http://veented.info/crexis/red-hair/">Post from Blog</a>
					</li>
					<li>
						<a href="http://veented.info/crexis/black-and-white/">Desert and Clouds</a>
					</li>
					<li>
						<a href="http://veented.info/crexis/in-the-woods/">Train Tracks</a>
					</li>
					<li>
						<a href="http://veented.info/crexis/city-of-new-york/">City of New York</a>
					</li>
					<li>
						<a href="http://veented.info/crexis/cloudy-desert/">Cloudy Desert</a>
					</li>
				</ul>
			</div>
			<div id="categories-2" class="widget bar widget_categories">
				<h5>Categories</h5>
				<ul>
					<li class="cat-item cat-item-14"><a href="http://veented.info/crexis/category/architecture/" >Architecture</a></li>
					<li class="cat-item cat-item-11"><a href="http://veented.info/crexis/category/photography/" >Photography</a></li>
					<li class="cat-item cat-item-17"><a href="http://veented.info/crexis/category/web-design/" >Web Design</a></li>
					<li class="cat-item cat-item-12"><a href="http://veented.info/crexis/category/work/" >Work</a></li>
				</ul>
			</div>
			*/?>
			<?php $this->widget('SidebarArticleTags'); ?>
		</div>
		
		<?php } else {
			echo $content;
		}?>		
	</div>
	<?php }?>
</div>

<?php $this->endContent(); ?>