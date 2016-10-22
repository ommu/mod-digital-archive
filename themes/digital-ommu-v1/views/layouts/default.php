<?php
if(isset($_GET['protocol']) && $_GET['protocol'] == 'script') {
	echo $cs=Yii::app()->getClientScript()->getScripts();
	
} else {
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.public.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);

	/**
	 * = Global condition
	 ** Construction condition
	 */
	$setting = OmmuSettings::model()->findByPk(1,array(
		'select' => 'online, site_type, site_url, site_title, construction_date, signup_inviteonly, general_include',
	));
	$construction = (($setting->online == 0 && date('Y-m-d', strtotime($setting->construction_date)) > date('Y-m-d')) && (Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && in_array(!Yii::app()->user->level, array(1,2))))) ? 1 : 0 ;

	/**
	 * = Dialog Condition
	 * $construction = 1 (construction active)
	 */
	if($construction == 1)
		$dialogWidth = !empty($this->dialogWidth) ? ($this->dialogFixed == false ? $this->dialogWidth.'px' : '600px') : '900px';
	else {
		if($this->dialogDetail == true)
			$dialogWidth = !empty($this->dialogWidth) ? ($this->dialogFixed == false ? $this->dialogWidth.'px' : '600px') : '700px';
		else
			$dialogWidth = '';
	}
	$display = ($this->dialogDetail == true && !Yii::app()->request->isAjaxRequest) ? 'style="display: block;"' : '';
	
	/**
	 * = pushState condition
	 */
	$title = CHtml::encode($this->pageTitle).' | '.$setting->site_title;
	$description = $this->pageDescription;
	$keywords = $this->pageMeta;
	$urlAddress = Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->request->requestUri;
	$apps = $this->dialogDetail == true ? ($this->dialogFixed == false ? 'apps' : 'module') : '';

	if(Yii::app()->request->isAjaxRequest && !isset($_GET['ajax'])) {
		if(Yii::app()->session['theme_active'] != Yii::app()->theme->name) {
			$return = array(
				'redirect' => $urlAddress,		
			);

		} else {
			$page = $this->contentOther == true ? 1 : 0;
			$dialog = $this->dialogDetail == true ? (empty($this->dialogWidth) ? 1 : 2) : 0;		// 0 = static, 1 = dialog, 2 = notifier
			$header = /* $this->widget('SidebarAccountMenu', array(), true) */'';
			
			if($this->contentOther == true) {
				$render = array(
					'content' => $content, 
					'other' => $this->contentAttribute,
				);
			} else
				$render = $content;
			
			$return = array(
				'partial' => 'off',
				'titledoc' => CHtml::encode($this->pageTitle),
				'title' => $title,
				'description' => $description,
				'keywords' => $keywords,
				'address' => $urlAddress,
				'dialogWidth' => $dialogWidth,			
			);
			$return['page'] = $page;
			$return['dialog'] = $dialog;
			$return['apps'] = $apps;
			$return['header'] = $this->dialogDetail != true ? $header : '';
			$return['render'] = $render;
			$return['script'] = $cs=Yii::app()->getClientScript()->getOmmuScript();
		}
		echo CJSON::encode($return);

	} else {
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile(/*azl-css*/'http://azexo.com/wisem/wp-content/plugins/az_listings/css/azl.css?ver=4.5.4');
		$cs->registerCssFile(/*azqf-css*/'http://azexo.com/wisem/wp-content/plugins/az_query_form/css/azqf.css?ver=4.5.4');
		$cs->registerCssFile(/*contact-form-7-css*/'http://azexo.com/wisem/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.5');
		$cs->registerCssFile(/*wc-bookings-styles-css*/'http://azexo.com/wisem/wp-content/plugins/woocommerce-bookings/assets/css/frontend.css?ver=1.7.5');
		$cs->registerCssFile(/*owl.carousel-css*/'http://azexo.com/wisem/wp-content/themes/wisem/css/owl.carousel.min.css?ver=4.5.4');
		$cs->registerCssFile(/*flexslider-css*/'http://azexo.com/wisem/wp-content/themes/wisem/css/flexslider.css?ver=4.5.4');
		$cs->registerCssFile(/*magnific-popup-css*/'http://azexo.com/wisem/wp-content/themes/wisem/css/magnific-popup.css?ver=4.5.4');
		$cs->registerCssFile(/*js_composer_front-css*/'http://azexo.com/wisem/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=4.12');
		$cs->registerCssFile(/*animate-css-css*/'http://azexo.com/wisem/wp-content/themes/wisem/css/animate.css/animate.min.css?ver=4.5.4');
		$cs->registerCssFile(/*font-awesome-css*/'http://azexo.com/wisem/wp-content/plugins/js_composer/assets/lib/bower/font-awesome/css/font-awesome.min.css?ver=4.12');
		$cs->registerCssFile(/*themify-icons-css*/'http://azexo.com/wisem/wp-content/themes/wisem/css/themify-icons.css?ver=4.5.4');
		$cs->registerCssFile(/*azexo-css*/'http://azexo.com/wisem/wp-content/uploads/wp-less/wisem/less/wisem/skin-33cd9ae913.css');
		$cs->registerCssFile(/*azexo-style-css*/'http://azexo.com/wisem/wp-content/themes/wisem/style.css?ver=4.5.4');
		$cs->registerCssFile(/*select2-css*/'http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/css/select2.css?ver=4.5.4');
		$cs->registerCssFile(/*vc_linecons-css*/'http://azexo.com/wisem/wp-content/plugins/js_composer/assets/css/lib/vc-linecons/vc_linecons_icons.min.css?ver=4.12');		
		//$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/form.css');
		//$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/typography.css');
		//$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/layout.css');
		//$cs->registerCssFile(Yii::app()->request->baseUrl.'/externals/content.css');
		//$cs->registerCoreScript('jquery', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/jquery/jquery.js?ver=1.12.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=2.6.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js?ver=4.12', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/azexo_vc_elements/js/azexo_vc.js?ver=4.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.5', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=2.6.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min.js?ver=1.4.1', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=2.6.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/fontend.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/hello.all.min.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/jquery.sticky-kit.min.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/imagesloaded.pkgd.min.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/background-check.min.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/jquery.fitvids.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/jquery.countdown.min.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/select2/select2.min.js?ver=3.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/woocommerce.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/framework/post-like-system/js/simple-likes-public.js?ver=0.5', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/wp-embed.min.js?ver=4.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=4.12', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/zxcvbn-async.min.js?ver=1.0', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-admin/js/password-strength-meter.min.js?ver=4.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/woocommerce/assets/js/frontend/password-strength-meter.min.js?ver=2.6.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/az_query_form/js/azqf.js?ver=4.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://maps.google.com/maps/api/js?sensor=false&#038;libraries=places&#038;key=AIzaSyBxfncg-b5W3Sd9VdRCvtmS3VeQcDAb05g&#038;ver=4.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/jquery/ui/widget.min.js?ver=1.11.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/jquery/ui/mouse.min.js?ver=1.11.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-includes/js/jquery/ui/slider.min.js?ver=1.11.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/themes/wisem/js/owl.carousel.min.js?ver=1.21', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/js_composer/assets/lib/waypoints/waypoints.min.js?ver=4.12', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/az_listings/js/mustache.js?ver=4.5.4', CClientScript::POS_END);
		$cs->registerScriptFile('http://azexo.com/wisem/wp-content/plugins/az_listings/js/azl.js?ver=4.5.4', CClientScript::POS_END);
$js=<<<EOP
	var _wpcf7 = {"loaderUrl":"http:\/\/azexo.com\/wisem\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}},"sending":"Sending ...","cached":"1"};
EOP;
		$cs->registerScript('type', $js, CClientScript::POS_END);
		Yii::app()->clientScript->scriptMap=array(
				'jquery.js'=>false,
		);		
		
		//Javascript Attribute
		$jsAttribute = array(
			'baseUrl'=>BASEURL,
			'lastTitle'=>$title,
			'lastDescription'=>$description,
			'lastKeywords'=>$keywords,
			'lastUrl'=>$urlAddress,
			'dialogConstruction'=>$construction == 1 ? 1 : 0,
			'dialogGroundUrl'=>$this->dialogDetail == true ? ($this->dialogGroundUrl != '' ? $this->dialogGroundUrl : '') : '',
		);
		if($this->contentOther == true)
			$jsAttribute['contentOther'] = $this->contentAttribute;
	?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8" />
  <title><?php echo $title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Ommu Platform (support@ommu.co)" />
  <script type="text/javascript">
	var globals = '<?php echo CJSON::encode($jsAttribute);?>';
  </script>
  <?php echo $setting->general_include != '' ? $setting->general_include : ''?>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.ico" />
  <style type="text/css"></style>
	<style id='azexo-style-inline-css' type='text/css'>
		body.woocommerce .middle-header-background{
		display: none;
		}
		.vc_custom_1467009171678{padding-top: 10px !important;padding-bottom: 10px !important;background-color: #eeeeee !important;}.vc_custom_1467268487370{background: #333333 url(http://azexo.com/wisem/wp-content/uploads/2016/06/bar.jpg?id=50) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1467118629943{padding-top: 80px !important;padding-bottom: 40px !important;background: #111111 url(http://azexo.com/wisem/wp-content/uploads/2016/06/footer.jpg?id=57) !important;}.vc_custom_1464083318051{margin-top: 140px !important;}.vc_custom_1467032271820{background-image: url(http://azexo.com/wisem/wp-content/uploads/2016/06/bar.jpg?id=50) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1464783185581{margin-top: 90px !important;margin-bottom: -25px !important;}.vc_custom_1464857844272{margin-top: 100px !important;padding-top: 85px !important;padding-bottom: 85px !important;background-color: #f3f3f3 !important;}.vc_custom_1464870847699{padding-top: 100px !important;padding-bottom: 80px !important;}.vc_custom_1464871627513{padding-top: 30px !important;padding-bottom: 30px !important;background-color: #0072bc !important;}.vc_custom_1464860541557{margin-top: 25px !important;}.vc_custom_1464860624632{margin-top: 60px !important;}.vc_custom_1467189288066{margin-top: 60px !important;}.vc_custom_1467120273284{background-image: url(http://azexo.com/wisem/wp-content/uploads/2016/06/R6HoKpSpeow.jpg?id=233) !important;}.vc_custom_1466578039473{padding-top: 85px !important;padding-bottom: 85px !important;background-color: #f7f7f7 !important;}.vc_custom_1473407426175{margin-top: 50px !important;}.vc_custom_1471866640392{padding-top: 0px !important;padding-bottom: 0px !important;background-image: url(http://azexo.com/wisem/wp-content/uploads/2016/06/bar.jpg?id=50) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1453640526696{margin-bottom: 0px !important;}.vc_custom_1469112450505{margin-bottom: 65px !important;}.vc_custom_1472028309905{margin-bottom: 65px !important;}.vc_custom_1471872882797{margin-top: 60px !important;}
	</style>
	<style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1467121864630{padding-top: 75px !important;padding-bottom: 75px !important;}.vc_custom_1466065493827{padding-top: 25px !important;padding-bottom: 25px !important;background-color: #333333 !important;}.vc_custom_1466150008767{padding-top: 85px !important;padding-bottom: 85px !important;}.vc_custom_1466578146547{padding-top: 85px !important;padding-bottom: 85px !important;background-color: #f7f7f7 !important;}.vc_custom_1466407836563{padding-top: 85px !important;padding-bottom: 65px !important;background-color: #f7f7f7 !important;}.vc_custom_1466429663256{padding-top: 85px !important;padding-bottom: 85px !important;}.vc_custom_1466672859262{background-image: url(http://azexo.com/wisem/wp-content/uploads/2016/06/services.jpg?id=44) !important;}.vc_custom_1466505975508{padding-top: 180px !important;padding-bottom: 100px !important;}.vc_custom_1466065337666{margin-top: 50px !important;}.vc_custom_1466168053738{margin-top: 50px !important;}.vc_custom_1467116773824{margin-top: 50px !important;}</style>
	<noscript>
		<style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style>
	</noscript>	
 </head>
 <body <?php echo $this->dialogDetail == true ? 'style="overflow-y: hidden;"' : '';?> class="<?php echo $module == null && $currentAction == 'site/index' ? 'home page page-id-28 page-template-default white wpb-js-composer js-comp-ver-4.12 vc_responsive' : 'blog wpb-js-composer js-comp-ver-4.12 vc_responsive';?>"> 
 
	<div id="preloader">
		<div id="status"></div>
	</div>
				
	<header id="masthead" class="site-header clearfix">
		<?php /*
		<div id="secondary" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="vc_widget-2" class="widget-1 widget-first widget-last widget-odd widget widget_vc_widget">
						<div class="scoped-style">
							<div class="vc_row wpb_row vc_row-fluid top-submenu vc_custom_1467009171678">
								<div class="row">
									<div class="h-padding-0 wpb_column vc_column_container vc_col-sm-12">
										<div class="wpb_wrapper">
											<div class="vc_row wpb_row vc_inner vc_row-fluid container">
												<div class="row">
													<div class="wpb_column vc_column_container vc_col-sm-6">
														<div class="wpb_wrapper">
															<div class="azexo_html">Welcome to the Wisem listings</div>
														</div>
													</div>
													<div class="wpb_column vc_column_container vc_col-sm-6">
														<div class="wpb_wrapper">
															<div class="template-part header-my-account">
																<div class="header-my-account ">
																	<div class="dropdown">
																		<input id="login-register-toggle" type="checkbox" style="position: absolute; clip: rect(0, 0, 0, 0);">
																		<div class="link">
																			<a href="http://azexo.com/wisem/my-account/">
																			<span>Login/Register</span>
																			</a>            
																			<label for="login-register-toggle"></label>
																		</div>
																		<div class="form">
																			<label for="login-register-toggle"></label>
																			<input id="register-toggle" type="checkbox" style="position: absolute; clip: rect(0, 0, 0, 0);">
																			<div></div>
																			<label for="register-toggle">
																			<span class="login">Already have an account?</span>
																			<span class="register">Don&#039;t have an account?</span>
																			</label>
																			<div class="col2-set" id="customer_login">
																				<div class="col-1">
																					<h2>Login</h2>
																					<form method="post" class="login">
																						<p class="form-row form-row-wide">
																							<label for="username">Username or email address <span class="required">*</span></label>
																							<input type="text" class="input-text" name="username" id="username" value="" />
																						</p>
																						<p class="form-row form-row-wide">
																							<label for="password">Password <span class="required">*</span></label>
																							<input class="input-text" type="password" name="password" id="password" />
																						</p>
																						<p class="form-row">
																							<input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="8eab89b2a6" /><input type="hidden" name="_wp_http_referer" value="/wisem/" />                <input type="submit" class="button" name="login" value="Login" />
																							<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
																							<label for="rememberme" class="inline">
																							Remember me                </label>
																						</p>
																						<p class="lost_password">
																							<a href="http://azexo.com/wisem/my-account/lost-password/">Lost your password?</a>
																						</p>
																					</form>
																				</div>
																				<div class="col-2">
																					<h2>Register</h2>
																					<form method="post" class="register">
																						<p class="form-row form-row-wide">
																							<label for="reg_email">Email address <span class="required">*</span></label>
																							<input type="email" class="input-text" name="email" id="reg_email" value="" />
																						</p>
																						<p class="form-row form-row-wide">
																							<label for="reg_password">Password <span class="required">*</span></label>
																							<input type="password" class="input-text" name="password" id="reg_password" />
																						</p>
																						<!-- Spam Trap -->
																						<div style="left: -999em; position: absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
																						<div class="clear"></div>
																						<p class="form-row">
																							<input class="input-checkbox"
																								id="apply_for_vendor"  type="checkbox"
																								name="apply_for_vendor" value="1"/>
																							<label for="apply_for_vendor"
																								class="checkbox">Apply to become a vendor? </label>
																						</p>
																						<div class="clear"></div>
																						<p class="form-row">
																							<input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="699f8ae5f5" /><input type="hidden" name="_wp_http_referer" value="/wisem/" />                    <input type="submit" class="button" name="register" value="Register" />
																						</p>
																					</form>
																				</div>
																			</div>
																			<div class="social-login">
																				<label>Connect with Social Networks:</label> <a href="/wisem/?social-login=facebook"><i class="fa fa-facebook"></i></a><a href="/wisem/?social-login=google"><i class="fa fa-google"></i></a>                
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="vc_wp_custommenu wpb_content_element">
																<div class="widget widget_nav_menu">
																	<div class="menu-top-submenu-container">
																		<ul id="menu-top-submenu" class="menu vc">
																			<li id="menu-item-37" class="menu-item menu-item-type-post_type menu-item-object-page cart menu-item-37"><a href="http://azexo.com/wisem/cart/" class="menu-link"><span class="fa fa-shopping-cart"></span><span class="count">0</span>in cart</a></li>
																		</ul>
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
					</div>
				</div>
				<!-- .widget-area -->
			</div>
			<!-- .sidebar-inner -->
		</div>
		<!-- #secondary -->
		*/?>
		<div class="header-main clearfix">
			<div class="header-parts container">
				<?php /*<a class="site-title" href="http://azexo.com/wisem/" rel="home"><img src="http://azexo.com/wisem/wp-content/uploads/2016/06/logo.png" alt="logo"></a>*/?>
				<nav class="site-navigation primary-navigation">
					<div class="menu-main-menu-container">
						<ul id="primary-menu" class="nav-menu">
							<li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-28 current_page_item menu-item-34"><a href="<?php echo Yii::app()->createUrl('site/index');?>" class="menu-link">Home</a></li>
							<li id="menu-item-32" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32"><a href="<?php echo Yii::app()->createUrl('page/view');?>" class="menu-link">Browse</a></li>
								<li id="menu-item-252" class="custom-link menu-item menu-item-type-post_type menu-item-object-page menu-item-252"><a href="http://azexo.com/wisem/submit-listing/" class="menu-link">Login</a></li>
						</ul>
					</div>
				</nav>
				<div class="mobile-menu-button"><span><i class="fa fa-bars"></i></span></div>
				<a href="#" class="trigger gmap" data-trigger-class="gmap-triggered" data-trigger-on="#masthead" data-trigger-off="#masthead"></a>
				<nav class="site-navigation mobile-menu">
					<div class="menu-main-menu-container">
						<ul id="primary-menu-mobile" class="nav-menu">
							<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-28 current_page_item menu-item-34"><a href="<?php echo Yii::app()->createUrl('site/index');?>" class="menu-link">Home</a></li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32"><a href="<?php echo Yii::app()->createUrl('page/view');?>" class="menu-link">Browse</a></li>
							<li class="custom-link menu-item menu-item-type-post_type menu-item-object-page menu-item-252"><a href="http://azexo.com/wisem/submit-listing/" class="menu-link">Login</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<?php if($module == null && $currentAction == 'site/index') {?>
		<div id="middle" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="vc_widget-3" class="widget-1 widget-first widget-last widget-odd widget widget_vc_widget">
						<div class="scoped-style">
							<div class="vc_row wpb_row vc_row-fluid colored header-widget-padding vc_custom_1467268487370">
								<div class="row">
									<div class="wpb_column vc_column_container vc_col-sm-12">
										<div class="wpb_wrapper">
											<div class="vc_row wpb_row vc_inner vc_row-fluid container">
												<div class="row">
													<div class="nofloat container-cell h-padding-0 wpb_column vc_column_container vc_col-sm-12">
														<div class="wpb_wrapper">
															<div class="azexo_html">
																<h1>trusted by millions</h1>
																<p>We help new customers & search engines to find your business online</p>
															</div>
															<div class="wpb_text_column wpb_content_element ">
																<div class="wpb_wrapper">
																	<form method="get" class="azqf-query-form search" data-name="search" action="http://azexo.com/wisem/">
																		<span class="toggle"></span>
																		<div class="wrapper">
																			<div class="s-wrapper"><input type="text" name="s" value="" placeholder="Enter keywords here..." /></div>
																			<div class="geo-location">
																				<div class="location"><input name="location" type="text" placeholder="Location" value=""><input name="latitude" type="hidden" value=""><input name="longitude" type="hidden" value=""></div>
																				<div class="radius">
																					<input id="glr-16750370" type="checkbox" name="use_radius" checked="checked"><label for="glr-16750370">Radius:<span class="radius">20</span> <span class="units">mi</span></label>
																					<div class="slider"><input name="radius" type="number" placeholder="Radius (mi)" value="20"></div>
																				</div>
																			</div>
																			<div class="taxonomy-dropdown product_cat-wrapper" data-taxonomy="product_cat">
																				<select name='product_cat' id='product_cat' class='select2' >
																					<option value=''>Category</option>
																					<option class="level-0" value="hotels-and-motels">Hotels &amp; Motels</option>
																					<option class="level-0" value="bed-and-breakfast">Bed &amp; Breakfast</option>
																					<option class="level-0" value="apartment-hotels">Apartment Hotels</option>
																					<option class="level-0" value="movie-theatres">Movie Theatres</option>
																					<option class="level-0" value="family-night-life">Family &amp; Night Life</option>
																					<option class="level-0" value="television-programs">Television Programs</option>
																					<option class="level-0" value="new-used-dealers">New &amp; Used Dealers</option>
																					<option class="level-0" value="tire-retailers">Tire Retailers</option>
																					<option class="level-0" value="parts-supplies">Parts &amp; Supplies</option>
																					<option class="level-0" value="academic-courses">Academic Courses</option>
																					<option class="level-0" value="colleges-universities">Colleges &amp; Universities</option>
																					<option class="level-0" value="elementary-high-schools">Elementary &amp; High Schools</option>
																					<option class="level-0" value="dental-care">Dental Care</option>
																					<option class="level-0" value="fitness-weight-loss">Fitness &amp; Weight Loss</option>
																					<option class="level-0" value="eye-care-eyewear">Eye Care &amp; Eyewear</option>
																					<option class="level-0" value="desserts-bakery-products">Desserts &amp; Bakery Products</option>
																					<option class="level-0" value="dairy-products">Dairy Products</option>
																					<option class="level-0" value="food-services-supplies">Food Services &amp; Supplies</option>
																				</select>
																			</div>
																			<input type="hidden" name="post_type" value="product" />
																			<div class="submit"><input type="submit" value="Search"></div>
																		</div>
																	</form>
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
				</div>
				<!-- .widget-area -->
			</div>
			<!-- .sidebar-inner -->
		</div>
		<!-- #middle -->
		
		<?php } else {?>
		<div id="middle" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="vc_widget-5" class="widget-1 widget-first widget-last widget-odd widget widget_vc_widget">
						<div class="scoped-style">
							<div class="vc_row wpb_row vc_row-fluid middle-header-background vc_custom_1467032271820">
								<div class="row">
									<div class="wpb_column vc_column_container vc_col-sm-12">
										<div class="wpb_wrapper">
											<div class="vc_row wpb_row vc_inner vc_row-fluid container">
												<div class="row">
													<div class="wpb_column vc_column_container vc_col-sm-12">
														<div class="wpb_wrapper">
															<div class="page-header">
																<h2 class="entry-title"><a href="http://azexo.com/wisem/blog/" rel="bookmark">Browse</a></h2>
															</div>
															<?php /*
															<div class="azexo-woo-breadcrumb">
																<nav class="woocommerce-breadcrumb" ><a href="http://azexo.com/wisem">Home</a> <span class="delimiter">/</span> Blog</nav>
															</div>
															*/?>
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
				<!-- .widget-area -->
			</div>
			<!-- .sidebar-inner -->
		</div>
		<!-- #middle -->		
		<?php }?>
	</header>
	<!-- #masthead -->

	<div id="main" class="site-main">
		<?php echo $content;?>
	</div>
					
	<footer id="colophon" class="site-footer clearfix">
		<div id="quaternary" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="vc_widget-7" class="widget-1 widget-first widget-last widget-odd widget widget_vc_widget">
						<div class="scoped-style">
							<div class="vc_row wpb_row vc_row-fluid footer-background vc_custom_1467118629943">
								<div class="row">
									<div class="h-padding-0 wpb_column vc_column_container vc_col-sm-12">
										<div class="wpb_wrapper">
											<div class="vc_row wpb_row vc_inner vc_row-fluid container">
												<div class="row">
													<div class="wpb_column vc_column_container vc_col-sm-4">
														<div class="wpb_wrapper">
															<div class="azexo_html">
																<h3 class="footer-title">
																	<span class="title-left">About wisem</span>
																	<span class="title-right"></span>
																</h3>
																<img src="http://azexo.com/wisem/wp-content/uploads/2016/06/logo2.png">
																<p>Integer ac lorem sit amet est rhoncus dapi bus don cad pede acus morbi elit nunc molestie at ultrices eu eleifen lorem ut dictum erat masa. Nullam tempus erat id tort In hac habitasse platea dictumst.</p>
																<a class="more-button" href="#">Read More</a>
															</div>
														</div>
													</div>
													<div class="wpb_column vc_column_container vc_col-sm-4">
														<div class="wpb_wrapper">
															<div class="azexo_html">
																<h3 class="footer-title"><span class="title-left">main categories</span><span class="title-right"></span></h3>
															</div>
															<div class="vc_wp_custommenu wpb_content_element footer-menu">
																<div class="widget widget_nav_menu">
																	<div class="menu-category-menu-container">
																		<ul id="menu-category-menu" class="menu vc">
																			<li id="menu-item-205" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-205"><a href="http://azexo.com/wisem/category/sed-rutrum/" class="menu-link">Sed rutrum</a></li>
																			<li id="menu-item-206" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-206"><a href="http://azexo.com/wisem/category/praesent-molestie/" class="menu-link">Praesent molestie</a></li>
																			<li id="menu-item-207" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-207"><a href="http://azexo.com/wisem/category/quisque-sagittis/" class="menu-link">Quisque sagittis</a></li>
																			<li id="menu-item-208" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-208"><a href="http://azexo.com/wisem/category/maecenas/" class="menu-link">Maecenas</a></li>
																			<li id="menu-item-209" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-209"><a href="http://azexo.com/wisem/category/donec-tincidunt/" class="menu-link">Donec tincidunt</a></li>
																			<li id="menu-item-210" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-210"><a href="http://azexo.com/wisem/category/ullamcorper/" class="menu-link">Ullamcorper</a></li>
																			<li id="menu-item-211" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-211"><a href="http://azexo.com/wisem/category/curabitur-lacinia/" class="menu-link">Curabitur lacinia</a></li>
																			<li id="menu-item-213" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-213"><a href="http://azexo.com/wisem/category/etiam-eget/" class="menu-link">Etiam eget</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wpb_column vc_column_container vc_col-sm-4">
														<div class="wpb_wrapper">
															<div class="azexo_html">
																<h3 class="footer-title"><span class="title-left">GET IN TOUCH</span><span class="title-right"></span></h3>
																<p>
																	<strong>WISEM DIRECTORY INC.</strong> Suite # 38, Fireworks Hill, Victoria, WA 12340
																	<a href="#" class="map-link">see on map</a>
																</p>
																<table class="footer-table">
																	<tr>
																		<td>Tele</td>
																		<td>(123) 456 7890</td>
																	</tr>
																	<tr>
																		<td>Toll Free</td>
																		<td>(1) 002 123 9876 5</td>
																	</tr>
																	<td>E-mail</td>
																	<td>support@wisemdirectory.com</td>
																	<tr>
																		<td>Fax</td>
																		<td>(123) 456 7890</td>
																	</tr>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="vc_row wpb_row vc_inner vc_row-fluid container vc_custom_1464083318051">
												<div class="row">
													<div class="wpb_column vc_column_container vc_col-sm-6">
														<div class="wpb_wrapper">
															<div class="azexo_html copyright">© 2016 <a href="http://themeforest.net/user/azexo">Azexo</a> - All Rights Reserved.</div>
														</div>
													</div>
													<div class="wpb_column vc_column_container vc_col-sm-6">
														<div class="wpb_wrapper">
															<div class="azexo_html">
																<ul class="icon-wrapper" data-cloneable>
																	<li>
																		<a href="https://www.facebook.com/" target="_blank">
																		<i class="fa fa-facebook"></i>
																		</a>
																	</li>
																	<li>
																		<a href="https://twitter.com/" target="_blank">
																		<i class="fa fa-twitter"></i>
																		</a>
																	</li>
																	<li>
																		<a href="https://linkedin.com/" target="_blank">
																		<i class="fa fa-linkedin"></i>
																		</a>
																	</li>
																	<li>
																		<a href="https://www.youtube.com" target="_blank">
																		<i class="fa fa-youtube"></i>
																		</a>
																	</li>
																	<li>
																		<a href="https://www.pinterest.com/" target="_blank">
																		<i class="fa fa-pinterest"></i>
																		</a>
																	</li>
																	<li>
																		<a href="https://dribbble.com/" target="_blank">
																		<i class="fa fa-dribbble"></i>
																		</a>
																	</li>
																	<li>
																		<a href="https://vimeo.com" target="_blank">
																		<i class="fa fa-vimeo-square"></i>
																		</a>
																	</li>
																	<li>
																		<a href="#" target="_blank">
																		<i class="fa fa-rss"></i>
																		</a>
																	</li>
																</ul>
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
				<!-- .widget-area -->
			</div>
			<!-- .sidebar-inner -->
		</div>
		<!-- #quaternary -->
	</footer>
                    	
	<?php $this->widget('FrontGoogleAnalytics'); ?>
 </body>
</html>
<?php }
}?>