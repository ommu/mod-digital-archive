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

	<?php if($module == null && $currentAction == 'site/index')
		echo $content;
		
	else {?>
		<?php if($this->adsSidebar == true) {?>
		<div class="container active-sidebar right">
			<div id="primary" class="content-area">
				<?php echo $content;?>
			</div>
			<!-- #primary -->
			<div id="tertiary" class="sidebar-container" role="complementary">
				<div class="sidebar-inner">
					<div class="widget-area clearfix">
						<div id="search-2" class="widget-1 widget-first widget-odd widget widget_search">
							<form method="get" class="searchform" action="http://azexo.com/wisem/">
								<span class="toggle"></span>
								<div class="searchform-wrapper">
									<label class="screen-reader-text">Search for:</label>
									<input type="text" value="" name="s" />
									<div class="submit"><input type="submit" value="Search"></div>
								</div>
							</form>
						</div>
						<div id="categories-2" class="widget-2 widget-even widget widget_categories">
							<div class="widget-title">
								<h3>Categories</h3>
							</div>
							<ul>
								<li class="cat-item cat-item-39"><a href="http://azexo.com/wisem/category/curabitur-lacinia/" >Curabitur lacinia</a></li>
								<li class="cat-item cat-item-37"><a href="http://azexo.com/wisem/category/donec-tincidunt/" >Donec tincidunt</a></li>
								<li class="cat-item cat-item-35"><a href="http://azexo.com/wisem/category/etiam-eget/" >Etiam eget</a></li>
								<li class="cat-item cat-item-36"><a href="http://azexo.com/wisem/category/maecenas/" >Maecenas</a></li>
								<li class="cat-item cat-item-32"><a href="http://azexo.com/wisem/category/praesent-molestie/" >Praesent molestie</a></li>
								<li class="cat-item cat-item-34"><a href="http://azexo.com/wisem/category/quisque-sagittis/" >Quisque sagittis</a></li>
								<li class="cat-item cat-item-33"><a href="http://azexo.com/wisem/category/sed-rutrum/" >Sed rutrum</a></li>
								<li class="cat-item cat-item-38"><a href="http://azexo.com/wisem/category/ullamcorper/" >Ullamcorper</a></li>
							</ul>
						</div>
						<div id="vc_widget-11" class="widget-3 widget-odd widget widget_vc_widget">
							<div class="widget-title">
								<h3>Recent posts</h3>
							</div>
							<div class="scoped-style">
								<div class="vc_row wpb_row vc_row-fluid">
									<div class="row">
										<div class="h-padding-0 wpb_column vc_column_container vc_col-sm-12">
											<div class="wpb_wrapper">
												<div class="posts-list-wrapper ">
													<div class="posts-list recent-post  " data-contents-per-item="1" data-width="260" data-height="150" data-stagePadding="0" data-margin="0" data-full-width="" data-center="" data-loop="">
														<div class="entry recent-post post-201 post type-post status-publish format-standard has-post-thumbnail hentry category-etiam-eget tag-bibendum tag-libero">
															<div class="entry-thumbnail">
																<a href="http://azexo.com/wisem/commodo-consequat/">
																	<div class="image " style='background-image: url("http://azexo.com/wisem/wp-content/uploads/2016/06/blog6-260x150.jpg"); height: 150px;' data-width="260" data-height="150">
																	</div>
																</a>
															</div>
															<div class="entry-data">
																<div class="entry-header">
																	<h2 class="entry-title"><a href="http://azexo.com/wisem/commodo-consequat/" rel="bookmark">Commodo consequat</a></h2>
																</div>
																<div class="entry-summary">Eiusmod tempor incidiunt labore velit dolore magna aliqu sed enimi&hellip;</div>
																<div class="entry-footer">
																	<span class="like">
																		<span class="sl-wrapper">
																			<a href="http://azexo.com/wisem/wp-admin/admin-ajax.php?action=process_simple_like&#038;nonce=4d729b52af&#038;post_id=201&#038;disabled=true&#038;is_comment=0" class="sl-button sl-button-201" data-nonce="4d729b52af" data-post-id="201" data-iscomment="0" title="Like">
																				<span class="sl-icon">
																					<svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
																						<path d="M64 127.5C17.1 79.9 3.9 62.3 1 44.4c-3.5-22 12.2-43.9 36.7-43.9 10.5 0 20 4.2 26.4 11.2 6.3-7 15.9-11.2 26.4-11.2 24.3 0 40.2 21.8 36.7 43.9C124.2 62 111.9 78.9 64 127.5zM37.6 13.4c-9.9 0-18.2 5.2-22.3 13.8C5 49.5 28.4 72 64 109.2c35.7-37.3 59-59.8 48.6-82 -4.1-8.7-12.4-13.8-22.3-13.8 -15.9 0-22.7 13-26.4 19.2C60.6 26.8 54.4 13.4 37.6 13.4z"/>
																					</svg>
																				</span>
																				<span class="sl-count">13</span>
																			</a>
																			<span class="sl-loader"></span>
																		</span>
																	</span>
																	<div class="entry-share">
																		<div class="helper">SHARE</div>
																		<span class="links"><a class="facebook-share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fazexo.com%2Fwisem%2Fcommodo-consequat%2F"><span class="share-box"><i class="fa fa-facebook"></i></span></a><a class="twitter-share" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article%3A%20Commodo%20consequat%20-%20http%3A%2F%2Fazexo.com%2Fwisem%2Fcommodo-consequat%2F"><span class="share-box"><i class="fa fa-twitter"></i></span></a><a class="pinterest-share" target="_blank" href="https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fazexo.com%2Fwisem%2Fcommodo-consequat%2F&media=http%3A%2F%2Fazexo.com%2Fwisem%2Fwp-content%2Fuploads%2F2016%2F06%2Fblog6.jpg&description=Commodo%20consequat"><span class="share-box"><i class="fa fa-pinterest"></i></span></a><a class="linkedin-share" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fazexo.com%2Fwisem%2Fcommodo-consequat%2F&title=Commodo%20consequat&source=LinkedIn"><span class="share-box"><i class="fa fa-linkedin"></i></span></a><a class="google-plus-share" target="_blank" href="https://plus.google.com/share?url=http%3A%2F%2Fazexo.com%2Fwisem%2Fcommodo-consequat%2F"><span class="share-box"><i class="fa fa-google-plus"></i></span></a><a href="http://azexo.com/wisem/commodo-consequat/#respond"><span class="share-box"><i class="fa fa-comment-o"></i></span></a></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="entry recent-post post-199 post type-post status-publish format-standard has-post-thumbnail hentry category-ullamcorper tag-libero tag-purus tag-turpis">
															<div class="entry-thumbnail">
																<a href="http://azexo.com/wisem/inventore-veritatis/">
																	<div class="image " style='background-image: url("http://azexo.com/wisem/wp-content/uploads/2016/06/photo-260x150.jpg"); height: 150px;' data-width="260" data-height="150">
																	</div>
																</a>
															</div>
															<div class="entry-data">
																<div class="entry-header">
																	<h2 class="entry-title"><a href="http://azexo.com/wisem/inventore-veritatis/" rel="bookmark">Inventore veritatis</a></h2>
																</div>
																<div class="entry-summary">Eiusmod tempor incidiunt labore velit dolore magna aliqu sed enimi&hellip;</div>
																<div class="entry-footer">
																	<span class="like">
																		<span class="sl-wrapper">
																			<a href="http://azexo.com/wisem/wp-admin/admin-ajax.php?action=process_simple_like&#038;nonce=4d729b52af&#038;post_id=199&#038;disabled=true&#038;is_comment=0" class="sl-button sl-button-199" data-nonce="4d729b52af" data-post-id="199" data-iscomment="0" title="Like">
																				<span class="sl-icon">
																					<svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
																						<path d="M64 127.5C17.1 79.9 3.9 62.3 1 44.4c-3.5-22 12.2-43.9 36.7-43.9 10.5 0 20 4.2 26.4 11.2 6.3-7 15.9-11.2 26.4-11.2 24.3 0 40.2 21.8 36.7 43.9C124.2 62 111.9 78.9 64 127.5zM37.6 13.4c-9.9 0-18.2 5.2-22.3 13.8C5 49.5 28.4 72 64 109.2c35.7-37.3 59-59.8 48.6-82 -4.1-8.7-12.4-13.8-22.3-13.8 -15.9 0-22.7 13-26.4 19.2C60.6 26.8 54.4 13.4 37.6 13.4z"/>
																					</svg>
																				</span>
																				<span class="sl-count">9</span>
																			</a>
																			<span class="sl-loader"></span>
																		</span>
																	</span>
																	<div class="entry-share">
																		<div class="helper">SHARE</div>
																		<span class="links"><a class="facebook-share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fazexo.com%2Fwisem%2Finventore-veritatis%2F"><span class="share-box"><i class="fa fa-facebook"></i></span></a><a class="twitter-share" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article%3A%20Inventore%20veritatis%20-%20http%3A%2F%2Fazexo.com%2Fwisem%2Finventore-veritatis%2F"><span class="share-box"><i class="fa fa-twitter"></i></span></a><a class="pinterest-share" target="_blank" href="https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fazexo.com%2Fwisem%2Finventore-veritatis%2F&media=http%3A%2F%2Fazexo.com%2Fwisem%2Fwp-content%2Fuploads%2F2016%2F06%2Fphoto.jpg&description=Inventore%20veritatis"><span class="share-box"><i class="fa fa-pinterest"></i></span></a><a class="linkedin-share" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fazexo.com%2Fwisem%2Finventore-veritatis%2F&title=Inventore%20veritatis&source=LinkedIn"><span class="share-box"><i class="fa fa-linkedin"></i></span></a><a class="google-plus-share" target="_blank" href="https://plus.google.com/share?url=http%3A%2F%2Fazexo.com%2Fwisem%2Finventore-veritatis%2F"><span class="share-box"><i class="fa fa-google-plus"></i></span></a><a href="http://azexo.com/wisem/inventore-veritatis/#respond"><span class="share-box"><i class="fa fa-comment-o"></i></span></a></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="entry recent-post post-192 post type-post status-publish format-standard has-post-thumbnail hentry category-sed-rutrum tag-bibendum tag-diam-tortor tag-turpis">
															<div class="entry-thumbnail">
																<a href="http://azexo.com/wisem/eiusmod-tempor-incidiunt-2/">
																	<div class="image " style='background-image: url("http://azexo.com/wisem/wp-content/uploads/2016/06/blog2-260x150.jpg"); height: 150px;' data-width="260" data-height="150">
																	</div>
																</a>
															</div>
															<div class="entry-data">
																<div class="entry-header">
																	<h2 class="entry-title"><a href="http://azexo.com/wisem/eiusmod-tempor-incidiunt-2/" rel="bookmark">Eiusmod tempor incidiunt</a></h2>
																</div>
																<div class="entry-summary">Eiusmod tempor incidiunt labore velit dolore magna aliqu sed enimi&hellip;</div>
																<div class="entry-footer">
																	<span class="like">
																		<span class="sl-wrapper">
																			<a href="http://azexo.com/wisem/wp-admin/admin-ajax.php?action=process_simple_like&#038;nonce=4d729b52af&#038;post_id=192&#038;disabled=true&#038;is_comment=0" class="sl-button sl-button-192" data-nonce="4d729b52af" data-post-id="192" data-iscomment="0" title="Like">
																				<span class="sl-icon">
																					<svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
																						<path d="M64 127.5C17.1 79.9 3.9 62.3 1 44.4c-3.5-22 12.2-43.9 36.7-43.9 10.5 0 20 4.2 26.4 11.2 6.3-7 15.9-11.2 26.4-11.2 24.3 0 40.2 21.8 36.7 43.9C124.2 62 111.9 78.9 64 127.5zM37.6 13.4c-9.9 0-18.2 5.2-22.3 13.8C5 49.5 28.4 72 64 109.2c35.7-37.3 59-59.8 48.6-82 -4.1-8.7-12.4-13.8-22.3-13.8 -15.9 0-22.7 13-26.4 19.2C60.6 26.8 54.4 13.4 37.6 13.4z"/>
																					</svg>
																				</span>
																				<span class="sl-count">10</span>
																			</a>
																			<span class="sl-loader"></span>
																		</span>
																	</span>
																	<div class="entry-share">
																		<div class="helper">SHARE</div>
																		<span class="links"><a class="facebook-share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fazexo.com%2Fwisem%2Feiusmod-tempor-incidiunt-2%2F"><span class="share-box"><i class="fa fa-facebook"></i></span></a><a class="twitter-share" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article%3A%20Eiusmod%20tempor%20incidiunt%20-%20http%3A%2F%2Fazexo.com%2Fwisem%2Feiusmod-tempor-incidiunt-2%2F"><span class="share-box"><i class="fa fa-twitter"></i></span></a><a class="pinterest-share" target="_blank" href="https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fazexo.com%2Fwisem%2Feiusmod-tempor-incidiunt-2%2F&media=http%3A%2F%2Fazexo.com%2Fwisem%2Fwp-content%2Fuploads%2F2016%2F06%2Fblog2.jpg&description=Eiusmod%20tempor%20incidiunt"><span class="share-box"><i class="fa fa-pinterest"></i></span></a><a class="linkedin-share" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fazexo.com%2Fwisem%2Feiusmod-tempor-incidiunt-2%2F&title=Eiusmod%20tempor%20incidiunt&source=LinkedIn"><span class="share-box"><i class="fa fa-linkedin"></i></span></a><a class="google-plus-share" target="_blank" href="https://plus.google.com/share?url=http%3A%2F%2Fazexo.com%2Fwisem%2Feiusmod-tempor-incidiunt-2%2F"><span class="share-box"><i class="fa fa-google-plus"></i></span></a><a href="http://azexo.com/wisem/eiusmod-tempor-incidiunt-2/#respond"><span class="share-box"><i class="fa fa-comment-o"></i></span></a></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="tag_cloud-2" class="widget-4 widget-last widget-even widget widget_tag_cloud">
							<div class="widget-title">
								<h3>Latest tags</h3>
							</div>
							<div class="tagcloud"><a href='http://azexo.com/wisem/tag/bibendum/' class='tag-link-43 tag-link-position-1' title='5 topics' style='font-size: 22pt;'>bibendum</a>
								<a href='http://azexo.com/wisem/tag/diam-tortor/' class='tag-link-44 tag-link-position-2' title='4 topics' style='font-size: 19.666666666667pt;'>diam tortor</a>
								<a href='http://azexo.com/wisem/tag/libero/' class='tag-link-40 tag-link-position-3' title='4 topics' style='font-size: 19.666666666667pt;'>libero</a>
								<a href='http://azexo.com/wisem/tag/puru/' class='tag-link-45 tag-link-position-4' title='1 topic' style='font-size: 8pt;'>puru</a>
								<a href='http://azexo.com/wisem/tag/purus/' class='tag-link-41 tag-link-position-5' title='2 topics' style='font-size: 13.25pt;'>purus</a>
								<a href='http://azexo.com/wisem/tag/turpis/' class='tag-link-42 tag-link-position-6' title='4 topics' style='font-size: 19.666666666667pt;'>turpis</a>
							</div>
						</div>
					</div>
					<!-- .widget-area -->
				</div>
				<!-- .sidebar-inner -->
			</div>
			<!-- #tertiary -->			
		</div>
		<?php } else {
			echo $content;
		}?>
	<?php }?>

<?php $this->endContent(); ?>