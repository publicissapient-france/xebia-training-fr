<?php
/********************************************************************************
 MachForm
  
 Copyright 2007-2012 Appnitro Software. This code cannot be redistributed without
 permission from http://www.appnitro.com/
 
 More info at: http://www.appnitro.com/
 ********************************************************************************/
	
	function create_ap_forms_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."forms` (
											  `form_id` int(11) NOT NULL AUTO_INCREMENT,
											  `form_name` text,
											  `form_description` text,
											  `form_tags` varchar(255) DEFAULT NULL,
											  `form_email` text,
											  `form_redirect` text,
											  `form_redirect_enable` int(1) NOT NULL DEFAULT '0',
											  `form_success_message` text,
											  `form_password` varchar(100) DEFAULT NULL,
											  `form_unique_ip` int(1) NOT NULL DEFAULT '0',
											  `form_frame_height` int(11) DEFAULT NULL,
											  `form_has_css` int(11) NOT NULL DEFAULT '0',
											  `form_captcha` int(11) NOT NULL DEFAULT '0',
											  `form_captcha_type` char(1) NOT NULL DEFAULT 'r',
											  `form_active` int(11) NOT NULL DEFAULT '1',
											  `form_theme_id` int(11) NOT NULL DEFAULT '0',
											  `form_review` int(11) NOT NULL DEFAULT '0',
											  `form_resume_enable` int(1) NOT NULL DEFAULT '0',
											  `form_limit_enable` int(1) NOT NULL DEFAULT '0',
											  `form_limit` int(11) NOT NULL DEFAULT '0',
											  `form_label_alignment` varchar(11) NOT NULL DEFAULT 'top_label',
											  `form_language` varchar(50) DEFAULT NULL,
											  `form_page_total` int(11) NOT NULL DEFAULT '1',
											  `form_lastpage_title` varchar(255) DEFAULT NULL,
											  `form_submit_primary_text` varchar(255) NOT NULL DEFAULT 'Submit',
											  `form_submit_secondary_text` varchar(255) NOT NULL DEFAULT 'Previous',
											  `form_submit_primary_img` varchar(255) DEFAULT NULL,
											  `form_submit_secondary_img` varchar(255) DEFAULT NULL,
											  `form_submit_use_image` int(1) NOT NULL DEFAULT '0',
											  `form_review_primary_text` varchar(255) NOT NULL DEFAULT 'Submit',
											  `form_review_secondary_text` varchar(255) NOT NULL DEFAULT 'Previous',
											  `form_review_primary_img` varchar(255) DEFAULT NULL,
											  `form_review_secondary_img` varchar(255) DEFAULT NULL,
											  `form_review_use_image` int(11) NOT NULL DEFAULT '0',
											  `form_review_title` text,
											  `form_review_description` text,
											  `form_pagination_type` varchar(11) NOT NULL DEFAULT 'steps',
											  `form_schedule_enable` int(1) NOT NULL DEFAULT '0',
											  `form_schedule_start_date` date DEFAULT NULL,
											  `form_schedule_end_date` date DEFAULT NULL,
											  `form_schedule_start_hour` time DEFAULT NULL,
											  `form_schedule_end_hour` time DEFAULT NULL,
											  `esl_enable` tinyint(1) NOT NULL DEFAULT '0',
											  `esl_from_name` text,
											  `esl_from_email_address` varchar(255) DEFAULT NULL,
											  `esl_subject` text,
											  `esl_content` mediumtext,
											  `esl_plain_text` int(11) NOT NULL DEFAULT '0',
											  `esr_enable` tinyint(1) NOT NULL DEFAULT '0',
											  `esr_email_address` text,
											  `esr_from_name` text,
											  `esr_from_email_address` varchar(255) DEFAULT NULL,
											  `esr_subject` text,
											  `esr_content` mediumtext,
											  `esr_plain_text` int(11) NOT NULL DEFAULT '0',
											  `payment_enable_merchant` int(1) NOT NULL DEFAULT '-1',
											  `payment_merchant_type` varchar(25) NOT NULL DEFAULT 'paypal_standard',
											  `payment_paypal_email` varchar(255) DEFAULT NULL,
											  `payment_paypal_language` varchar(5) NOT NULL DEFAULT 'US',
											  `payment_currency` varchar(5) NOT NULL DEFAULT 'USD',
											  `payment_show_total` int(1) NOT NULL DEFAULT '0',
											  `payment_total_location` varchar(11) NOT NULL DEFAULT 'top',
											  `payment_enable_recurring` int(1) NOT NULL DEFAULT '0',
											  `payment_recurring_cycle` int(11) NOT NULL DEFAULT '1',
											  `payment_recurring_unit` varchar(5) NOT NULL DEFAULT 'month',
											  `payment_price_type` varchar(11) NOT NULL DEFAULT 'fixed',
											  `payment_price_amount` decimal(62,2) NOT NULL DEFAULT '0.00',
											  `payment_price_name` varchar(255) DEFAULT NULL,
											  PRIMARY KEY (`form_id`),
											  KEY `form_tags` (`form_tags`)
											) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}
	
	function create_ap_column_preferences_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."column_preferences` (
																		  `acp_id` int(11) NOT NULL AUTO_INCREMENT,
																		  `form_id` int(11) DEFAULT NULL,
																		  `user_id` int(11) NOT NULL DEFAULT '1',
																		  `element_name` varchar(255) NOT NULL DEFAULT '',
																		  `position` int(11) NOT NULL DEFAULT '0',
																		  PRIMARY KEY (`acp_id`),
																		  KEY `acp_position` (`form_id`,`position`)
																		) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_element_options_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."element_options` (
														  `aeo_id` int(11) NOT NULL AUTO_INCREMENT,
														  `form_id` int(11) NOT NULL DEFAULT '0',
														  `element_id` int(11) NOT NULL DEFAULT '0',
														  `option_id` int(11) NOT NULL DEFAULT '0',
														  `position` int(11) NOT NULL DEFAULT '0',
														  `option` text,
														  `option_is_default` int(11) NOT NULL DEFAULT '0',
														  `live` int(11) NOT NULL DEFAULT '1',
														  PRIMARY KEY (`aeo_id`),
														  KEY `form_id` (`form_id`),
														  KEY `element_id` (`element_id`)
														) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_element_prices_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."element_prices` (
														  `aep_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
														  `form_id` int(11) NOT NULL,
														  `element_id` int(11) NOT NULL,
														  `option_id` int(11) NOT NULL DEFAULT '0',
														  `price` decimal(62,2) NOT NULL DEFAULT '0.00',
														  PRIMARY KEY (`aep_id`),
														  KEY `form_id` (`form_id`),
														  KEY `element_id` (`element_id`)
														) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_form_elements_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_elements` (
													  `form_id` int(11) NOT NULL DEFAULT '0',
													  `element_id` int(11) NOT NULL DEFAULT '0',
													  `element_title` text,
													  `element_guidelines` text,
													  `element_size` varchar(6) NOT NULL DEFAULT 'medium',
													  `element_is_required` int(11) NOT NULL DEFAULT '0',
													  `element_is_unique` int(11) NOT NULL DEFAULT '0',
													  `element_is_private` int(11) NOT NULL DEFAULT '0',
													  `element_type` varchar(50) DEFAULT NULL,
													  `element_position` int(11) NOT NULL DEFAULT '0',
													  `element_default_value` text,
													  `element_constraint` varchar(255) DEFAULT NULL,
													  `element_total_child` int(11) NOT NULL DEFAULT '0',
													  `element_css_class` varchar(255) NOT NULL DEFAULT '',
													  `element_range_min` bigint(11) unsigned NOT NULL DEFAULT '0',
													  `element_range_max` bigint(11) unsigned NOT NULL DEFAULT '0',
													  `element_range_limit_by` char(1) NOT NULL,
													  `element_status` int(1) NOT NULL DEFAULT '2',
													  `element_choice_columns` int(1) NOT NULL DEFAULT '1',
													  `element_choice_has_other` int(1) NOT NULL DEFAULT '0',
													  `element_choice_other_label` text,
													  `element_time_showsecond` int(11) NOT NULL DEFAULT '0',
													  `element_time_24hour` int(11) NOT NULL DEFAULT '0',
													  `element_address_hideline2` int(11) NOT NULL DEFAULT '0',
													  `element_address_us_only` int(11) NOT NULL DEFAULT '0',
													  `element_date_enable_range` int(1) NOT NULL DEFAULT '0',
													  `element_date_range_min` date DEFAULT NULL,
													  `element_date_range_max` date DEFAULT NULL,
													  `element_date_enable_selection_limit` int(1) NOT NULL DEFAULT '0',
													  `element_date_selection_max` int(11) NOT NULL DEFAULT '1',
													  `element_date_past_future` char(1) NOT NULL DEFAULT 'p',
													  `element_date_disable_past_future` int(1) NOT NULL DEFAULT '0',
													  `element_date_disable_weekend` int(1) NOT NULL DEFAULT '0',
													  `element_date_disable_specific` int(1) NOT NULL DEFAULT '0',
													  `element_date_disabled_list` text CHARACTER SET utf8 COLLATE utf8_bin,
													  `element_file_enable_type_limit` int(1) NOT NULL DEFAULT '1',
													  `element_file_block_or_allow` char(1) NOT NULL DEFAULT 'b',
													  `element_file_type_list` varchar(255) DEFAULT NULL,
													  `element_file_as_attachment` int(1) NOT NULL DEFAULT '0',
													  `element_file_enable_advance` int(1) NOT NULL DEFAULT '0',
													  `element_file_auto_upload` int(1) NOT NULL DEFAULT '0',
													  `element_file_enable_multi_upload` int(1) NOT NULL DEFAULT '0',
													  `element_file_max_selection` int(11) NOT NULL DEFAULT '5',
													  `element_file_enable_size_limit` int(1) NOT NULL DEFAULT '0',
													  `element_file_size_max` int(11) DEFAULT NULL,
													  `element_matrix_allow_multiselect` int(1) NOT NULL DEFAULT '0',
													  `element_matrix_parent_id` int(11) NOT NULL DEFAULT '0',
													  `element_section_display_in_email` int(1) NOT NULL DEFAULT '0',
													  `element_section_enable_scroll` int(1) NOT NULL DEFAULT '0',
													  `element_submit_use_image` int(1) NOT NULL DEFAULT '0',
													  `element_submit_primary_text` varchar(255) NOT NULL DEFAULT 'Continue',
													  `element_submit_secondary_text` varchar(255) NOT NULL DEFAULT 'Previous',
													  `element_submit_primary_img` varchar(255) DEFAULT NULL,
													  `element_submit_secondary_img` varchar(255) DEFAULT NULL,
													  `element_page_title` varchar(255) DEFAULT NULL,
													  `element_page_number` int(11) NOT NULL DEFAULT '1',
													  PRIMARY KEY (`form_id`,`element_id`)
													) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_form_filters_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_filters` (
													  `aff_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
													  `form_id` int(11) NOT NULL,
													  `user_id` int(11) NOT NULL DEFAULT '1',
													  `element_name` varchar(50) NOT NULL DEFAULT '',
													  `filter_condition` varchar(15) NOT NULL DEFAULT 'is',
													  `filter_keyword` varchar(255) NOT NULL DEFAULT '',
													  PRIMARY KEY (`aff_id`),
													  KEY `form_id` (`form_id`)
													) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_form_themes_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_themes` (
												  `theme_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
												  `user_id` int(11) NOT NULL DEFAULT '1',
												  `status` int(1) DEFAULT '1',
												  `theme_has_css` int(1) NOT NULL DEFAULT '0',
												  `theme_name` varchar(255) DEFAULT '',
												  `theme_built_in` int(1) NOT NULL DEFAULT '0',
												  `theme_is_private` int(11) NOT NULL DEFAULT '1',
												  `logo_type` varchar(11) NOT NULL DEFAULT 'default' COMMENT 'default,custom,disabled',
												  `logo_custom_image` text,
												  `logo_custom_height` int(11) NOT NULL DEFAULT '40',
												  `logo_default_image` varchar(50) DEFAULT '',
												  `logo_default_repeat` int(1) NOT NULL DEFAULT '0',
												  `wallpaper_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
												  `wallpaper_bg_color` varchar(11) DEFAULT '',
												  `wallpaper_bg_pattern` varchar(50) DEFAULT '',
												  `wallpaper_bg_custom` text,
												  `header_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
												  `header_bg_color` varchar(11) DEFAULT '',
												  `header_bg_pattern` varchar(50) DEFAULT '',
												  `header_bg_custom` text,
												  `form_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
												  `form_bg_color` varchar(11) DEFAULT '',
												  `form_bg_pattern` varchar(50) DEFAULT '',
												  `form_bg_custom` text,
												  `highlight_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
												  `highlight_bg_color` varchar(11) DEFAULT '',
												  `highlight_bg_pattern` varchar(50) DEFAULT '',
												  `highlight_bg_custom` text,
												  `guidelines_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
												  `guidelines_bg_color` varchar(11) DEFAULT '',
												  `guidelines_bg_pattern` varchar(50) DEFAULT '',
												  `guidelines_bg_custom` text,
												  `field_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
												  `field_bg_color` varchar(11) DEFAULT '',
												  `field_bg_pattern` varchar(50) DEFAULT '',
												  `field_bg_custom` text,
												  `form_title_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `form_title_font_weight` int(11) NOT NULL DEFAULT '400',
												  `form_title_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `form_title_font_size` varchar(11) DEFAULT '',
												  `form_title_font_color` varchar(11) DEFAULT '',
												  `form_desc_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `form_desc_font_weight` int(11) NOT NULL DEFAULT '400',
												  `form_desc_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `form_desc_font_size` varchar(11) DEFAULT '',
												  `form_desc_font_color` varchar(11) DEFAULT '',
												  `field_title_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `field_title_font_weight` int(11) NOT NULL DEFAULT '400',
												  `field_title_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `field_title_font_size` varchar(11) DEFAULT '',
												  `field_title_font_color` varchar(11) DEFAULT '',
												  `guidelines_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `guidelines_font_weight` int(11) NOT NULL DEFAULT '400',
												  `guidelines_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `guidelines_font_size` varchar(11) DEFAULT '',
												  `guidelines_font_color` varchar(11) DEFAULT '',
												  `section_title_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `section_title_font_weight` int(11) NOT NULL DEFAULT '400',
												  `section_title_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `section_title_font_size` varchar(11) DEFAULT '',
												  `section_title_font_color` varchar(11) DEFAULT '',
												  `section_desc_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `section_desc_font_weight` int(11) NOT NULL DEFAULT '400',
												  `section_desc_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `section_desc_font_size` varchar(11) DEFAULT '',
												  `section_desc_font_color` varchar(11) DEFAULT '',
												  `field_text_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
												  `field_text_font_weight` int(11) NOT NULL DEFAULT '400',
												  `field_text_font_style` varchar(25) NOT NULL DEFAULT 'normal',
												  `field_text_font_size` varchar(11) DEFAULT '',
												  `field_text_font_color` varchar(11) DEFAULT '',
												  `border_form_width` int(11) NOT NULL DEFAULT '1',
												  `border_form_style` varchar(11) NOT NULL DEFAULT 'solid',
												  `border_form_color` varchar(11) DEFAULT '',
												  `border_guidelines_width` int(11) NOT NULL DEFAULT '1',
												  `border_guidelines_style` varchar(11) NOT NULL DEFAULT 'solid',
												  `border_guidelines_color` varchar(11) DEFAULT '',
												  `border_section_width` int(11) NOT NULL DEFAULT '1',
												  `border_section_style` varchar(11) NOT NULL DEFAULT 'solid',
												  `border_section_color` varchar(11) DEFAULT '',
												  `form_shadow_style` varchar(25) NOT NULL DEFAULT 'WarpShadow',
												  `form_shadow_size` varchar(11) NOT NULL DEFAULT 'large',
												  `form_shadow_brightness` varchar(11) NOT NULL DEFAULT 'normal',
												  `form_button_type` varchar(11) NOT NULL DEFAULT 'text',
												  `form_button_text` varchar(100) NOT NULL DEFAULT 'Submit',
												  `form_button_image` text,
												  `advanced_css` text,
												  PRIMARY KEY (`theme_id`),
												  KEY `theme_name` (`theme_name`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function populate_ap_form_themes_table($dbh){
		
		$query = "INSERT INTO `".MF_TABLE_PREFIX."form_themes` (`theme_id`, `user_id`, `status`, `theme_has_css`, `theme_name`, `theme_built_in`, `theme_is_private`, `logo_type`, `logo_custom_image`, `logo_custom_height`, `logo_default_image`, `logo_default_repeat`, `wallpaper_bg_type`, `wallpaper_bg_color`, `wallpaper_bg_pattern`, `wallpaper_bg_custom`, `header_bg_type`, `header_bg_color`, `header_bg_pattern`, `header_bg_custom`, `form_bg_type`, `form_bg_color`, `form_bg_pattern`, `form_bg_custom`, `highlight_bg_type`, `highlight_bg_color`, `highlight_bg_pattern`, `highlight_bg_custom`, `guidelines_bg_type`, `guidelines_bg_color`, `guidelines_bg_pattern`, `guidelines_bg_custom`, `field_bg_type`, `field_bg_color`, `field_bg_pattern`, `field_bg_custom`, `form_title_font_type`, `form_title_font_weight`, `form_title_font_style`, `form_title_font_size`, `form_title_font_color`, `form_desc_font_type`, `form_desc_font_weight`, `form_desc_font_style`, `form_desc_font_size`, `form_desc_font_color`, `field_title_font_type`, `field_title_font_weight`, `field_title_font_style`, `field_title_font_size`, `field_title_font_color`, `guidelines_font_type`, `guidelines_font_weight`, `guidelines_font_style`, `guidelines_font_size`, `guidelines_font_color`, `section_title_font_type`, `section_title_font_weight`, `section_title_font_style`, `section_title_font_size`, `section_title_font_color`, `section_desc_font_type`, `section_desc_font_weight`, `section_desc_font_style`, `section_desc_font_size`, `section_desc_font_color`, `field_text_font_type`, `field_text_font_weight`, `field_text_font_style`, `field_text_font_size`, `field_text_font_color`, `border_form_width`, `border_form_style`, `border_form_color`, `border_guidelines_width`, `border_guidelines_style`, `border_guidelines_color`, `border_section_width`, `border_section_style`, `border_section_color`, `form_shadow_style`, `form_shadow_size`, `form_shadow_brightness`, `form_button_type`, `form_button_text`, `form_button_image`, `advanced_css`)
VALUES
	(1,1,1,0,'Green Senegal',1,1,'default','http://',40,'machform.png',0,'color','#cfdfc5','','','color','#bad4a9','','','color','#ffffff','','','color','#ecf1ea','','','color','#ecf1ea','','','color','#cfdfc5','','','Philosopher',700,'normal','','#80af1b','Philosopher',400,'normal','100%','#80af1b','Philosopher',700,'normal','110%','#80af1b','Ubuntu',400,'normal','','#666666','Philosopher',700,'normal','110%','#80af1b','Philosopher',400,'normal','95%','#80af1b','Ubuntu',400,'normal','','#666666',1,'solid','#bad4a9',1,'dashed','#bad4a9',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(2,1,1,0,'Blue Bigbird',1,1,'default','http://',40,'machform.png',0,'color','#336699','','','color','#6699cc','','','color','#ffffff','','','color','#ccdced','','','color','#6699cc','','','color','#ffffff','','','Open Sans',600,'normal','','','Open Sans',400,'normal','','','Open Sans',700,'normal','100%','','Ubuntu',400,'normal','80%','#ffffff','Open Sans',600,'normal','','','Open Sans',400,'normal','95%','','Open Sans',400,'normal','','',1,'solid','#336699',1,'dotted','#6699cc',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(3,1,1,0,'Blue Pionus',1,1,'default','http://',40,'machform.png',0,'color','#556270','','','color','#6b7b8c','','','color','#ffffff','','','color','#99aec4','','','color','#6b7b8c','','','color','#ffffff','','','Istok Web',400,'normal','170%','','Maven Pro',400,'normal','100%','','Istok Web',700,'normal','100%','','Maven Pro',400,'normal','95%','#ffffff','Istok Web',400,'normal','110%','','Maven Pro',400,'normal','95%','','Maven Pro',400,'normal','','',1,'solid','#556270',1,'solid','#6b7b8c',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(4,1,1,0,'Brown Conure',1,1,'default','http://',40,'machform.png',0,'pattern','#948c75','pattern_036.gif','','color','#b3a783','','','color','#ffffff','','','color','#e0d0a2','','','color','#948c75','','','color','#f0f0d8','pattern_036.gif','','Molengo',400,'normal','170%','','Molengo',400,'normal','110%','','Molengo',400,'normal','110%','','Nobile',400,'normal','','#ececec','Molengo',400,'normal','130%','','Molengo',400,'normal','100%','','Molengo',400,'normal','110%','',1,'solid','#948c75',1,'solid','#948c75',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(5,1,1,0,'Yellow Lovebird',1,1,'default','http://',40,'machform.png',0,'color','#f0d878','','','color','#edb817','pattern_158.gif','','color','#ffffff','','','color','#f5d678','','','color','#f7c52e','','','color','#ffffff','','','Amaranth',700,'normal','170%','','Amaranth',400,'normal','100%','','Amaranth',700,'normal','100%','','Amaranth',400,'normal','','#444444','Amaranth',400,'normal','110%','','Amaranth',400,'normal','95%','','Amaranth',400,'normal','100%','',1,'solid','#f0d878',1,'solid','#f7c52e',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(6,1,1,0,'Pink Starling',1,1,'default','http://',40,'machform.png',0,'color','#ff6699','','','color','#d93280','','','color','#ffffff','','','color','#ffd0d4','','','color','#f9fad2','','','color','#ffffff','','','Josefin Sans',600,'normal','160%','','Josefin Sans',400,'normal','110%','','Josefin Sans',700,'normal','110%','','Josefin Sans',600,'normal','100%','','Josefin Sans',700,'normal','','','Josefin Sans',400,'normal','110%','','Josefin Sans',400,'normal','130%','',1,'solid','#ff6699',1,'dashed','#f56990',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(8,1,1,0,'Red Rabbit',1,1,'default','http://',40,'machform.png',0,'color','#a40802','','','color','#800e0e','','','color','#ffffff','','','color','#ffa4a0','','','color','#800e0e','','','color','#ffffff','','','Lobster',400,'normal','','#000000','Ubuntu',400,'normal','100%','#000000','Lobster',400,'normal','110%','#222222','Ubuntu',400,'normal','85%','#ffffff','Lobster',400,'normal','130%','#000000','Ubuntu',400,'normal','95%','#000000','Ubuntu',400,'normal','','#333333',1,'solid','#a40702',1,'solid','#800e0e',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(9,1,1,0,'Orange Robin',1,1,'default','http://',40,'machform.png',0,'color','#f38430','','','color','#fa6800','','','color','#ffffff','','','color','#a7dbd8','','','color','#e0e4cc','','','color','#ffffff','','','Lucida Grande',400,'normal','','#000000','Nobile',400,'normal','','#000000','Nobile',700,'normal','','#000000','Lucida Grande',400,'normal','','#444444','Nobile',700,'normal','100%','#000000','Nobile',400,'normal','','#000000','Nobile',400,'normal','95%','#333333',1,'solid','#f38430',1,'solid','#e0e4cc',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(10,1,1,0,'Orange Sunbird',1,1,'default','http://',40,'machform.png',0,'color','#d95c43','','','color','#c02942','','','color','#ffffff','','','color','#d95c43','','','color','#53777a','','','color','#ffffff','','','Lucida Grande',400,'normal','','#000000','Lucida Grande',400,'normal','','#000000','Lucida Grande',700,'normal','','#222222','Lucida Grande',400,'normal','','#ffffff','Lucida Grande',400,'normal','','#000000','Lucida Grande',400,'normal','','#000000','Lucida Grande',400,'normal','','#333333',1,'solid','#d95c43',1,'solid','#53777a',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(11,1,1,0,'Green Ringneck',1,1,'default','http://',40,'machform.png',0,'color','#0b486b','','','color','#3b8686','','','color','#ffffff','','','color','#cff09e','','','color','#79bd9a','','','color','#a8dba8','','','Delius Swash Caps',400,'normal','','#000000','Delius Swash Caps',400,'normal','100%','#000000','Delius Swash Caps',400,'normal','100%','#222222','Delius',400,'normal','85%','#ffffff','Delius Swash Caps',400,'normal','','#000000','Delius Swash Caps',400,'normal','95%','#000000','Delius',400,'normal','','#515151',1,'solid','#0b486b',1,'solid','#79bd9a',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(12,1,1,0,'Brown Finch',1,1,'default','http://',40,'machform.png',0,'color','#774f38','','','color','#e08e79','','','color','#ffffff','','','color','#ece5ce','','','color','#c5e0dc','','','color','#f9fad2','','','Arvo',700,'normal','','#000000','Arvo',400,'normal','','#000000','Arvo',700,'normal','','#222222','Arvo',400,'normal','','#444444','Arvo',400,'normal','','#000000','Arvo',400,'normal','85%','#000000','Arvo',400,'normal','','#333333',1,'solid','#774f38',1,'dashed','#e08e79',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(14,1,1,0,'Brown Macaw',1,1,'default','http://',40,'machform.png',0,'color','#413e4a','','','color','#73626e','','','pattern','#ffffff','pattern_022.gif','','color','#f0b49e','','','color','#b38184','','','color','#ffffff','','','Cabin',500,'normal','160%','#000000','Cabin',400,'normal','100%','#000000','Cabin',700,'normal','110%','#222222','Lucida Grande',400,'normal','','#ececec','Cabin',600,'normal','','#000000','Cabin',600,'normal','95%','#000000','Cabin',400,'normal','110%','#333333',1,'solid','#413e4a',1,'dotted','#ff9900',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(15,1,1,0,'Pink Thrush',1,1,'default','http://',40,'machform.png',0,'color','#ff9f9d','','','color','#ff3d7e','','','color','#ffffff','','','color','#7fc7af','','','color','#3fb8b0','','','color','#ffffff','','','Crafty Girls',400,'normal','','#000000','Crafty Girls',400,'normal','100%','#000000','Crafty Girls',400,'normal','100%','#222222','Nobile',400,'normal','80%','#ffffff','Crafty Girls',400,'normal','','#000000','Crafty Girls',400,'normal','95%','#000000','Molengo',400,'normal','110%','#333333',1,'solid','#ff9f9d',1,'solid','#3fb8b0',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(16,1,1,0,'Yellow Bulbul',1,1,'default','http://',40,'machform.png',0,'color','#f8f4d7','','','color','#f4b26c','','','color','#f4dec2','','','color','#f2b4a7','','','color','#e98976','','','color','#ffffff','','','Special Elite',400,'normal','','#000000','Special Elite',400,'normal','','#000000','Special Elite',400,'normal','95%','#222222','Cousine',400,'normal','80%','#ececec','Special Elite',400,'normal','','#000000','Special Elite',400,'normal','','#000000','Cousine',400,'normal','','#333333',1,'solid','#f8f4d7',1,'solid','#f4b26c',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(17,1,1,0,'Blue Canary',1,1,'default','http://',40,'machform.png',0,'color','#81a8b8','','','color','#a4bcc2','','','color','#ffffff','','','color','#e8f3f8','','','color','#dbe6ec','','','color','#ffffff','','','PT Sans',400,'normal','','#000000','PT Sans',400,'normal','100%','#000000','PT Sans',700,'normal','100%','#222222','PT Sans',400,'normal','','#666666','PT Sans',700,'normal','','#000000','PT Sans',400,'normal','100%','#000000','PT Sans',400,'normal','110%','#333333',1,'solid','#81a8b8',1,'dashed','#a4bcc2',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(18,1,1,0,'Red Mockingbird',1,1,'default','http://',40,'machform.png',0,'color','#6b0103','','','color','#a30005','','','color','#c21b01','','','color','#f03d02','','','color','#1c0113','','','color','#ffffff','','','Oswald',400,'normal','','#ffffff','Open Sans',400,'normal','','#ffffff','Oswald',400,'normal','95%','#ffffff','Open Sans',400,'normal','','#ececec','Oswald',400,'normal','','#ececec','Lucida Grande',400,'normal','','#ffffff','Open Sans',400,'normal','','#333333',1,'solid','#6b0103',1,'solid','#1c0113',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(13,1,1,0,'Green Sparrow',1,1,'default','http://',40,'machform.png',0,'color','#d1f2a5','','','color','#f56990','','','color','#ffffff','','','color','#ffc48c','','','color','#ffa080','','','color','#ffffff','','','Open Sans',400,'normal','','#000000','Open Sans',400,'normal','','#000000','Open Sans',700,'normal','','#222222','Ubuntu',400,'normal','85%','#f4fce8','Open Sans',600,'normal','','#000000','Open Sans',400,'normal','95%','#000000','Open Sans',400,'normal','','#333333',10,'solid','#f0fab4',1,'solid','#ffa080',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(21,1,1,0,'Purple Vanga',1,1,'default','http://',40,'machform.png',0,'color','#7b85e2','','','color','#7aa6d6','','','color','#d1e7f9','','','color','#7aa6d6','','','color','#fbfcd0','','','color','#ffffff','','','Droid Sans',400,'normal','160%','#444444','Droid Sans',400,'normal','95%','#444444','Open Sans',700,'normal','95%','#444444','Droid Sans',400,'normal','85%','#444444','Droid Sans',400,'normal','110%','#444444','Droid Sans',400,'normal','95%','#000000','Droid Sans',400,'normal','100%','#333333',0,'solid','#CCCCCC',1,'solid','#fbfcd0',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(22,1,1,0,'Purple Dove',1,1,'default','http://',40,'machform.png',0,'color','#c0addb','','','color','#a662de','','','pattern','#ffffff','pattern_044.gif','','color','#a662de','pattern_028.gif','','color','#a662de','','','color','#c0addb','','','Pacifico',400,'normal','180%','#000000','Open Sans',400,'normal','95%','#000000','Pacifico',400,'normal','95%','#222222','Open Sans',400,'normal','80%','#ececec','Pacifico',400,'normal','110%','#000000','Open Sans',400,'normal','95%','#000000','Open Sans',400,'normal','100%','#333333',0,'solid','#a662de',1,'dashed','#CCCCCC',1,'dashed','#a662de','StandShadow','large','dark','text','Submit','http://',''),
	(20,1,1,0,'Pink Flamingo',1,1,'default','http://',40,'machform.png',0,'color','#f87d7b','','','color','#5ea0a3','','','color','#ffffff','','','color','#fab97f','','','color','#dcd1b4','','','color','#ffffff','','','Lucida Grande',400,'normal','160%','#b05573','Lucida Grande',400,'normal','95%','#b05573','Lucida Grande',700,'normal','95%','#b05573','Lucida Grande',400,'normal','80%','#444444','Lucida Grande',400,'normal','110%','#b05573','Lucida Grande',400,'normal','85%','#b05573','Lucida Grande',400,'normal','100%','#333333',0,'solid','#f87d7b',1,'dotted','#fab97f',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
	(19,1,1,0,'Yellow Kiwi',1,1,'default','http://',40,'machform.png',0,'color','#ffe281','','','color','#ffbb7f','','','color','#eee9e5','','','color','#fad4b2','','','color','#ff9c97','','','color','#ffffff','','','Lucida Grande',400,'normal','160%','#000000','Lucida Grande',400,'normal','95%','#000000','Lucida Grande',700,'normal','95%','#222222','Lucida Grande',400,'normal','80%','#ffffff','Lucida Grande',400,'normal','110%','#000000','Lucida Grande',400,'normal','85%','#000000','Lucida Grande',400,'normal','100%','#333333',1,'solid','#ffe281',1,'solid','#CCCCCC',1,'dotted','#cdcdcd','WarpShadow','large','normal','text','Submit','http://','');";
			
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_fonts_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."fonts` (
											  `font_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
											  `font_origin` varchar(11) NOT NULL DEFAULT 'google',
											  `font_family` varchar(100) DEFAULT NULL,
											  `font_variants` text,
											  `font_variants_numeric` text,
											  PRIMARY KEY (`font_id`),
											  KEY `font_family` (`font_family`)
											) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function populate_ap_fonts_table($dbh){
		$query = "INSERT INTO `".MF_TABLE_PREFIX."fonts` (`font_id`, `font_origin`, `font_family`, `font_variants`, `font_variants_numeric`)
VALUES
	(1,'google','Open Sans','300,300italic,400,400italic,600,600italic,700,700italic,800,800italic','300,300-italic,400,400-italic,600,600-italic,700,700-italic,800,800-italic'),
	(2,'google','Droid Sans','regular,bold','400,700'),
	(3,'google','Oswald','regular','400'),
	(4,'google','Droid Serif','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(5,'google','Lora','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(6,'google','Yanone Kaffeesatz','200,300,400,700','200,300,400,700'),
	(7,'google','PT Sans','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(8,'google','Lobster','regular','400'),
	(9,'google','Ubuntu','300,300italic,regular,italic,500,500italic,bold,bolditalic','300,300-italic,400,400-italic,500,500-italic,700,700-italic'),
	(10,'google','Arvo','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(11,'google','Coming Soon','regular','400'),
	(12,'google','PT Sans Narrow','regular,bold','400,700'),
	(13,'google','The Girl Next Door','regular','400'),
	(14,'google','Lato','100,100italic,300,300italic,400,400italic,700,700italic,900,900italic','100,100-italic,300,300-italic,400,400-italic,700,700-italic,900,900italic'),
	(15,'google','Shadows Into Light','regular','400'),
	(16,'google','Dancing Script','regular,bold','400,700'),
	(17,'google','Marck Script','400','400'),
	(18,'google','Cabin','400,400italic,500,500italic,600,600italic,bold,bolditalic','400,400-italic,500,500-italic,600,600-italic,700,700-italic'),
	(19,'google','Calligraffitti','regular','400'),
	(20,'google','Josefin Sans','100,100italic,300,300italic,400,400italic,600,600italic,700,700italic','100,100-italic,300,300-italic,400,400-italic,600,600-italic,700,700-italic'),
	(21,'google','Nobile','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(22,'google','Crafty Girls','regular','400'),
	(23,'google','Rock Salt','regular','400'),
	(24,'google','Reenie Beanie','regular','400'),
	(25,'google','Bitter','400,400italic,700','400,400-italic,700'),
	(26,'google','Francois One','regular','400'),
	(27,'google','Raleway','100','100'),
	(28,'google','Cherry Cream Soda','regular','400'),
	(29,'google','Syncopate','regular,bold','400,700'),
	(30,'google','Tangerine','regular,bold','400,700'),
	(31,'google','Molengo','regular','400'),
	(32,'google','Play','regular,bold','400,700'),
	(33,'google','Pacifico','regular','400'),
	(34,'google','Arimo','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(35,'google','Chewy','regular','400'),
	(36,'google','Cuprum','regular','400'),
	(37,'google','Cantarell','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(38,'google','Walter Turncoat','regular','400'),
	(39,'google','Anton','regular','400'),
	(40,'google','Luckiest Guy','regular','400'),
	(41,'google','Open Sans Condensed','300,300italic','300,300-italic'),
	(42,'google','Vollkorn','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(43,'google','Josefin Slab','100,100italic,300,300italic,400,400italic,600,600italic,700,700italic','100,100-italic,300,300-italic,400,400-italic,600,600-italic,700,700-italic'),
	(44,'google','PT Serif','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(45,'google','Homemade Apple','regular','400'),
	(46,'google','Copse','regular','400'),
	(47,'google','Terminal Dosis','200,300,400,500,600,700,800','200,300,400,500,600,700,800'),
	(48,'google','Slackey','regular','400'),
	(49,'google','Kreon','300,400,700','300,400,700'),
	(50,'google','Permanent Marker','regular','400'),
	(51,'google','Crimson Text','regular,400italic,600,600italic,700,700italic','400,400-italic,600,600-italic,700,700-italic'),
	(52,'google','Maven Pro','400,500,700,900','400,500,700,900'),
	(53,'google','Droid Sans Mono','regular','400'),
	(54,'google','Varela Round','regular','400'),
	(55,'google','Philosopher','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(56,'google','News Cycle','regular','400'),
	(57,'google','Fontdiner Swanky','regular','400'),
	(58,'google','Amaranth','regular,400italic,700,700italic','400,400-italic,700,700-italic'),
	(59,'google','Covered By Your Grace','regular','400'),
	(60,'google','Marvel','400,400italic,700,700italic','400,400-italic,700,700-italic'),
	(61,'google','Actor','regular','400'),
	(62,'google','Nunito','300,400,700','300,400,700'),
	(63,'google','Paytone One','regular','400'),
	(64,'google','Ubuntu Condensed','400','400'),
	(65,'google','Gloria Hallelujah','regular','400'),
	(66,'google','Lobster Two','400,400italic,700,700italic','400,400-italic,700,700-italic'),
	(67,'google','Bevan','regular','400'),
	(68,'google','Merriweather','300,regular,700,900','300,400,700,900'),
	(69,'google','Old Standard TT','regular,italic,bold','400,400-italic,700'),
	(70,'google','Rokkitt','regular,700','400,700'),
	(71,'google','PT Sans Caption','regular,bold','400,700'),
	(72,'google','Architects Daughter','regular','400'),
	(73,'google','Abel','regular','400'),
	(74,'google','Neucha','regular','400'),
	(75,'google','Istok Web','400,400italic,700,700italic','400,400-italic,700,700-italic'),
	(76,'google','Allerta','regular','400'),
	(77,'google','Questrial','400','400'),
	(78,'google','Allerta Stencil','regular','400'),
	(79,'google','MedievalSharp','regular','400'),
	(80,'google','Indie Flower','regular','400'),
	(81,'google','Carter One','regular','400'),
	(82,'google','Cabin Sketch','regular,bold','400,700'),
	(83,'google','Cardo','regular,400italic,700','400,400-italic,700'),
	(84,'google','Schoolbell','regular','400'),
	(85,'google','Miltonian Tattoo','regular','400'),
	(86,'google','Neuton','200,300,regular,italic,700,800','200,300,400,400-italic,700,800'),
	(87,'google','Muli','300,300italic,400,400italic','300,300-italic,400,400-italic'),
	(88,'google','Tinos','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(89,'google','Puritan','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(90,'google','Merienda One','regular','400'),
	(91,'google','Crushed','regular','400'),
	(92,'google','Inconsolata','regular','400'),
	(93,'google','Gruppo','regular','400'),
	(94,'google','Goudy Bookletter 1911','regular','400'),
	(95,'google','Maiden Orange','regular','400'),
	(96,'google','Podkova','regular,700','400,700'),
	(97,'google','Rancho','400','400'),
	(98,'google','Signika','300,400,600,700','300,400,600,700'),
	(99,'google','Waiting for the Sunrise','regular','400'),
	(100,'google','Salsa','400','400'),
	(101,'google','Six Caps','regular','400'),
	(102,'google','Didact Gothic','regular','400'),
	(103,'google','Sunshiney','regular','400'),
	(104,'google','Just Another Hand','regular','400'),
	(105,'google','Orbitron','400,500,700,900','400,500,700,900'),
	(106,'google','Mountains of Christmas','regular,700','400,700'),
	(107,'google','Kranky','regular','400'),
	(108,'google','IM Fell DW Pica','regular,italic','400,400-italic'),
	(109,'google','Jura','300,400,500,600','300,400,500,600'),
	(110,'google','Unkempt','regular,700','400,700'),
	(111,'google','Volkhov','400,400italic,700,700italic','400,400-italic,700,700-italic'),
	(112,'google','Kristi','regular','400'),
	(113,'google','Pinyon Script','regular','400'),
	(114,'google','IM Fell English','regular,italic','400,400-italic'),
	(115,'google','EB Garamond','regular','400'),
	(116,'google','PT Serif Caption','regular,italic','400,400-italic'),
	(117,'google','Quattrocento Sans','regular','400'),
	(118,'google','Bentham','regular','400'),
	(119,'google','Shanti','regular','400'),
	(120,'google','Chivo','400,400italic,900,900italic','400,400-italic,900,900italic'),
	(121,'google','Metrophobic','regular','400'),
	(122,'google','Delius','400','400'),
	(123,'google','Cousine','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(124,'google','Carme','regular','400'),
	(125,'google','Changa One','regular,italic','400,400-italic'),
	(126,'google','Kameron','400,700','400,700'),
	(127,'google','Yellowtail','regular','400'),
	(128,'google','Special Elite','regular','400'),
	(129,'google','Love Ya Like A Sister','regular','400'),
	(130,'google','Comfortaa','300,400,700','300,400,700'),
	(131,'google','Bangers','regular','400'),
	(132,'google','Mako','regular','400'),
	(133,'google','Quattrocento','regular','400'),
	(134,'google','Stardos Stencil','regular,bold','400,700'),
	(135,'google','Michroma','regular','400'),
	(136,'google','Bowlby One SC','regular','400'),
	(137,'google','Leckerli One','regular','400'),
	(138,'google','Rosario','regular,italic,700,700italic','400,400-italic,700,700-italic'),
	(139,'google','Hammersmith One','regular','400'),
	(140,'google','Passion One','400,700,900','400,700,900'),
	(141,'google','Rochester','regular','400'),
	(142,'google','Allan','bold','700'),
	(143,'google','Geo','regular','400'),
	(144,'google','Varela','regular','400'),
	(145,'google','Alice','regular','400'),
	(146,'google','Sorts Mill Goudy','400,400italic','400,400-italic'),
	(147,'google','Corben','400,bold','400,700'),
	(148,'google','Coda','400,800','400,800'),
	(149,'google','Andika','regular','400'),
	(150,'google','Playfair Display','regular,400italic','400,400-italic'),
	(151,'google','Sue Ellen Francisco','regular','400'),
	(152,'google','Jockey One','400','400'),
	(153,'google','Coustard','400,900','400,900'),
	(154,'google','Patrick Hand','regular','400'),
	(155,'google','Cabin Condensed','400,500,600,700','400,500,600,700'),
	(156,'google','Redressed','regular','400'),
	(157,'google','Aclonica','regular','400'),
	(158,'google','Poly','400,400italic','400,400-italic'),
	(159,'google','Quicksand','300,400,700','300,400,700'),
	(160,'google','Sancreek','400','400'),
	(161,'google','VT323','regular','400'),
	(162,'google','Lekton','400,italic,700','400,400-italic,700'),
	(163,'google','Antic','400','400'),
	(164,'google','UnifrakturMaguntia','regular','400'),
	(165,'google','Brawler','regular','400'),
	(166,'google','Nothing You Could Do','regular','400'),
	(167,'google','IM Fell DW Pica SC','regular','400'),
	(168,'google','Coda Caption','800','800'),
	(169,'google','Satisfy','400','400'),
	(170,'google','Days One','400','400'),
	(171,'google','Anonymous Pro','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(172,'google','IM Fell English SC','regular','400'),
	(173,'google','Over the Rainbow','regular','400'),
	(174,'google','Amatic SC','400,700','400,700'),
	(175,'google','Artifika','regular','400'),
	(176,'google','Aldrich','regular','400'),
	(177,'google','La Belle Aurore','regular','400'),
	(178,'google','Nixie One','regular','400'),
	(179,'google','Spinnaker','regular','400'),
	(180,'google','Pompiere','regular','400'),
	(181,'google','Smythe','regular','400'),
	(182,'google','Delius Swash Caps','400','400'),
	(183,'google','Mate','400,400italic','400,400-italic'),
	(184,'google','Ultra','regular','400'),
	(185,'google','Sansita One','regular','400'),
	(186,'google','Damion','regular','400'),
	(187,'google','Limelight','regular','400'),
	(188,'google','Cedarville Cursive','regular','400'),
	(189,'google','IM Fell French Canon SC','regular','400'),
	(190,'google','Montez','regular','400'),
	(191,'google','Forum','regular','400'),
	(192,'google','Aladin','400','400'),
	(193,'google','Delius Unicase','400,700','400,700'),
	(194,'google','Hanuman','regular,bold','400,700'),
	(195,'google','Wire One','regular','400'),
	(196,'google','Expletus Sans','400,400italic,500,500italic,600,600italic,700,700italic','400,400-italic,500,500-italic,600,600-italic,700,700-italic'),
	(197,'google','Annie Use Your Telescope','regular','400'),
	(198,'google','Snippet','regular','400'),
	(199,'google','Just Me Again Down Here','regular','400'),
	(200,'google','Ubuntu Mono','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(201,'google','Inder','400','400'),
	(202,'google','Candal','regular','400'),
	(203,'google','Adamina','400','400'),
	(204,'google','Gentium Basic','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(205,'google','IM Fell Great Primer SC','regular','400'),
	(206,'google','IM Fell Double Pica SC','regular','400'),
	(207,'google','Black Ops One','regular','400'),
	(208,'google','Dawning of a New Day','regular','400'),
	(209,'google','Buda','300','300'),
	(210,'google','Kenia','regular','400'),
	(211,'google','Cookie','400','400'),
	(212,'google','UnifrakturCook','bold','700'),
	(213,'google','Voltaire','400','400'),
	(214,'google','Caudex','400,italic,700,700italic','400,400-italic,700,700-italic'),
	(215,'google','Rationale','regular','400'),
	(216,'google','Gentium Book Basic','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(217,'google','Nova Round','regular','400'),
	(218,'google','IM Fell Great Primer','regular,italic','400,400-italic'),
	(219,'google','Short Stack','400','400'),
	(220,'google','Federo','regular','400'),
	(221,'google','Tenor Sans','regular','400'),
	(222,'google','Julee','regular','400'),
	(223,'google','Vibur','regular','400'),
	(224,'google','Nova Slim','regular','400'),
	(225,'google','IM Fell French Canon','regular,italic','400,400-italic'),
	(226,'google','Loved by the King','regular','400'),
	(227,'google','Viga','400','400'),
	(228,'google','Gochi Hand','400','400'),
	(229,'google','Holtwood One SC','regular','400'),
	(230,'google','Zeyada','regular','400'),
	(231,'google','Contrail One','regular','400'),
	(232,'google','Vidaloka','400','400'),
	(233,'google','Nova Oval','regular','400'),
	(234,'google','Montserrat','400','400'),
	(235,'google','Meddon','regular','400'),
	(236,'google','Swanky and Moo Moo','regular','400'),
	(237,'google','Nova Script','regular','400'),
	(238,'google','Ovo','regular','400'),
	(239,'google','Irish Grover','regular','400'),
	(240,'google','League Script','400','400'),
	(241,'google','Petrona','400','400'),
	(242,'google','Yeseva One','regular','400'),
	(243,'google','Squada One','400','400'),
	(244,'google','Numans','400','400'),
	(245,'google','Prata','400','400'),
	(246,'google','Gravitas One','regular','400'),
	(247,'google','IM Fell Double Pica','regular,italic','400,400-italic'),
	(248,'google','Prociono','400','400'),
	(249,'google','Astloch','regular,bold','400,700'),
	(250,'google','Kelly Slab','regular','400'),
	(251,'google','Asset','regular','400'),
	(252,'google','Nova Flat','regular','400'),
	(253,'google','Judson','400,400italic,700','400,400-italic,700'),
	(254,'google','Lusitana','400,bold','400,700'),
	(255,'google','Radley','regular,400italic','400,400-italic'),
	(256,'google','Abril Fatface','400','400'),
	(257,'google','GFS Neohellenic','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
	(258,'google','Cambo','400','400'),
	(259,'google','Arapey','400,400italic','400,400-italic'),
	(260,'google','Tulpen One','regular','400'),
	(261,'google','Convergence','400','400'),
	(262,'google','Rammetto One','400','400'),
	(263,'google','Alike','regular','400'),
	(264,'google','Esteban','400','400'),
	(265,'google','Modern Antiqua','regular','400'),
	(266,'google','Tienne','400,700,900','400,700,900'),
	(267,'google','Megrim','regular','400'),
	(268,'google','Give You Glory','regular','400'),
	(269,'google','Monoton','400','400'),
	(270,'google','Unna','regular','400'),
	(271,'google','Mate SC','400','400'),
	(272,'google','Devonshire','400','400'),
	(273,'google','Electrolize','400','400'),
	(274,'google','Geostar','regular','400'),
	(275,'google','Andada','400','400'),
	(276,'google','Handlee','400','400'),
	(277,'google','Bowlby One','regular','400'),
	(278,'google','Wallpoet','regular','400'),
	(279,'google','Suwannaphum','regular','400'),
	(280,'google','Fanwood Text','400,400italic','400,400-italic'),
	(281,'google','Sofia','400','400'),
	(282,'google','Goblin One','regular','400'),
	(283,'google','GFS Didot','regular','400'),
	(284,'google','Miltonian','regular','400'),
	(285,'google','Fjord One','400','400'),
	(286,'google','Sniglet','800','800'),
	(287,'google','Lancelot','400','400'),
	(288,'google','Ruslan Display','regular','400'),
	(289,'google','Nova Cut','regular','400'),
	(290,'google','Bigshot One','regular','400'),
	(291,'google','Duru Sans','400','400'),
	(292,'google','Nova Mono','regular','400'),
	(293,'google','Vast Shadow','regular','400'),
	(294,'google','Dorsa','400','400'),
	(295,'google','Sigmar One','regular','400'),
	(296,'google','Nova Square','regular','400'),
	(297,'google','Alike Angular','regular','400'),
	(298,'google','Linden Hill','400,400italic','400,400-italic'),
	(299,'google','Monofett','regular','400'),
	(300,'google','Patua One','400','400'),
	(301,'google','Passero One','regular','400'),
	(302,'google','Baumans','400','400'),
	(303,'google','Atomic Age','400','400'),
	(304,'google','Bad Script','400','400'),
	(305,'google','Poller One','regular','400'),
	(306,'google','Supermercado One','400','400'),
	(307,'google','Geostar Fill','regular','400'),
	(308,'google','Smokum','regular','400'),
	(309,'google','Federant','400','400'),
	(310,'google','Engagement','400','400'),
	(311,'google','Aubrey','regular','400'),
	(312,'google','Boogaloo','regular','400'),
	(313,'google','Alfa Slab One','400','400'),
	(314,'google','Ribeye','400','400'),
	(315,'google','Signika Negative','300,400,600,700','300,400,600,700'),
	(316,'google','Quantico','400,400italic,700,700italic','400,400-italic,700,700-italic'),
	(317,'google','Ruluko','400','400'),
	(318,'google','Niconne','regular','400'),
	(319,'google','Bree Serif','400','400'),
	(320,'google','Mr Dafoe','400','400'),
	(321,'google','Crete Round','400,400italic','400,400-italic'),
	(322,'google','Marmelad','400','400'),
	(323,'google','Italianno','400','400'),
	(324,'google','Fredericka the Great','regular','400'),
	(325,'google','Trade Winds','400','400'),
	(326,'google','Magra','400,bold','400,700'),
	(327,'google','Iceland','400','400'),
	(328,'google','Stint Ultra Condensed','400','400'),
	(329,'google','Chelsea Market','400','400'),
	(330,'google','Bubblegum Sans','400','400'),
	(331,'google','Trykker','400','400'),
	(332,'google','Acme','400','400'),
	(333,'google','Overlock','400,400italic,700,700italic,900,900italic','400,400-italic,700,700-italic,900,900italic'),
	(334,'google','Armata','400','400'),
	(335,'google','Playball','400','400'),
	(336,'google','Habibi','400','400'),
	(337,'google','Oldenburg','400','400'),
	(338,'google','Galdeano','400','400'),
	(339,'google','Dynalight','400','400'),
	(340,'google','Enriqueta','400,700','400,700'),
	(341,'google','Concert One','400','400'),
	(342,'google','Overlock SC','400','400'),
	(343,'google','Noticia Text','400,400italic,700,700italic','400,400-italic,700,700-italic'),
	(344,'google','Righteous','400','400'),
	(345,'google','Cagliostro','400','400'),
	(346,'google','Arizonia','400','400'),
	(347,'google','Rouge Script','400','400'),
	(348,'google','Knewave','400','400'),
	(349,'google','Miniver','400','400'),
	(350,'google','Qwigley','400','400'),
	(351,'google','Flamenco','300,400','300,400'),
	(352,'google','Asul','400,bold','400,700'),
	(353,'google','Bokor','regular','400'),
	(354,'google','Monsieur La Doulaise','400','400'),
	(355,'google','Gudea','400,italic,bold','400,400-italic,700'),
	(356,'google','Flavors','400','400'),
	(357,'google','Ruda','400,bold,900','400,700,900'),
	(358,'google','Stoke','400','400'),
	(359,'google','Spirax','400','400'),
	(360,'google','Uncial Antiqua','400','400'),
	(361,'google','Telex','400','400'),
	(362,'google','Alex Brush','400','400'),
	(363,'google','Yesteryear','400','400'),
	(364,'google','Fresca','400','400'),
	(365,'google','Original Surfer','400','400'),
	(366,'google','Buenard','400,bold','400,700'),
	(367,'google','Medula One','400','400'),
	(368,'google','Ruthie','400','400'),
	(369,'google','Bilbo','400','400'),
	(370,'google','Basic','400','400'),
	(371,'google','Nosifer','400','400'),
	(372,'google','Fondamento','400,400italic','400,400-italic'),
	(373,'google','Mrs Sheppards','400','400'),
	(374,'google','Marko One','400','400'),
	(375,'google','Caesar Dressing','400','400'),
	(376,'google','Lemon','400','400'),
	(377,'google','Metal','regular','400'),
	(378,'google','Moulpali','regular','400'),
	(379,'google','Balthazar','400','400'),
	(380,'google','Chicle','400','400'),
	(381,'google','Spicy Rice','400','400'),
	(382,'google','Almendra','400,bold','400,700'),
	(383,'google','Frijole','400','400'),
	(384,'google','Bilbo Swash Caps','400','400'),
	(385,'google','Ribeye Marrow','400','400'),
	(386,'google','Sail','400','400'),
	(387,'google','Battambang','regular,bold','400,700'),
	(388,'google','Wellfleet','400','400'),
	(389,'google','Jim Nightshade','400','400'),
	(390,'google','Piedra','400','400'),
	(391,'google','Eater','400','400'),
	(392,'google','Belgrano','400','400'),
	(393,'google','Fugaz One','400','400'),
	(394,'google','Creepster','regular','400'),
	(395,'google','Content','regular,bold','400,700'),
	(396,'google','Homenaje','400','400'),
	(397,'google','Titan One','400','400'),
	(398,'google','Aguafina Script','400','400'),
	(399,'google','Fascinate Inline','400','400'),
	(400,'google','Dr Sugiyama','400','400'),
	(401,'google','Metamorphous','400','400'),
	(402,'google','Angkor','regular','400'),
	(403,'google','Inika','400,bold','400,700'),
	(404,'google','Ruge Boogie','400','400'),
	(405,'google','Alegreya SC','400,400italic,700,700italic,900,900italic','400,400-italic,700,700-italic,900,900italic'),
	(406,'google','Alegreya','400,400italic,700,700italic,900,900italic','400,400-italic,700,700-italic,900,900italic'),
	(407,'google','Sarina','400','400'),
	(408,'google','Lustria','400','400'),
	(409,'google','Chango','400','400'),
	(410,'google','Dangrek','regular','400'),
	(411,'google','Unlock','regular','400'),
	(412,'google','Sonsie One','400','400'),
	(413,'google','Arbutus','400','400'),
	(414,'google','Mr De Haviland','400','400'),
	(415,'google','Plaster','400','400'),
	(416,'google','Miss Fajardose','400','400'),
	(417,'google','Amethysta','400','400'),
	(418,'google','Khmer','regular','400'),
	(419,'google','Macondo Swash Caps','400','400'),
	(420,'google','Fascinate','400','400'),
	(421,'google','Trochut','400,italic,bold','400,400-italic,700'),
	(422,'google','Junge','400','400'),
	(423,'google','Herr Von Muellerhoff','400','400'),
	(424,'google','Bayon','regular','400'),
	(425,'google','Preahvihear','regular','400'),
	(426,'google','Ceviche One','400','400'),
	(427,'google','Freehand','regular','400'),
	(428,'google','Nokora','400,700','400,700'),
	(429,'google','Bonbon','400','400'),
	(430,'google','Almendra SC','400','400'),
	(431,'google','Moul','regular','400'),
	(432,'google','Sirin Stencil','400','400'),
	(433,'google','Germania One','400','400'),
	(434,'google','Montaga','400','400'),
	(435,'google','Odor Mean Chey','regular','400'),
	(436,'google','Macondo','400','400'),
	(437,'google','Chenla','regular','400'),
	(438,'google','Siemreap','regular','400'),
	(439,'google','Taprom','regular','400'),
	(440,'google','Port Lligat Sans','400','400'),
	(441,'google','Port Lligat Slab','400','400'),
	(442,'google','Koulen','regular','400'),
	(443,'google','Emblema One','400','400'),
	(444,'google','Butcherman','400','400');";
		
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_settings_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."settings` (
												  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
												  `smtp_enable` tinyint(1) NOT NULL DEFAULT '0',
												  `smtp_host` varchar(255) NOT NULL DEFAULT 'localhost',
												  `smtp_port` int(11) NOT NULL DEFAULT '25',
												  `smtp_auth` tinyint(1) NOT NULL DEFAULT '0',
												  `smtp_username` varchar(255) DEFAULT NULL,
												  `smtp_password` varchar(255) DEFAULT NULL,
												  `smtp_secure` tinyint(1) NOT NULL DEFAULT '0',
												  `upload_dir` varchar(255) NOT NULL DEFAULT './data',
												  `data_dir` varchar(255) NOT NULL DEFAULT './data',
												  `default_from_name` varchar(255) NOT NULL DEFAULT 'MachForm',
												  `default_from_email` varchar(255) DEFAULT NULL,
												  `base_url` varchar(255) DEFAULT NULL,
												  `form_manager_max_rows` int(11) DEFAULT '10',
												  `admin_image_url` varchar(255) DEFAULT NULL,
												  `disable_machform_link` int(1) DEFAULT '0',
												  `customer_id` varchar(100) DEFAULT NULL,
												  `customer_name` varchar(100) DEFAULT NULL,
												  `license_key` varchar(50) DEFAULT NULL,
												  `machform_version` varchar(10) NOT NULL DEFAULT '3.3',
												  `admin_theme` varchar(11) DEFAULT NULL,
												  PRIMARY KEY (`id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function populate_ap_settings_table($dbh,$options){
		$default_from_email = $options['default_from_email'];
		$machform_base_url  = $options['machform_base_url'];
		$new_machform_version = $options['new_machform_version'];
		$license_key = $options['license_key'];

		$query = "INSERT INTO `".MF_TABLE_PREFIX."settings` (`id`, 
																`smtp_enable`, 
																`smtp_host`, 
																`smtp_port`, 
																`smtp_auth`, 
																`smtp_username`, 
																`smtp_password`, 
																`smtp_secure`, 
																`upload_dir`, 
																`data_dir`, 
																`default_from_name`, 
																`default_from_email`, 
																`base_url`, 
																`form_manager_max_rows`, 
																`admin_image_url`, 
																`disable_machform_link`,
																`license_key`,
																`machform_version`)
														VALUES
																(1,
																 0,
																'localhost',
																25,
																0,
																'',
																'',
																0,
																'./data',
																'./data',
																'MachForm',
																'{$default_from_email}',
																'{$machform_base_url}',
																10,
																'',
																0,
																'{$license_key}',
																'{$new_machform_version}');";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_users_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."users` (
												  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
												  `user_email` varchar(255) NOT NULL DEFAULT '',
												  `user_password` varchar(255) NOT NULL DEFAULT '',
												  `user_fullname` varchar(255) NOT NULL DEFAULT '',
												  `priv_administer` tinyint(1) NOT NULL DEFAULT '0',
												  `priv_new_forms` tinyint(1) NOT NULL DEFAULT '0',
												  `priv_new_themes` tinyint(1) NOT NULL DEFAULT '0',
												  `last_login_date` datetime DEFAULT NULL,
												  `last_ip_address` varchar(15) DEFAULT '',
												  `cookie_hash` varchar(255) DEFAULT '',
												  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - deleted; 1 - active; 2 - suspended',
												  PRIMARY KEY (`user_id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function populate_ap_users_table($dbh,$options){

		$admin_username 	   = $options['admin_username'];
		$default_password_hash = $options['default_password_hash'];

		$query = "INSERT INTO `".MF_TABLE_PREFIX."users` (`user_id`, 
																`user_email`, 
																`user_password`, 
																`user_fullname`, 
																`priv_administer`, 
																`priv_new_forms`, 
																`priv_new_themes`, 
																`status`)
														VALUES
																(1,
																'{$admin_username}',
																'{$default_password_hash}',
																'Administrator',
																1,
																1,
																1,
																1);";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_permissions_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."permissions` (
												  `form_id` bigint(11) unsigned NOT NULL,
												  `user_id` int(11) unsigned NOT NULL,
												  `edit_form` tinyint(1) NOT NULL DEFAULT '0',
												  `edit_entries` tinyint(1) NOT NULL DEFAULT '0',
												  `view_entries` tinyint(1) NOT NULL DEFAULT '0',
												  PRIMARY KEY (`form_id`,`user_id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_entries_preferences_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."entries_preferences` (
												  `form_id` int(11) NOT NULL,
												  `user_id` int(11) NOT NULL,
												  `entries_sort_by` varchar(100) NOT NULL DEFAULT 'id-desc',
												  `entries_enable_filter` int(1) NOT NULL DEFAULT '0',
												  `entries_filter_type` varchar(5) NOT NULL DEFAULT 'all' COMMENT 'all or any'
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}
	
	function create_ap_form_locks_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_locks` (
												  `form_id` int(11) NOT NULL,
												  `user_id` int(11) NOT NULL,
												  `lock_date` datetime NOT NULL
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	function create_ap_form_sorts_table($dbh){
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_sorts` (
												  `user_id` int(11) NOT NULL,
												  `sort_by` varchar(25) DEFAULT '',
												  PRIMARY KEY (`user_id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			return $e->getMessage().'<br/><br/>';
		}

		return '';
	}

	//this function or any other do_delta_update_xxx functions should never call the create_xxx_tables functions
	//because those create_xxx_tables are intended for new installations and the structure might be changed over time
	function do_delta_update_2_x_to_3_0($dbh,$options=array()){

		$post_install_error = '';
		$license_key 		  = $options['license_key'];
		$new_machform_version = $options['new_machform_version'];
		$admin_username		  = $options['admin_username'];
		
		//1. Backup the old database
		if(SKIP_DB_BACKUP !== true){
			$db_backup = new DBBackup(array(
						'driver' => 'mysql',
						'host' => MF_DB_HOST,
						'user' => MF_DB_USER,
						'password' => MF_DB_PASSWORD,
						'database' => MF_DB_NAME
			));

			$backup_data = $db_backup->backup();
					
			if(!$backup['error']){
				$fpc_result = file_put_contents('./data/machform2_backup.sql.php',"<?php\n".$backup_data['msg']."\n?>");
			} else {
				echo 'An error has ocurred during database backup.';
			}

			unset($db_backup);
			unset($backup_data);
		}

		//2. Alter table ap_forms
		//add new columns
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."forms`
												  ADD COLUMN `form_tags` varchar(255) DEFAULT NULL,
												  ADD COLUMN `form_redirect_enable` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_captcha_type` char(1) NOT NULL DEFAULT 'r',
												  ADD COLUMN `form_theme_id` int(11) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_resume_enable` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_limit_enable` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_limit` int(11) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_label_alignment` varchar(11) NOT NULL DEFAULT 'top_label',
												  ADD COLUMN `form_language` varchar(50) DEFAULT NULL,
												  ADD COLUMN `form_page_total` int(11) NOT NULL DEFAULT '1',
												  ADD COLUMN `form_lastpage_title` varchar(255) DEFAULT NULL,
												  ADD COLUMN `form_submit_primary_text` varchar(255) NOT NULL DEFAULT 'Submit',
												  ADD COLUMN `form_submit_secondary_text` varchar(255) NOT NULL DEFAULT 'Previous',
												  ADD COLUMN `form_submit_primary_img` varchar(255) DEFAULT NULL,
												  ADD COLUMN `form_submit_secondary_img` varchar(255) DEFAULT NULL,
												  ADD COLUMN `form_submit_use_image` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_review_primary_text` varchar(255) NOT NULL DEFAULT 'Submit',
												  ADD COLUMN `form_review_secondary_text` varchar(255) NOT NULL DEFAULT 'Previous',
												  ADD COLUMN `form_review_primary_img` varchar(255) DEFAULT NULL,
												  ADD COLUMN `form_review_secondary_img` varchar(255) DEFAULT NULL,
												  ADD COLUMN `form_review_use_image` int(11) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_review_title` text,
												  ADD COLUMN `form_review_description` text,
												  ADD COLUMN `form_pagination_type` varchar(11) NOT NULL DEFAULT 'steps',
												  ADD COLUMN `form_schedule_enable` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `form_schedule_start_date` date DEFAULT NULL,
												  ADD COLUMN `form_schedule_end_date` date DEFAULT NULL,
												  ADD COLUMN `form_schedule_start_hour` time DEFAULT NULL,
												  ADD COLUMN `form_schedule_end_hour` time DEFAULT NULL,
												  ADD COLUMN `esl_enable` tinyint(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `esr_enable` tinyint(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `payment_enable_merchant` int(1) NOT NULL DEFAULT '-1',
												  ADD COLUMN `payment_merchant_type` varchar(25) NOT NULL DEFAULT 'paypal_standard',
												  ADD COLUMN `payment_paypal_email` varchar(255) DEFAULT NULL,
												  ADD COLUMN `payment_paypal_language` varchar(5) NOT NULL DEFAULT 'US',
												  ADD COLUMN `payment_currency` varchar(5) NOT NULL DEFAULT 'USD',
												  ADD COLUMN `payment_show_total` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `payment_total_location` varchar(11) NOT NULL DEFAULT 'top',
												  ADD COLUMN `payment_enable_recurring` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `payment_recurring_cycle` int(11) NOT NULL DEFAULT '1',
												  ADD COLUMN `payment_recurring_unit` varchar(5) NOT NULL DEFAULT 'month',
												  ADD COLUMN `payment_price_type` varchar(11) NOT NULL DEFAULT 'fixed',
												  ADD COLUMN `payment_price_amount` decimal(62,2) NOT NULL DEFAULT '0.00',
												  ADD COLUMN `payment_price_name` varchar(255) DEFAULT NULL,
												  ADD COLUMN `entries_sort_by` varchar(100) NOT NULL DEFAULT 'id-desc',
												  ADD COLUMN `entries_enable_filter` int(1) NOT NULL DEFAULT '0',
												  ADD COLUMN `entries_filter_type` varchar(5) NOT NULL DEFAULT 'all' COMMENT 'all or any';";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//3. Alter table ap_form_elements
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_elements` 
														  ADD COLUMN `element_css_class` varchar(255) NOT NULL DEFAULT '',
														  ADD COLUMN `element_range_min` bigint(11) unsigned NOT NULL DEFAULT '0',
														  ADD COLUMN `element_range_max` bigint(11) unsigned NOT NULL DEFAULT '0',
														  ADD COLUMN `element_range_limit_by` char(1) NOT NULL,
														  ADD COLUMN `element_status` int(1) NOT NULL DEFAULT '2',
														  ADD COLUMN `element_choice_columns` int(1) NOT NULL DEFAULT '1',
														  ADD COLUMN `element_choice_has_other` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_choice_other_label` text,
														  ADD COLUMN `element_time_showsecond` int(11) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_time_24hour` int(11) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_address_hideline2` int(11) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_address_us_only` int(11) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_date_enable_range` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_date_range_min` date DEFAULT NULL,
														  ADD COLUMN `element_date_range_max` date DEFAULT NULL,
														  ADD COLUMN `element_date_enable_selection_limit` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_date_selection_max` int(11) NOT NULL DEFAULT '1',
														  ADD COLUMN `element_date_past_future` char(1) NOT NULL DEFAULT 'p',
														  ADD COLUMN `element_date_disable_past_future` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_date_disable_weekend` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_date_disable_specific` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_date_disabled_list` text CHARACTER SET utf8 COLLATE utf8_bin,
														  ADD COLUMN `element_file_enable_type_limit` int(1) NOT NULL DEFAULT '1',
														  ADD COLUMN `element_file_block_or_allow` char(1) NOT NULL DEFAULT 'b',
														  ADD COLUMN `element_file_type_list` varchar(255) DEFAULT NULL,
														  ADD COLUMN `element_file_as_attachment` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_file_enable_advance` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_file_auto_upload` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_file_enable_multi_upload` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_file_max_selection` int(11) NOT NULL DEFAULT '5',
														  ADD COLUMN `element_file_enable_size_limit` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_file_size_max` int(11) DEFAULT NULL,
														  ADD COLUMN `element_matrix_allow_multiselect` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_matrix_parent_id` int(11) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_submit_use_image` int(1) NOT NULL DEFAULT '0',
														  ADD COLUMN `element_submit_primary_text` varchar(255) NOT NULL DEFAULT 'Continue',
														  ADD COLUMN `element_submit_secondary_text` varchar(255) NOT NULL DEFAULT 'Previous',
														  ADD COLUMN `element_submit_primary_img` varchar(255) DEFAULT NULL,
														  ADD COLUMN `element_submit_secondary_img` varchar(255) DEFAULT NULL,
														  ADD COLUMN `element_page_title` varchar(255) DEFAULT NULL,
														  ADD COLUMN `element_page_number` int(11) NOT NULL DEFAULT '1';";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//change the field size of element_constraint
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_elements` CHANGE COLUMN `element_constraint` `element_constraint` varchar(255) DEFAULT NULL;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//update the element_status value to 1
		$query = "UPDATE `".MF_TABLE_PREFIX."form_elements` SET `element_status`=1";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//4. Create table ap_element_prices
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."element_prices` (
													  `aep_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
													  `form_id` int(11) NOT NULL,
													  `element_id` int(11) NOT NULL,
													  `option_id` int(11) NOT NULL DEFAULT '0',
													  `price` decimal(62,2) NOT NULL DEFAULT '0.00',
													  PRIMARY KEY (`aep_id`),
													  KEY `form_id` (`form_id`),
													  KEY `element_id` (`element_id`)
													) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//5. Create table ap_fonts
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."fonts` (
												  `font_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
												  `font_origin` varchar(11) NOT NULL DEFAULT 'google',
												  `font_family` varchar(100) DEFAULT NULL,
												  `font_variants` text,
												  `font_variants_numeric` text,
												  PRIMARY KEY (`font_id`),
												  KEY `font_family` (`font_family`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//insert into ap_fonts table
		$query = "INSERT INTO `".MF_TABLE_PREFIX."fonts` (`font_id`, `font_origin`, `font_family`, `font_variants`, `font_variants_numeric`)
	VALUES
		(1,'google','Open Sans','300,300italic,400,400italic,600,600italic,700,700italic,800,800italic','300,300-italic,400,400-italic,600,600-italic,700,700-italic,800,800-italic'),
		(2,'google','Droid Sans','regular,bold','400,700'),
		(3,'google','Oswald','regular','400'),
		(4,'google','Droid Serif','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(5,'google','Lora','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(6,'google','Yanone Kaffeesatz','200,300,400,700','200,300,400,700'),
		(7,'google','PT Sans','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(8,'google','Lobster','regular','400'),
		(9,'google','Ubuntu','300,300italic,regular,italic,500,500italic,bold,bolditalic','300,300-italic,400,400-italic,500,500-italic,700,700-italic'),
		(10,'google','Arvo','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(11,'google','Coming Soon','regular','400'),
		(12,'google','PT Sans Narrow','regular,bold','400,700'),
		(13,'google','The Girl Next Door','regular','400'),
		(14,'google','Lato','100,100italic,300,300italic,400,400italic,700,700italic,900,900italic','100,100-italic,300,300-italic,400,400-italic,700,700-italic,900,900italic'),
		(15,'google','Shadows Into Light','regular','400'),
		(16,'google','Dancing Script','regular,bold','400,700'),
		(17,'google','Marck Script','400','400'),
		(18,'google','Cabin','400,400italic,500,500italic,600,600italic,bold,bolditalic','400,400-italic,500,500-italic,600,600-italic,700,700-italic'),
		(19,'google','Calligraffitti','regular','400'),
		(20,'google','Josefin Sans','100,100italic,300,300italic,400,400italic,600,600italic,700,700italic','100,100-italic,300,300-italic,400,400-italic,600,600-italic,700,700-italic'),
		(21,'google','Nobile','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(22,'google','Crafty Girls','regular','400'),
		(23,'google','Rock Salt','regular','400'),
		(24,'google','Reenie Beanie','regular','400'),
		(25,'google','Bitter','400,400italic,700','400,400-italic,700'),
		(26,'google','Francois One','regular','400'),
		(27,'google','Raleway','100','100'),
		(28,'google','Cherry Cream Soda','regular','400'),
		(29,'google','Syncopate','regular,bold','400,700'),
		(30,'google','Tangerine','regular,bold','400,700'),
		(31,'google','Molengo','regular','400'),
		(32,'google','Play','regular,bold','400,700'),
		(33,'google','Pacifico','regular','400'),
		(34,'google','Arimo','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(35,'google','Chewy','regular','400'),
		(36,'google','Cuprum','regular','400'),
		(37,'google','Cantarell','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(38,'google','Walter Turncoat','regular','400'),
		(39,'google','Anton','regular','400'),
		(40,'google','Luckiest Guy','regular','400'),
		(41,'google','Open Sans Condensed','300,300italic','300,300-italic'),
		(42,'google','Vollkorn','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(43,'google','Josefin Slab','100,100italic,300,300italic,400,400italic,600,600italic,700,700italic','100,100-italic,300,300-italic,400,400-italic,600,600-italic,700,700-italic'),
		(44,'google','PT Serif','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(45,'google','Homemade Apple','regular','400'),
		(46,'google','Copse','regular','400'),
		(47,'google','Terminal Dosis','200,300,400,500,600,700,800','200,300,400,500,600,700,800'),
		(48,'google','Slackey','regular','400'),
		(49,'google','Kreon','300,400,700','300,400,700'),
		(50,'google','Permanent Marker','regular','400'),
		(51,'google','Crimson Text','regular,400italic,600,600italic,700,700italic','400,400-italic,600,600-italic,700,700-italic'),
		(52,'google','Maven Pro','400,500,700,900','400,500,700,900'),
		(53,'google','Droid Sans Mono','regular','400'),
		(54,'google','Varela Round','regular','400'),
		(55,'google','Philosopher','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(56,'google','News Cycle','regular','400'),
		(57,'google','Fontdiner Swanky','regular','400'),
		(58,'google','Amaranth','regular,400italic,700,700italic','400,400-italic,700,700-italic'),
		(59,'google','Covered By Your Grace','regular','400'),
		(60,'google','Marvel','400,400italic,700,700italic','400,400-italic,700,700-italic'),
		(61,'google','Actor','regular','400'),
		(62,'google','Nunito','300,400,700','300,400,700'),
		(63,'google','Paytone One','regular','400'),
		(64,'google','Ubuntu Condensed','400','400'),
		(65,'google','Gloria Hallelujah','regular','400'),
		(66,'google','Lobster Two','400,400italic,700,700italic','400,400-italic,700,700-italic'),
		(67,'google','Bevan','regular','400'),
		(68,'google','Merriweather','300,regular,700,900','300,400,700,900'),
		(69,'google','Old Standard TT','regular,italic,bold','400,400-italic,700'),
		(70,'google','Rokkitt','regular,700','400,700'),
		(71,'google','PT Sans Caption','regular,bold','400,700'),
		(72,'google','Architects Daughter','regular','400'),
		(73,'google','Abel','regular','400'),
		(74,'google','Neucha','regular','400'),
		(75,'google','Istok Web','400,400italic,700,700italic','400,400-italic,700,700-italic'),
		(76,'google','Allerta','regular','400'),
		(77,'google','Questrial','400','400'),
		(78,'google','Allerta Stencil','regular','400'),
		(79,'google','MedievalSharp','regular','400'),
		(80,'google','Indie Flower','regular','400'),
		(81,'google','Carter One','regular','400'),
		(82,'google','Cabin Sketch','regular,bold','400,700'),
		(83,'google','Cardo','regular,400italic,700','400,400-italic,700'),
		(84,'google','Schoolbell','regular','400'),
		(85,'google','Miltonian Tattoo','regular','400'),
		(86,'google','Neuton','200,300,regular,italic,700,800','200,300,400,400-italic,700,800'),
		(87,'google','Muli','300,300italic,400,400italic','300,300-italic,400,400-italic'),
		(88,'google','Tinos','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(89,'google','Puritan','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(90,'google','Merienda One','regular','400'),
		(91,'google','Crushed','regular','400'),
		(92,'google','Inconsolata','regular','400'),
		(93,'google','Gruppo','regular','400'),
		(94,'google','Goudy Bookletter 1911','regular','400'),
		(95,'google','Maiden Orange','regular','400'),
		(96,'google','Podkova','regular,700','400,700'),
		(97,'google','Rancho','400','400'),
		(98,'google','Signika','300,400,600,700','300,400,600,700'),
		(99,'google','Waiting for the Sunrise','regular','400'),
		(100,'google','Salsa','400','400'),
		(101,'google','Six Caps','regular','400'),
		(102,'google','Didact Gothic','regular','400'),
		(103,'google','Sunshiney','regular','400'),
		(104,'google','Just Another Hand','regular','400'),
		(105,'google','Orbitron','400,500,700,900','400,500,700,900'),
		(106,'google','Mountains of Christmas','regular,700','400,700'),
		(107,'google','Kranky','regular','400'),
		(108,'google','IM Fell DW Pica','regular,italic','400,400-italic'),
		(109,'google','Jura','300,400,500,600','300,400,500,600'),
		(110,'google','Unkempt','regular,700','400,700'),
		(111,'google','Volkhov','400,400italic,700,700italic','400,400-italic,700,700-italic'),
		(112,'google','Kristi','regular','400'),
		(113,'google','Pinyon Script','regular','400'),
		(114,'google','IM Fell English','regular,italic','400,400-italic'),
		(115,'google','EB Garamond','regular','400'),
		(116,'google','PT Serif Caption','regular,italic','400,400-italic'),
		(117,'google','Quattrocento Sans','regular','400'),
		(118,'google','Bentham','regular','400'),
		(119,'google','Shanti','regular','400'),
		(120,'google','Chivo','400,400italic,900,900italic','400,400-italic,900,900italic'),
		(121,'google','Metrophobic','regular','400'),
		(122,'google','Delius','400','400'),
		(123,'google','Cousine','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(124,'google','Carme','regular','400'),
		(125,'google','Changa One','regular,italic','400,400-italic'),
		(126,'google','Kameron','400,700','400,700'),
		(127,'google','Yellowtail','regular','400'),
		(128,'google','Special Elite','regular','400'),
		(129,'google','Love Ya Like A Sister','regular','400'),
		(130,'google','Comfortaa','300,400,700','300,400,700'),
		(131,'google','Bangers','regular','400'),
		(132,'google','Mako','regular','400'),
		(133,'google','Quattrocento','regular','400'),
		(134,'google','Stardos Stencil','regular,bold','400,700'),
		(135,'google','Michroma','regular','400'),
		(136,'google','Bowlby One SC','regular','400'),
		(137,'google','Leckerli One','regular','400'),
		(138,'google','Rosario','regular,italic,700,700italic','400,400-italic,700,700-italic'),
		(139,'google','Hammersmith One','regular','400'),
		(140,'google','Passion One','400,700,900','400,700,900'),
		(141,'google','Rochester','regular','400'),
		(142,'google','Allan','bold','700'),
		(143,'google','Geo','regular','400'),
		(144,'google','Varela','regular','400'),
		(145,'google','Alice','regular','400'),
		(146,'google','Sorts Mill Goudy','400,400italic','400,400-italic'),
		(147,'google','Corben','400,bold','400,700'),
		(148,'google','Coda','400,800','400,800'),
		(149,'google','Andika','regular','400'),
		(150,'google','Playfair Display','regular,400italic','400,400-italic'),
		(151,'google','Sue Ellen Francisco','regular','400'),
		(152,'google','Jockey One','400','400'),
		(153,'google','Coustard','400,900','400,900'),
		(154,'google','Patrick Hand','regular','400'),
		(155,'google','Cabin Condensed','400,500,600,700','400,500,600,700'),
		(156,'google','Redressed','regular','400'),
		(157,'google','Aclonica','regular','400'),
		(158,'google','Poly','400,400italic','400,400-italic'),
		(159,'google','Quicksand','300,400,700','300,400,700'),
		(160,'google','Sancreek','400','400'),
		(161,'google','VT323','regular','400'),
		(162,'google','Lekton','400,italic,700','400,400-italic,700'),
		(163,'google','Antic','400','400'),
		(164,'google','UnifrakturMaguntia','regular','400'),
		(165,'google','Brawler','regular','400'),
		(166,'google','Nothing You Could Do','regular','400'),
		(167,'google','IM Fell DW Pica SC','regular','400'),
		(168,'google','Coda Caption','800','800'),
		(169,'google','Satisfy','400','400'),
		(170,'google','Days One','400','400'),
		(171,'google','Anonymous Pro','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(172,'google','IM Fell English SC','regular','400'),
		(173,'google','Over the Rainbow','regular','400'),
		(174,'google','Amatic SC','400,700','400,700'),
		(175,'google','Artifika','regular','400'),
		(176,'google','Aldrich','regular','400'),
		(177,'google','La Belle Aurore','regular','400'),
		(178,'google','Nixie One','regular','400'),
		(179,'google','Spinnaker','regular','400'),
		(180,'google','Pompiere','regular','400'),
		(181,'google','Smythe','regular','400'),
		(182,'google','Delius Swash Caps','400','400'),
		(183,'google','Mate','400,400italic','400,400-italic'),
		(184,'google','Ultra','regular','400'),
		(185,'google','Sansita One','regular','400'),
		(186,'google','Damion','regular','400'),
		(187,'google','Limelight','regular','400'),
		(188,'google','Cedarville Cursive','regular','400'),
		(189,'google','IM Fell French Canon SC','regular','400'),
		(190,'google','Montez','regular','400'),
		(191,'google','Forum','regular','400'),
		(192,'google','Aladin','400','400'),
		(193,'google','Delius Unicase','400,700','400,700'),
		(194,'google','Hanuman','regular,bold','400,700'),
		(195,'google','Wire One','regular','400'),
		(196,'google','Expletus Sans','400,400italic,500,500italic,600,600italic,700,700italic','400,400-italic,500,500-italic,600,600-italic,700,700-italic'),
		(197,'google','Annie Use Your Telescope','regular','400'),
		(198,'google','Snippet','regular','400'),
		(199,'google','Just Me Again Down Here','regular','400'),
		(200,'google','Ubuntu Mono','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(201,'google','Inder','400','400'),
		(202,'google','Candal','regular','400'),
		(203,'google','Adamina','400','400'),
		(204,'google','Gentium Basic','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(205,'google','IM Fell Great Primer SC','regular','400'),
		(206,'google','IM Fell Double Pica SC','regular','400'),
		(207,'google','Black Ops One','regular','400'),
		(208,'google','Dawning of a New Day','regular','400'),
		(209,'google','Buda','300','300'),
		(210,'google','Kenia','regular','400'),
		(211,'google','Cookie','400','400'),
		(212,'google','UnifrakturCook','bold','700'),
		(213,'google','Voltaire','400','400'),
		(214,'google','Caudex','400,italic,700,700italic','400,400-italic,700,700-italic'),
		(215,'google','Rationale','regular','400'),
		(216,'google','Gentium Book Basic','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(217,'google','Nova Round','regular','400'),
		(218,'google','IM Fell Great Primer','regular,italic','400,400-italic'),
		(219,'google','Short Stack','400','400'),
		(220,'google','Federo','regular','400'),
		(221,'google','Tenor Sans','regular','400'),
		(222,'google','Julee','regular','400'),
		(223,'google','Vibur','regular','400'),
		(224,'google','Nova Slim','regular','400'),
		(225,'google','IM Fell French Canon','regular,italic','400,400-italic'),
		(226,'google','Loved by the King','regular','400'),
		(227,'google','Viga','400','400'),
		(228,'google','Gochi Hand','400','400'),
		(229,'google','Holtwood One SC','regular','400'),
		(230,'google','Zeyada','regular','400'),
		(231,'google','Contrail One','regular','400'),
		(232,'google','Vidaloka','400','400'),
		(233,'google','Nova Oval','regular','400'),
		(234,'google','Montserrat','400','400'),
		(235,'google','Meddon','regular','400'),
		(236,'google','Swanky and Moo Moo','regular','400'),
		(237,'google','Nova Script','regular','400'),
		(238,'google','Ovo','regular','400'),
		(239,'google','Irish Grover','regular','400'),
		(240,'google','League Script','400','400'),
		(241,'google','Petrona','400','400'),
		(242,'google','Yeseva One','regular','400'),
		(243,'google','Squada One','400','400'),
		(244,'google','Numans','400','400'),
		(245,'google','Prata','400','400'),
		(246,'google','Gravitas One','regular','400'),
		(247,'google','IM Fell Double Pica','regular,italic','400,400-italic'),
		(248,'google','Prociono','400','400'),
		(249,'google','Astloch','regular,bold','400,700'),
		(250,'google','Kelly Slab','regular','400'),
		(251,'google','Asset','regular','400'),
		(252,'google','Nova Flat','regular','400'),
		(253,'google','Judson','400,400italic,700','400,400-italic,700'),
		(254,'google','Lusitana','400,bold','400,700'),
		(255,'google','Radley','regular,400italic','400,400-italic'),
		(256,'google','Abril Fatface','400','400'),
		(257,'google','GFS Neohellenic','regular,italic,bold,bolditalic','400,400-italic,700,700-italic'),
		(258,'google','Cambo','400','400'),
		(259,'google','Arapey','400,400italic','400,400-italic'),
		(260,'google','Tulpen One','regular','400'),
		(261,'google','Convergence','400','400'),
		(262,'google','Rammetto One','400','400'),
		(263,'google','Alike','regular','400'),
		(264,'google','Esteban','400','400'),
		(265,'google','Modern Antiqua','regular','400'),
		(266,'google','Tienne','400,700,900','400,700,900'),
		(267,'google','Megrim','regular','400'),
		(268,'google','Give You Glory','regular','400'),
		(269,'google','Monoton','400','400'),
		(270,'google','Unna','regular','400'),
		(271,'google','Mate SC','400','400'),
		(272,'google','Devonshire','400','400'),
		(273,'google','Electrolize','400','400'),
		(274,'google','Geostar','regular','400'),
		(275,'google','Andada','400','400'),
		(276,'google','Handlee','400','400'),
		(277,'google','Bowlby One','regular','400'),
		(278,'google','Wallpoet','regular','400'),
		(279,'google','Suwannaphum','regular','400'),
		(280,'google','Fanwood Text','400,400italic','400,400-italic'),
		(281,'google','Sofia','400','400'),
		(282,'google','Goblin One','regular','400'),
		(283,'google','GFS Didot','regular','400'),
		(284,'google','Miltonian','regular','400'),
		(285,'google','Fjord One','400','400'),
		(286,'google','Sniglet','800','800'),
		(287,'google','Lancelot','400','400'),
		(288,'google','Ruslan Display','regular','400'),
		(289,'google','Nova Cut','regular','400'),
		(290,'google','Bigshot One','regular','400'),
		(291,'google','Duru Sans','400','400'),
		(292,'google','Nova Mono','regular','400'),
		(293,'google','Vast Shadow','regular','400'),
		(294,'google','Dorsa','400','400'),
		(295,'google','Sigmar One','regular','400'),
		(296,'google','Nova Square','regular','400'),
		(297,'google','Alike Angular','regular','400'),
		(298,'google','Linden Hill','400,400italic','400,400-italic'),
		(299,'google','Monofett','regular','400'),
		(300,'google','Patua One','400','400'),
		(301,'google','Passero One','regular','400'),
		(302,'google','Baumans','400','400'),
		(303,'google','Atomic Age','400','400'),
		(304,'google','Bad Script','400','400'),
		(305,'google','Poller One','regular','400'),
		(306,'google','Supermercado One','400','400'),
		(307,'google','Geostar Fill','regular','400'),
		(308,'google','Smokum','regular','400'),
		(309,'google','Federant','400','400'),
		(310,'google','Engagement','400','400'),
		(311,'google','Aubrey','regular','400'),
		(312,'google','Boogaloo','regular','400'),
		(313,'google','Alfa Slab One','400','400'),
		(314,'google','Ribeye','400','400'),
		(315,'google','Signika Negative','300,400,600,700','300,400,600,700'),
		(316,'google','Quantico','400,400italic,700,700italic','400,400-italic,700,700-italic'),
		(317,'google','Ruluko','400','400'),
		(318,'google','Niconne','regular','400'),
		(319,'google','Bree Serif','400','400'),
		(320,'google','Mr Dafoe','400','400'),
		(321,'google','Crete Round','400,400italic','400,400-italic'),
		(322,'google','Marmelad','400','400'),
		(323,'google','Italianno','400','400'),
		(324,'google','Fredericka the Great','regular','400'),
		(325,'google','Trade Winds','400','400'),
		(326,'google','Magra','400,bold','400,700'),
		(327,'google','Iceland','400','400'),
		(328,'google','Stint Ultra Condensed','400','400'),
		(329,'google','Chelsea Market','400','400'),
		(330,'google','Bubblegum Sans','400','400'),
		(331,'google','Trykker','400','400'),
		(332,'google','Acme','400','400'),
		(333,'google','Overlock','400,400italic,700,700italic,900,900italic','400,400-italic,700,700-italic,900,900italic'),
		(334,'google','Armata','400','400'),
		(335,'google','Playball','400','400'),
		(336,'google','Habibi','400','400'),
		(337,'google','Oldenburg','400','400'),
		(338,'google','Galdeano','400','400'),
		(339,'google','Dynalight','400','400'),
		(340,'google','Enriqueta','400,700','400,700'),
		(341,'google','Concert One','400','400'),
		(342,'google','Overlock SC','400','400'),
		(343,'google','Noticia Text','400,400italic,700,700italic','400,400-italic,700,700-italic'),
		(344,'google','Righteous','400','400'),
		(345,'google','Cagliostro','400','400'),
		(346,'google','Arizonia','400','400'),
		(347,'google','Rouge Script','400','400'),
		(348,'google','Knewave','400','400'),
		(349,'google','Miniver','400','400'),
		(350,'google','Qwigley','400','400'),
		(351,'google','Flamenco','300,400','300,400'),
		(352,'google','Asul','400,bold','400,700'),
		(353,'google','Bokor','regular','400'),
		(354,'google','Monsieur La Doulaise','400','400'),
		(355,'google','Gudea','400,italic,bold','400,400-italic,700'),
		(356,'google','Flavors','400','400'),
		(357,'google','Ruda','400,bold,900','400,700,900'),
		(358,'google','Stoke','400','400'),
		(359,'google','Spirax','400','400'),
		(360,'google','Uncial Antiqua','400','400'),
		(361,'google','Telex','400','400'),
		(362,'google','Alex Brush','400','400'),
		(363,'google','Yesteryear','400','400'),
		(364,'google','Fresca','400','400'),
		(365,'google','Original Surfer','400','400'),
		(366,'google','Buenard','400,bold','400,700'),
		(367,'google','Medula One','400','400'),
		(368,'google','Ruthie','400','400'),
		(369,'google','Bilbo','400','400'),
		(370,'google','Basic','400','400'),
		(371,'google','Nosifer','400','400'),
		(372,'google','Fondamento','400,400italic','400,400-italic'),
		(373,'google','Mrs Sheppards','400','400'),
		(374,'google','Marko One','400','400'),
		(375,'google','Caesar Dressing','400','400'),
		(376,'google','Lemon','400','400'),
		(377,'google','Metal','regular','400'),
		(378,'google','Moulpali','regular','400'),
		(379,'google','Balthazar','400','400'),
		(380,'google','Chicle','400','400'),
		(381,'google','Spicy Rice','400','400'),
		(382,'google','Almendra','400,bold','400,700'),
		(383,'google','Frijole','400','400'),
		(384,'google','Bilbo Swash Caps','400','400'),
		(385,'google','Ribeye Marrow','400','400'),
		(386,'google','Sail','400','400'),
		(387,'google','Battambang','regular,bold','400,700'),
		(388,'google','Wellfleet','400','400'),
		(389,'google','Jim Nightshade','400','400'),
		(390,'google','Piedra','400','400'),
		(391,'google','Eater','400','400'),
		(392,'google','Belgrano','400','400'),
		(393,'google','Fugaz One','400','400'),
		(394,'google','Creepster','regular','400'),
		(395,'google','Content','regular,bold','400,700'),
		(396,'google','Homenaje','400','400'),
		(397,'google','Titan One','400','400'),
		(398,'google','Aguafina Script','400','400'),
		(399,'google','Fascinate Inline','400','400'),
		(400,'google','Dr Sugiyama','400','400'),
		(401,'google','Metamorphous','400','400'),
		(402,'google','Angkor','regular','400'),
		(403,'google','Inika','400,bold','400,700'),
		(404,'google','Ruge Boogie','400','400'),
		(405,'google','Alegreya SC','400,400italic,700,700italic,900,900italic','400,400-italic,700,700-italic,900,900italic'),
		(406,'google','Alegreya','400,400italic,700,700italic,900,900italic','400,400-italic,700,700-italic,900,900italic'),
		(407,'google','Sarina','400','400'),
		(408,'google','Lustria','400','400'),
		(409,'google','Chango','400','400'),
		(410,'google','Dangrek','regular','400'),
		(411,'google','Unlock','regular','400'),
		(412,'google','Sonsie One','400','400'),
		(413,'google','Arbutus','400','400'),
		(414,'google','Mr De Haviland','400','400'),
		(415,'google','Plaster','400','400'),
		(416,'google','Miss Fajardose','400','400'),
		(417,'google','Amethysta','400','400'),
		(418,'google','Khmer','regular','400'),
		(419,'google','Macondo Swash Caps','400','400'),
		(420,'google','Fascinate','400','400'),
		(421,'google','Trochut','400,italic,bold','400,400-italic,700'),
		(422,'google','Junge','400','400'),
		(423,'google','Herr Von Muellerhoff','400','400'),
		(424,'google','Bayon','regular','400'),
		(425,'google','Preahvihear','regular','400'),
		(426,'google','Ceviche One','400','400'),
		(427,'google','Freehand','regular','400'),
		(428,'google','Nokora','400,700','400,700'),
		(429,'google','Bonbon','400','400'),
		(430,'google','Almendra SC','400','400'),
		(431,'google','Moul','regular','400'),
		(432,'google','Sirin Stencil','400','400'),
		(433,'google','Germania One','400','400'),
		(434,'google','Montaga','400','400'),
		(435,'google','Odor Mean Chey','regular','400'),
		(436,'google','Macondo','400','400'),
		(437,'google','Chenla','regular','400'),
		(438,'google','Siemreap','regular','400'),
		(439,'google','Taprom','regular','400'),
		(440,'google','Port Lligat Sans','400','400'),
		(441,'google','Port Lligat Slab','400','400'),
		(442,'google','Koulen','regular','400'),
		(443,'google','Emblema One','400','400'),
		(444,'google','Butcherman','400','400');";
		
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//6. Create table ap_form_filters
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_filters` (
														  `aff_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
														  `form_id` int(11) NOT NULL,
														  `element_name` varchar(50) NOT NULL DEFAULT '',
														  `filter_condition` varchar(15) NOT NULL DEFAULT 'is',
														  `filter_keyword` varchar(255) NOT NULL DEFAULT '',
														  PRIMARY KEY (`aff_id`),
														  KEY `form_id` (`form_id`)
														) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//7. Create table ap_form_themes
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_themes` (
													  `theme_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
													  `status` int(1) DEFAULT '1',
													  `theme_has_css` int(1) NOT NULL DEFAULT '0',
													  `theme_name` varchar(255) DEFAULT '',
													  `theme_built_in` int(1) NOT NULL DEFAULT '0',
													  `logo_type` varchar(11) NOT NULL DEFAULT 'default' COMMENT 'default,custom,disabled',
													  `logo_custom_image` text,
													  `logo_custom_height` int(11) NOT NULL DEFAULT '40',
													  `logo_default_image` varchar(50) DEFAULT '',
													  `logo_default_repeat` int(1) NOT NULL DEFAULT '0',
													  `wallpaper_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
													  `wallpaper_bg_color` varchar(11) DEFAULT '',
													  `wallpaper_bg_pattern` varchar(50) DEFAULT '',
													  `wallpaper_bg_custom` text,
													  `header_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
													  `header_bg_color` varchar(11) DEFAULT '',
													  `header_bg_pattern` varchar(50) DEFAULT '',
													  `header_bg_custom` text,
													  `form_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
													  `form_bg_color` varchar(11) DEFAULT '',
													  `form_bg_pattern` varchar(50) DEFAULT '',
													  `form_bg_custom` text,
													  `highlight_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
													  `highlight_bg_color` varchar(11) DEFAULT '',
													  `highlight_bg_pattern` varchar(50) DEFAULT '',
													  `highlight_bg_custom` text,
													  `guidelines_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
													  `guidelines_bg_color` varchar(11) DEFAULT '',
													  `guidelines_bg_pattern` varchar(50) DEFAULT '',
													  `guidelines_bg_custom` text,
													  `field_bg_type` varchar(11) NOT NULL DEFAULT 'color' COMMENT 'color,pattern,custom',
													  `field_bg_color` varchar(11) DEFAULT '',
													  `field_bg_pattern` varchar(50) DEFAULT '',
													  `field_bg_custom` text,
													  `form_title_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `form_title_font_weight` int(11) NOT NULL DEFAULT '400',
													  `form_title_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `form_title_font_size` varchar(11) DEFAULT '',
													  `form_title_font_color` varchar(11) DEFAULT '',
													  `form_desc_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `form_desc_font_weight` int(11) NOT NULL DEFAULT '400',
													  `form_desc_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `form_desc_font_size` varchar(11) DEFAULT '',
													  `form_desc_font_color` varchar(11) DEFAULT '',
													  `field_title_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `field_title_font_weight` int(11) NOT NULL DEFAULT '400',
													  `field_title_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `field_title_font_size` varchar(11) DEFAULT '',
													  `field_title_font_color` varchar(11) DEFAULT '',
													  `guidelines_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `guidelines_font_weight` int(11) NOT NULL DEFAULT '400',
													  `guidelines_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `guidelines_font_size` varchar(11) DEFAULT '',
													  `guidelines_font_color` varchar(11) DEFAULT '',
													  `section_title_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `section_title_font_weight` int(11) NOT NULL DEFAULT '400',
													  `section_title_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `section_title_font_size` varchar(11) DEFAULT '',
													  `section_title_font_color` varchar(11) DEFAULT '',
													  `section_desc_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `section_desc_font_weight` int(11) NOT NULL DEFAULT '400',
													  `section_desc_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `section_desc_font_size` varchar(11) DEFAULT '',
													  `section_desc_font_color` varchar(11) DEFAULT '',
													  `field_text_font_type` varchar(50) NOT NULL DEFAULT 'Lucida Grande',
													  `field_text_font_weight` int(11) NOT NULL DEFAULT '400',
													  `field_text_font_style` varchar(25) NOT NULL DEFAULT 'normal',
													  `field_text_font_size` varchar(11) DEFAULT '',
													  `field_text_font_color` varchar(11) DEFAULT '',
													  `border_form_width` int(11) NOT NULL DEFAULT '1',
													  `border_form_style` varchar(11) NOT NULL DEFAULT 'solid',
													  `border_form_color` varchar(11) DEFAULT '',
													  `border_guidelines_width` int(11) NOT NULL DEFAULT '1',
													  `border_guidelines_style` varchar(11) NOT NULL DEFAULT 'solid',
													  `border_guidelines_color` varchar(11) DEFAULT '',
													  `border_section_width` int(11) NOT NULL DEFAULT '1',
													  `border_section_style` varchar(11) NOT NULL DEFAULT 'solid',
													  `border_section_color` varchar(11) DEFAULT '',
													  `form_shadow_style` varchar(25) NOT NULL DEFAULT 'WarpShadow',
													  `form_shadow_size` varchar(11) NOT NULL DEFAULT 'large',
													  `form_shadow_brightness` varchar(11) NOT NULL DEFAULT 'normal',
													  `form_button_type` varchar(11) NOT NULL DEFAULT 'text',
													  `form_button_text` varchar(100) NOT NULL DEFAULT 'Submit',
													  `form_button_image` text,
													  `advanced_css` text,
													  PRIMARY KEY (`theme_id`),
													  KEY `theme_name` (`theme_name`)
													) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//insert into ap_form_themes table
		$query = "INSERT INTO `".MF_TABLE_PREFIX."form_themes` (`theme_id`, `status`, `theme_has_css`, `theme_name`, `theme_built_in`, `logo_type`, `logo_custom_image`, `logo_custom_height`, `logo_default_image`, `logo_default_repeat`, `wallpaper_bg_type`, `wallpaper_bg_color`, `wallpaper_bg_pattern`, `wallpaper_bg_custom`, `header_bg_type`, `header_bg_color`, `header_bg_pattern`, `header_bg_custom`, `form_bg_type`, `form_bg_color`, `form_bg_pattern`, `form_bg_custom`, `highlight_bg_type`, `highlight_bg_color`, `highlight_bg_pattern`, `highlight_bg_custom`, `guidelines_bg_type`, `guidelines_bg_color`, `guidelines_bg_pattern`, `guidelines_bg_custom`, `field_bg_type`, `field_bg_color`, `field_bg_pattern`, `field_bg_custom`, `form_title_font_type`, `form_title_font_weight`, `form_title_font_style`, `form_title_font_size`, `form_title_font_color`, `form_desc_font_type`, `form_desc_font_weight`, `form_desc_font_style`, `form_desc_font_size`, `form_desc_font_color`, `field_title_font_type`, `field_title_font_weight`, `field_title_font_style`, `field_title_font_size`, `field_title_font_color`, `guidelines_font_type`, `guidelines_font_weight`, `guidelines_font_style`, `guidelines_font_size`, `guidelines_font_color`, `section_title_font_type`, `section_title_font_weight`, `section_title_font_style`, `section_title_font_size`, `section_title_font_color`, `section_desc_font_type`, `section_desc_font_weight`, `section_desc_font_style`, `section_desc_font_size`, `section_desc_font_color`, `field_text_font_type`, `field_text_font_weight`, `field_text_font_style`, `field_text_font_size`, `field_text_font_color`, `border_form_width`, `border_form_style`, `border_form_color`, `border_guidelines_width`, `border_guidelines_style`, `border_guidelines_color`, `border_section_width`, `border_section_style`, `border_section_color`, `form_shadow_style`, `form_shadow_size`, `form_shadow_brightness`, `form_button_type`, `form_button_text`, `form_button_image`, `advanced_css`)
	VALUES
		(1,1,0,'Green Senegal',1,'default','http://',40,'machform.png',0,'color','#cfdfc5','','','color','#bad4a9','','','color','#ffffff','','','color','#ecf1ea','','','color','#ecf1ea','','','color','#cfdfc5','','','Philosopher',700,'normal','','#80af1b','Philosopher',400,'normal','100%','#80af1b','Philosopher',700,'normal','110%','#80af1b','Ubuntu',400,'normal','','#666666','Philosopher',700,'normal','110%','#80af1b','Philosopher',400,'normal','95%','#80af1b','Ubuntu',400,'normal','','#666666',1,'solid','#bad4a9',1,'dashed','#bad4a9',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(2,1,0,'Blue Bigbird',1,'default','http://',40,'machform.png',0,'color','#336699','','','color','#6699cc','','','color','#ffffff','','','color','#ccdced','','','color','#6699cc','','','color','#ffffff','','','Open Sans',600,'normal','','','Open Sans',400,'normal','','','Open Sans',700,'normal','100%','','Ubuntu',400,'normal','80%','#ffffff','Open Sans',600,'normal','','','Open Sans',400,'normal','95%','','Open Sans',400,'normal','','',1,'solid','#336699',1,'dotted','#6699cc',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(3,1,0,'Blue Pionus',1,'default','http://',40,'machform.png',0,'color','#556270','','','color','#6b7b8c','','','color','#ffffff','','','color','#99aec4','','','color','#6b7b8c','','','color','#ffffff','','','Istok Web',400,'normal','170%','','Maven Pro',400,'normal','100%','','Istok Web',700,'normal','100%','','Maven Pro',400,'normal','95%','#ffffff','Istok Web',400,'normal','110%','','Maven Pro',400,'normal','95%','','Maven Pro',400,'normal','','',1,'solid','#556270',1,'solid','#6b7b8c',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(4,1,0,'Brown Conure',1,'default','http://',40,'machform.png',0,'pattern','#948c75','pattern_036.gif','','color','#b3a783','','','color','#ffffff','','','color','#e0d0a2','','','color','#948c75','','','color','#f0f0d8','pattern_036.gif','','Molengo',400,'normal','170%','','Molengo',400,'normal','110%','','Molengo',400,'normal','110%','','Nobile',400,'normal','','#ececec','Molengo',400,'normal','130%','','Molengo',400,'normal','100%','','Molengo',400,'normal','110%','',1,'solid','#948c75',1,'solid','#948c75',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(5,1,0,'Yellow Lovebird',1,'default','http://',40,'machform.png',0,'color','#f0d878','','','color','#edb817','pattern_158.gif','','color','#ffffff','','','color','#f5d678','','','color','#f7c52e','','','color','#ffffff','','','Amaranth',700,'normal','170%','','Amaranth',400,'normal','100%','','Amaranth',700,'normal','100%','','Amaranth',400,'normal','','#444444','Amaranth',400,'normal','110%','','Amaranth',400,'normal','95%','','Amaranth',400,'normal','100%','',1,'solid','#f0d878',1,'solid','#f7c52e',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(6,1,0,'Pink Starling',1,'default','http://',40,'machform.png',0,'color','#ff6699','','','color','#d93280','','','color','#ffffff','','','color','#ffd0d4','','','color','#f9fad2','','','color','#ffffff','','','Josefin Sans',600,'normal','160%','','Josefin Sans',400,'normal','110%','','Josefin Sans',700,'normal','110%','','Josefin Sans',600,'normal','100%','','Josefin Sans',700,'normal','','','Josefin Sans',400,'normal','110%','','Josefin Sans',400,'normal','130%','',1,'solid','#ff6699',1,'dashed','#f56990',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(8,1,0,'Red Rabbit',1,'default','http://',40,'machform.png',0,'color','#a40802','','','color','#800e0e','','','color','#ffffff','','','color','#ffa4a0','','','color','#800e0e','','','color','#ffffff','','','Lobster',400,'normal','','#000000','Ubuntu',400,'normal','100%','#000000','Lobster',400,'normal','110%','#222222','Ubuntu',400,'normal','85%','#ffffff','Lobster',400,'normal','130%','#000000','Ubuntu',400,'normal','95%','#000000','Ubuntu',400,'normal','','#333333',1,'solid','#a40702',1,'solid','#800e0e',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(9,1,0,'Orange Robin',1,'default','http://',40,'machform.png',0,'color','#f38430','','','color','#fa6800','','','color','#ffffff','','','color','#a7dbd8','','','color','#e0e4cc','','','color','#ffffff','','','Lucida Grande',400,'normal','','#000000','Nobile',400,'normal','','#000000','Nobile',700,'normal','','#000000','Lucida Grande',400,'normal','','#444444','Nobile',700,'normal','100%','#000000','Nobile',400,'normal','','#000000','Nobile',400,'normal','95%','#333333',1,'solid','#f38430',1,'solid','#e0e4cc',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(10,1,0,'Orange Sunbird',1,'default','http://',40,'machform.png',0,'color','#d95c43','','','color','#c02942','','','color','#ffffff','','','color','#d95c43','','','color','#53777a','','','color','#ffffff','','','Lucida Grande',400,'normal','','#000000','Lucida Grande',400,'normal','','#000000','Lucida Grande',700,'normal','','#222222','Lucida Grande',400,'normal','','#ffffff','Lucida Grande',400,'normal','','#000000','Lucida Grande',400,'normal','','#000000','Lucida Grande',400,'normal','','#333333',1,'solid','#d95c43',1,'solid','#53777a',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(11,1,0,'Green Ringneck',1,'default','http://',40,'machform.png',0,'color','#0b486b','','','color','#3b8686','','','color','#ffffff','','','color','#cff09e','','','color','#79bd9a','','','color','#a8dba8','','','Delius Swash Caps',400,'normal','','#000000','Delius Swash Caps',400,'normal','100%','#000000','Delius Swash Caps',400,'normal','100%','#222222','Delius',400,'normal','85%','#ffffff','Delius Swash Caps',400,'normal','','#000000','Delius Swash Caps',400,'normal','95%','#000000','Delius',400,'normal','','#515151',1,'solid','#0b486b',1,'solid','#79bd9a',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(12,1,0,'Brown Finch',1,'default','http://',40,'machform.png',0,'color','#774f38','','','color','#e08e79','','','color','#ffffff','','','color','#ece5ce','','','color','#c5e0dc','','','color','#f9fad2','','','Arvo',700,'normal','','#000000','Arvo',400,'normal','','#000000','Arvo',700,'normal','','#222222','Arvo',400,'normal','','#444444','Arvo',400,'normal','','#000000','Arvo',400,'normal','85%','#000000','Arvo',400,'normal','','#333333',1,'solid','#774f38',1,'dashed','#e08e79',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(14,1,0,'Brown Macaw',1,'default','http://',40,'machform.png',0,'color','#413e4a','','','color','#73626e','','','pattern','#ffffff','pattern_022.gif','','color','#f0b49e','','','color','#b38184','','','color','#ffffff','','','Cabin',500,'normal','160%','#000000','Cabin',400,'normal','100%','#000000','Cabin',700,'normal','110%','#222222','Lucida Grande',400,'normal','','#ececec','Cabin',600,'normal','','#000000','Cabin',600,'normal','95%','#000000','Cabin',400,'normal','110%','#333333',1,'solid','#413e4a',1,'dotted','#ff9900',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(15,1,0,'Pink Thrush',1,'default','http://',40,'machform.png',0,'color','#ff9f9d','','','color','#ff3d7e','','','color','#ffffff','','','color','#7fc7af','','','color','#3fb8b0','','','color','#ffffff','','','Crafty Girls',400,'normal','','#000000','Crafty Girls',400,'normal','100%','#000000','Crafty Girls',400,'normal','100%','#222222','Nobile',400,'normal','80%','#ffffff','Crafty Girls',400,'normal','','#000000','Crafty Girls',400,'normal','95%','#000000','Molengo',400,'normal','110%','#333333',1,'solid','#ff9f9d',1,'solid','#3fb8b0',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(16,1,0,'Yellow Bulbul',1,'default','http://',40,'machform.png',0,'color','#f8f4d7','','','color','#f4b26c','','','color','#f4dec2','','','color','#f2b4a7','','','color','#e98976','','','color','#ffffff','','','Special Elite',400,'normal','','#000000','Special Elite',400,'normal','','#000000','Special Elite',400,'normal','95%','#222222','Cousine',400,'normal','80%','#ececec','Special Elite',400,'normal','','#000000','Special Elite',400,'normal','','#000000','Cousine',400,'normal','','#333333',1,'solid','#f8f4d7',1,'solid','#f4b26c',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(17,1,0,'Blue Canary',1,'default','http://',40,'machform.png',0,'color','#81a8b8','','','color','#a4bcc2','','','color','#ffffff','','','color','#e8f3f8','','','color','#dbe6ec','','','color','#ffffff','','','PT Sans',400,'normal','','#000000','PT Sans',400,'normal','100%','#000000','PT Sans',700,'normal','100%','#222222','PT Sans',400,'normal','','#666666','PT Sans',700,'normal','','#000000','PT Sans',400,'normal','100%','#000000','PT Sans',400,'normal','110%','#333333',1,'solid','#81a8b8',1,'dashed','#a4bcc2',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(18,1,0,'Red Mockingbird',1,'default','http://',40,'machform.png',0,'color','#6b0103','','','color','#a30005','','','color','#c21b01','','','color','#f03d02','','','color','#1c0113','','','color','#ffffff','','','Oswald',400,'normal','','#ffffff','Open Sans',400,'normal','','#ffffff','Oswald',400,'normal','95%','#ffffff','Open Sans',400,'normal','','#ececec','Oswald',400,'normal','','#ececec','Lucida Grande',400,'normal','','#ffffff','Open Sans',400,'normal','','#333333',1,'solid','#6b0103',1,'solid','#1c0113',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(13,1,0,'Green Sparrow',1,'default','http://',40,'machform.png',0,'color','#d1f2a5','','','color','#f56990','','','color','#ffffff','','','color','#ffc48c','','','color','#ffa080','','','color','#ffffff','','','Open Sans',400,'normal','','#000000','Open Sans',400,'normal','','#000000','Open Sans',700,'normal','','#222222','Ubuntu',400,'normal','85%','#f4fce8','Open Sans',600,'normal','','#000000','Open Sans',400,'normal','95%','#000000','Open Sans',400,'normal','','#333333',10,'solid','#f0fab4',1,'solid','#ffa080',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(21,1,0,'Purple Vanga',1,'default','http://',40,'machform.png',0,'color','#7b85e2','','','color','#7aa6d6','','','color','#d1e7f9','','','color','#7aa6d6','','','color','#fbfcd0','','','color','#ffffff','','','Droid Sans',400,'normal','160%','#444444','Droid Sans',400,'normal','95%','#444444','Open Sans',700,'normal','95%','#444444','Droid Sans',400,'normal','85%','#444444','Droid Sans',400,'normal','110%','#444444','Droid Sans',400,'normal','95%','#000000','Droid Sans',400,'normal','100%','#333333',0,'solid','#CCCCCC',1,'solid','#fbfcd0',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(22,1,0,'Purple Dove',1,'default','http://',40,'machform.png',0,'color','#c0addb','','','color','#a662de','','','pattern','#ffffff','pattern_044.gif','','color','#a662de','pattern_028.gif','','color','#a662de','','','color','#c0addb','','','Pacifico',400,'normal','180%','#000000','Open Sans',400,'normal','95%','#000000','Pacifico',400,'normal','95%','#222222','Open Sans',400,'normal','80%','#ececec','Pacifico',400,'normal','110%','#000000','Open Sans',400,'normal','95%','#000000','Open Sans',400,'normal','100%','#333333',0,'solid','#a662de',1,'dashed','#CCCCCC',1,'dashed','#a662de','StandShadow','large','dark','text','Submit','http://',''),
		(20,1,0,'Pink Flamingo',1,'default','http://',40,'machform.png',0,'color','#f87d7b','','','color','#5ea0a3','','','color','#ffffff','','','color','#fab97f','','','color','#dcd1b4','','','color','#ffffff','','','Lucida Grande',400,'normal','160%','#b05573','Lucida Grande',400,'normal','95%','#b05573','Lucida Grande',700,'normal','95%','#b05573','Lucida Grande',400,'normal','80%','#444444','Lucida Grande',400,'normal','110%','#b05573','Lucida Grande',400,'normal','85%','#b05573','Lucida Grande',400,'normal','100%','#333333',0,'solid','#f87d7b',1,'dotted','#fab97f',1,'dotted','#CCCCCC','WarpShadow','large','normal','text','Submit','http://',''),
		(19,1,0,'Yellow Kiwi',1,'default','http://',40,'machform.png',0,'color','#ffe281','','','color','#ffbb7f','','','color','#eee9e5','','','color','#fad4b2','','','color','#ff9c97','','','color','#ffffff','','','Lucida Grande',400,'normal','160%','#000000','Lucida Grande',400,'normal','95%','#000000','Lucida Grande',700,'normal','95%','#222222','Lucida Grande',400,'normal','80%','#ffffff','Lucida Grande',400,'normal','110%','#000000','Lucida Grande',400,'normal','85%','#000000','Lucida Grande',400,'normal','100%','#333333',1,'solid','#ffe281',1,'solid','#CCCCCC',1,'dotted','#cdcdcd','WarpShadow','large','normal','text','Submit','http://','');";
		
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//8. Create table ap_settings
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."settings` (
													  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
													  `smtp_enable` tinyint(1) NOT NULL DEFAULT '0',
													  `smtp_host` varchar(255) NOT NULL DEFAULT 'localhost',
													  `smtp_port` int(11) NOT NULL DEFAULT '25',
													  `smtp_auth` tinyint(1) NOT NULL DEFAULT '0',
													  `smtp_username` varchar(255) DEFAULT NULL,
													  `smtp_password` varchar(255) DEFAULT NULL,
													  `smtp_secure` tinyint(1) NOT NULL DEFAULT '0',
													  `upload_dir` varchar(255) NOT NULL DEFAULT './data',
													  `data_dir` varchar(255) NOT NULL DEFAULT './data',
													  `default_from_name` varchar(255) NOT NULL DEFAULT 'MachForm',
													  `default_from_email` varchar(255) DEFAULT NULL,
													  `base_url` varchar(255) DEFAULT NULL,
													  `form_manager_max_rows` int(11) DEFAULT '10',
													  `form_manager_sort_by` varchar(25) DEFAULT NULL,
													  `admin_login` varchar(255) NOT NULL DEFAULT '',
													  `admin_password` varchar(255) NOT NULL DEFAULT '',
													  `cookie_hash` varchar(25) DEFAULT NULL,
													  `admin_image_url` varchar(255) DEFAULT NULL,
													  `disable_machform_link` int(1) DEFAULT '0',
													  `customer_id` varchar(100) DEFAULT NULL,
													  `customer_name` varchar(100) DEFAULT NULL,
													  `license_key` varchar(50) DEFAULT NULL,
													  `machform_version` varchar(10) NOT NULL DEFAULT '3.3',
													  PRIMARY KEY (`id`)
													) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//9. Insert into ap_settings table
		$domain = str_replace('www.','',$_SERVER['SERVER_NAME']);
		$default_from_email = "no-reply@{$domain}";

		if(!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != 'off')){
			$ssl_suffix = 's';
		}else{
			$ssl_suffix = '';
		}
		$machform_base_url = 'http'.$ssl_suffix.'://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\').'/';

		$hasher = new PasswordHash(8, FALSE);
		$default_password_hash = $hasher->HashPassword('machform');

		$query = "INSERT INTO `".MF_TABLE_PREFIX."settings` (`id`, 
																	`smtp_enable`, 
																	`smtp_host`, 
																	`smtp_port`, 
																	`smtp_auth`, 
																	`smtp_username`, 
																	`smtp_password`, 
																	`smtp_secure`, 
																	`upload_dir`, 
																	`data_dir`, 
																	`default_from_name`, 
																	`default_from_email`, 
																	`base_url`, 
																	`form_manager_max_rows`, 
																	`form_manager_sort_by`, 
																	`admin_login`, 
																	`admin_password`, 
																	`cookie_hash`, 
																	`admin_image_url`, 
																	`disable_machform_link`,
																	`license_key`,
																	`machform_version`)
															VALUES
																	(1,
																	 0,
																	'localhost',
																	25,
																	0,
																	'',
																	'',
																	0,
																	'./data',
																	'./data',
																	'MachForm',
																	'{$default_from_email}',
																	'{$machform_base_url}',
																	10,
																	'date_created',
																	'{$admin_username}',
																	'{$default_password_hash}',
																	'',
																	'',
																	0,
																	'{$license_key}',
																	'{$new_machform_version}');";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//10. Loop through each form table and alter table structure
		$query = "select `form_id`,`form_email`,`esr_email_address`,`form_redirect` from ".MF_TABLE_PREFIX."forms";
		$params = array();
		$sth 	= mf_do_query($query,$params,$dbh);
				
		$email_enable_status_array = array();
		$redirect_enable_status_array = array();
		while($row = mf_do_fetch_result($sth)){
			$form_id = $row['form_id'];
			$form_id_array[] = $form_id;

			if(!empty($row['form_email'])){
				$email_enable_status_array[$form_id]['esl_enable'] = 1;
			}else{
				$email_enable_status_array[$form_id]['esl_enable'] = 0;
			}

			if(!empty($row['esr_email_address'])){
				$email_enable_status_array[$form_id]['esr_enable'] = 1;
			}else{
				$email_enable_status_array[$form_id]['esr_enable'] = 0;
			}

			if(!empty($row['form_redirect'])){
				$redirect_enable_status_array[$form_id] = 1;
			}else{
				$redirect_enable_status_array[$form_id] = 0;
			}
		}
				
		foreach ($form_id_array as $form_id) {
			//add new columns
			$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_{$form_id}`
													  ADD COLUMN `status` int(4) unsigned NOT NULL DEFAULT '1',
													  ADD COLUMN `resume_key` varchar(10) default NULL;";
			$params = array();
			$sth = $dbh->prepare($query);
			try{
				$sth->execute($params);
			}catch(PDOException $e) {
				$post_install_error .= $e->getMessage().'<br/><br/>';
			}

			$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_{$form_id}_review`
													  ADD COLUMN `status` int(4) unsigned NOT NULL DEFAULT '1',
													  ADD COLUMN `resume_key` varchar(10) default NULL;";
			$params = array();
			$sth = $dbh->prepare($query);
			try{
				$sth->execute($params);
			}catch(PDOException $e) {
				//do nothing, ignore if table review not exist
			}

			//update the esl_enable/esr_enable/redirect_enable
			$query = "UPDATE `".MF_TABLE_PREFIX."forms` SET esl_enable = ?,esr_enable = ?,form_redirect_enable = ? WHERE form_id = ?";
					
			$params = array($email_enable_status_array[$form_id]['esl_enable'],$email_enable_status_array[$form_id]['esr_enable'],$redirect_enable_status_array[$form_id],$form_id);
					
			$sth = $dbh->prepare($query);
			try{
				$sth->execute($params);
			}catch(PDOException $e) {
				$post_install_error .= $e->getMessage().'<br/><br/>';
			}
		}

		//11. Loop through each CSS file and create a theme for each form
				
		//first delete htaccess file if exist
		if(file_exists('./data/.htaccess')){
			@unlink('./data/.htaccess');
		}		
				
		//Create "themes" folder
		if(is_writable("./data")){
			$old_mask = umask(0);
			mkdir("./data/themes",0777);
			umask($old_mask);
		}

		foreach ($form_id_array as $form_id) {
			$advanced_css = '';

			if(file_exists("./data/form_{$form_id}/css/view.css")){
				rename("./data/form_{$form_id}/css/view.css", "./data/form_{$form_id}/css/view.old.css");

				//copy default view.css to css folder
				$old_mask = umask(0);
				if(copy("./view.css","./data/form_{$form_id}/css/view.css")){
					$form_has_css = 1;
				}else{
					$form_has_css = 0;
				}
				umask($old_mask);

				//update form_has_css value
				$query = "UPDATE ".MF_TABLE_PREFIX."forms set form_has_css=? where form_id=?";
				$params = array($form_has_css,$form_id);
				$sth = $dbh->prepare($query);
				try{
					$sth->execute($params);
				}catch(PDOException $e) {
					$post_install_error .= $e->getMessage().'<br/><br/>';
				}


				$advanced_css = file_get_contents("./data/form_{$form_id}/css/view.old.css"); //store the old view.css content as advanced code
			
				//insert into ap_form_themes  table
				$query = "INSERT INTO 
								`".MF_TABLE_PREFIX."form_themes` 
										( 
										`status`, 
										`theme_has_css`, 
										`theme_name`, 
										`theme_built_in`, 
										`logo_type`, 
										`logo_custom_image`, 
										`logo_custom_height`, 
										`logo_default_image`, 
										`logo_default_repeat`, 
										`wallpaper_bg_type`, 
										`wallpaper_bg_color`, 
										`wallpaper_bg_pattern`, 
										`wallpaper_bg_custom`, 
										`header_bg_type`, 
										`header_bg_color`, 
										`header_bg_pattern`, 
										`header_bg_custom`, 
										`form_bg_type`, 
										`form_bg_color`, 
										`form_bg_pattern`, 
										`form_bg_custom`, 
										`highlight_bg_type`, 
										`highlight_bg_color`, 
										`highlight_bg_pattern`, 
										`highlight_bg_custom`, 
										`guidelines_bg_type`, 
										`guidelines_bg_color`, 
										`guidelines_bg_pattern`, 
										`guidelines_bg_custom`, 
										`field_bg_type`, 
										`field_bg_color`, 
										`field_bg_pattern`, 
										`field_bg_custom`, 
										`form_title_font_type`, 
										`form_title_font_weight`, 
										`form_title_font_style`, 
										`form_title_font_size`, 
										`form_title_font_color`, 
										`form_desc_font_type`, 
										`form_desc_font_weight`, 
										`form_desc_font_style`, 
										`form_desc_font_size`, 
										`form_desc_font_color`, 
										`field_title_font_type`, 
										`field_title_font_weight`, 
										`field_title_font_style`, 
										`field_title_font_size`, 
										`field_title_font_color`, 
										`guidelines_font_type`, 
										`guidelines_font_weight`, 
										`guidelines_font_style`, 
										`guidelines_font_size`, 
										`guidelines_font_color`, 
										`section_title_font_type`, 
										`section_title_font_weight`, 
										`section_title_font_style`, 
										`section_title_font_size`, 
										`section_title_font_color`, 
										`section_desc_font_type`, 
										`section_desc_font_weight`, 
										`section_desc_font_style`, 
										`section_desc_font_size`, 
										`section_desc_font_color`, 
										`field_text_font_type`, 
										`field_text_font_weight`, 
										`field_text_font_style`, 
										`field_text_font_size`, 
										`field_text_font_color`, 
										`border_form_width`, 
										`border_form_style`, 
										`border_form_color`, 
										`border_guidelines_width`, 
										`border_guidelines_style`, 
										`border_guidelines_color`, 
										`border_section_width`, 
										`border_section_style`, 
										`border_section_color`, 
										`form_shadow_style`, 
										`form_shadow_size`, 
										`form_shadow_brightness`, 
										`form_button_type`, 
										`form_button_text`, 
										`form_button_image`, 
										`advanced_css`)
								VALUES
									(1,0,?,0,'default','http://',40,'machform.png',0,'color','#ececec','','','color','#DEDEDE','','',
									'color','#ffffff','','','color','#FFF7C0','','','color','#F5F5F5','','','color','#ffffff','','','Lucida Grande',
									400,'normal','160%','#000000','Lucida Grande',400,'normal','95%','#000000','Lucida Grande',700,'normal','95%','#222222',
									'Lucida Grande',400,'normal','80%','#444444','Lucida Grande',400,'normal','110%','#000000','Lucida Grande',400,'normal',
									'85%','#000000','Lucida Grande',400,'normal','100%','#333333',1,'solid','#CCCCCC',1,'solid','#CCCCCC',1,'dotted','#CCCCCC',
									'WarpShadow','large','normal','text','Submit','http://',?);"; 
				$theme_name = 'Form #'.$form_id.' Theme';

				$params = array($theme_name,$advanced_css);
				$sth = $dbh->prepare($query);
				try{
					$sth->execute($params);
				}catch(PDOException $e) {
					$post_install_error .= $e->getMessage().'<br/><br/>';
				}
				
				$theme_id = (int) $dbh->lastInsertId();

				//create/update the CSS file for the theme
				$css_theme_filename = "./data/themes/theme_{$theme_id}.css";
				$css_theme_content  = mf_theme_get_css_content($dbh,$theme_id);
				
				$fpc_result = @file_put_contents($css_theme_filename,$css_theme_content);
				
				if(!empty($fpc_result)){ //if we're able to write into the css file, set the 'theme_has_css' to 1
					$params = array(1,$theme_id);
					$query = "UPDATE ".MF_TABLE_PREFIX."form_themes SET theme_has_css = ? WHERE theme_id = ?";
					
					$sth = $dbh->prepare($query);
					try{
						$sth->execute($params);
					}catch(PDOException $e) {
						$post_install_error .= $e->getMessage().'<br/><br/>';
					}
				}

				//update ap_forms table to use the new theme
				$query = "UPDATE ".MF_TABLE_PREFIX."forms set form_theme_id=? where form_id=?";

				$params = array($theme_id,$form_id);
				$sth = $dbh->prepare($query);
				try{
					$sth->execute($params);
				}catch(PDOException $e) {
					$post_install_error .= $e->getMessage().'<br/><br/>';
				}
				
			} //end file_exists
		} //end foreach form_id_array



		return $post_install_error;

	}

	/***************************************************************************
	 Changelog 3.0 to 3.2 												   
	 
	 - ap_settings: added 'admin_theme' column
	 - ap_form_elements: added 'element_section_display_in_email' default(0),'element_section_enable_scroll' default(0) column
	 - added .section_scroll_small,.section_scroll_medium,.section_scroll_large definition to all view.css for each form
	 - added .mf_review_section_break definition to all view.css
	 - added .mf_canvas_pad,.mf_sig_wrapper,.mf_sigpad_clear to all view.css
	 - added built-in class, .column_2 to .column_6,.new_row,.hidden,.guidelines_bottom

	 there wasn't any database change within 3.1
	 thus there is only this 3.0 to 3.2 update path
	***************************************************************************/
	
	function do_delta_update_3_0_to_3_2($dbh,$options=array()){

		$post_install_error = '';

		$mf_settings = mf_get_settings($dbh);

		//alter table ap_settings, add new columns
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."settings` ADD COLUMN `admin_theme` varchar(11) DEFAULT NULL;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//alter table ap_form_elements, add new columns
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_elements` 
															ADD COLUMN `element_section_display_in_email` int(1) NOT NULL DEFAULT '0',
  													  		ADD COLUMN `element_section_enable_scroll` int(1) NOT NULL DEFAULT '0';";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//loop through each view.css file and add new classes
		$query  = "select `form_id` from ".MF_TABLE_PREFIX."forms";
		$params = array();
		$sth 	= mf_do_query($query,$params,$dbh);
	
		while($row = mf_do_fetch_result($sth)){
			$form_id = $row['form_id'];
			$form_id_array[] = $form_id;
		}

		$new_css_code = <<<EOT
.section_scroll_small{
	height: 5em;
	overflow-y: scroll;
}
.section_scroll_medium{
	height: 10em;
	overflow-y: scroll;
}
.section_scroll_large{
	height: 20em;
	overflow-y: scroll;
}
#machform_review_table td.mf_review_section_break{
	padding: 10px 5px;
}
.mf_canvas_pad{
	border-radius: 10px;
	cursor: url("../../../js/signaturepad/pen.cur"), crosshair;
  	cursor: url("../../../js/signaturepad/pen.cur") 16 16, crosshair;
}
#machform_review_table .mf_canvas_pad{
  cursor: auto;
}
.mf_sig_wrapper {
	border-radius: 10px;
	border: 1px solid #ccc;
	width: 309px;
	padding-bottom: 0px !important;
	padding: 3px !important;
}
.mf_sigpad_clear{
	margin-left: 280px;
	margin-top: 5px;
	display: block;
}
/** Built-in Class **/
#main_body form li{
	clear: both;
}
#main_body form li.column_2{
  width: 47%;
  float: left;
  clear: none !important;
}
#main_body form li.column_3{
	width: 31%;
	float: left;
	clear: none !important;
}
#main_body form li.column_4{
	width: 22%;
  	float: left;
	clear: none !important;
}
#main_body form li.column_5{
	width: 17%;
	float: left;
	clear: none !important;
}
#main_body form li.column_6{
	width: 14%;
	float: left;
	clear: none !important;
}
#main_body form li.new_row{
	clear: left !important;
}
#main_body form li.hidden{
	display: none;
}
#main_body form li.guidelines_bottom .guidelines
{
	background: none !important;
	border: none !important;
	font-size:105%;
	line-height:100%;
	margin: 0 !important;
    padding: 0 0 5px;
	visibility:visible;
	width:100%;
	position: static;

}
EOT;
		foreach ($form_id_array as $form_id) {
			$target_css_file = $mf_settings['data_dir']."/form_{$form_id}/css/view.css";
			if(file_exists($target_css_file) && is_writable($target_css_file)){
				file_put_contents($target_css_file, $new_css_code, FILE_APPEND);
			}
		}

		return $post_install_error;
	}

	/***************************************************************************
	 Changelog 3.2 to 3.3 												   
	 
	 - new table ap_users
	 - new table ap_permissions
	 - new table ap_entries_preferences
	 - new table ap_form_locks
	 - new table ap_form_sorts

	 - ap_form_filters: added 'user_id' column
	 - ap_column_preferences: added 'user_id' column
	 - ap_form_themes: added 'user_id','theme_is_private' columns 

	 - delete columns from ap_forms: entries_sort_by, entries_enable_filter, entries_filter_type.... move the records into ap_entries_preferences table and set user_id to 1
	 - delete column from ap_settings: form_manager_sort_by and move the record into ap_form_sorts table

	 - copy admin login data to ap_users data and then delete the columns (admin_login,admin_password,cookie_hash), set admin user_id = 1

	 - create index.html file to each "files" folder and to the "data" folder
	***************************************************************************/
	
	function do_delta_update_3_2_to_3_3($dbh,$options=array()){

		$post_install_error = '';

		$mf_settings = mf_get_settings($dbh);

		//1. Create table ap_users
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."users` (
												  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
												  `user_email` varchar(255) NOT NULL DEFAULT '',
												  `user_password` varchar(255) NOT NULL DEFAULT '',
												  `user_fullname` varchar(255) NOT NULL DEFAULT '',
												  `priv_administer` tinyint(1) NOT NULL DEFAULT '0',
												  `priv_new_forms` tinyint(1) NOT NULL DEFAULT '0',
												  `priv_new_themes` tinyint(1) NOT NULL DEFAULT '0',
												  `last_login_date` datetime DEFAULT NULL,
												  `last_ip_address` varchar(15) DEFAULT '',
												  `cookie_hash` varchar(255) DEFAULT '',
												  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - deleted; 1 - active; 2 - suspended',
												  PRIMARY KEY (`user_id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//2. Create table ap_permissions
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."permissions` (
												  `form_id` bigint(11) unsigned NOT NULL,
												  `user_id` int(11) unsigned NOT NULL,
												  `edit_form` tinyint(1) NOT NULL DEFAULT '0',
												  `edit_entries` tinyint(1) NOT NULL DEFAULT '0',
												  `view_entries` tinyint(1) NOT NULL DEFAULT '0',
												  PRIMARY KEY (`form_id`,`user_id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//3. Create table ap_entries_preferences
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."entries_preferences` (
												  `form_id` int(11) NOT NULL,
												  `user_id` int(11) NOT NULL,
												  `entries_sort_by` varchar(100) NOT NULL DEFAULT 'id-desc',
												  `entries_enable_filter` int(1) NOT NULL DEFAULT '0',
												  `entries_filter_type` varchar(5) NOT NULL DEFAULT 'all' COMMENT 'all or any'
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//4. Create table ap_form_locks
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_locks` (
												  `form_id` int(11) NOT NULL,
												  `user_id` int(11) NOT NULL,
												  `lock_date` datetime NOT NULL
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//5. Create table ap_form_sorts
		$query = "CREATE TABLE `".MF_TABLE_PREFIX."form_sorts` (
												  `user_id` int(11) NOT NULL,
												  `sort_by` varchar(25) DEFAULT '',
												  PRIMARY KEY (`user_id`)
												) DEFAULT CHARACTER SET utf8;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}
		
		//6. Alter table ap_form_filters. Add 'user_id' column
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_filters` ADD COLUMN `user_id` int(11) NOT NULL DEFAULT '1';";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//7. Alter table ap_column_preferences. Add 'user_id' column
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."column_preferences` ADD COLUMN `user_id` int(11) NOT NULL DEFAULT '1';";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//8. Alter table ap_form_themes. Add 'user_id' and 'theme_is_private' column
		$query = "ALTER TABLE `".MF_TABLE_PREFIX."form_themes`
													  ADD COLUMN `user_id` int(11) NOT NULL DEFAULT '1',
													  ADD COLUMN `theme_is_private` int(11) NOT NULL DEFAULT '1';";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//9. Alter table ap_forms. Delete columns: entries_sort_by, entries_enable_filter, entries_filter_type 
		//   Move the records into ap_entries_preferences table first and set user_id to 1
		$query = "INSERT INTO ".MF_TABLE_PREFIX."entries_preferences(
													form_id,
													user_id,
													entries_sort_by,
													entries_enable_filter,
													entries_filter_type) 
											  SELECT 
											 		form_id,
											 		'1' as user_id,
											 		entries_sort_by,
											 		entries_enable_filter,
											 		entries_filter_type 
											 	FROM 
											 		".MF_TABLE_PREFIX."forms";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		$query = "ALTER TABLE ".MF_TABLE_PREFIX."forms DROP COLUMN `entries_sort_by`,DROP COLUMN `entries_enable_filter`,DROP COLUMN `entries_filter_type`;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//10. Alter table ap_settings. Delete column 'form_manager_sort_by'
		//    Move the record value into ap_form_sorts table
		$query = "INSERT INTO ".MF_TABLE_PREFIX."form_sorts(user_id,sort_by) SELECT '1' as user_id,form_manager_sort_by FROM ".MF_TABLE_PREFIX."settings";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		$query = "ALTER TABLE ".MF_TABLE_PREFIX."settings DROP COLUMN `form_manager_sort_by`;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//11. Copy admin login data to ap_users and then delete columns: admin_login,admin_password,cookie_hash
		//    Set user_id = 1
		$query = "INSERT INTO 
							 ".MF_TABLE_PREFIX."users(
		   							  user_id,
		   							  user_email,
		   							  user_password,
		   							  user_fullname,
		   							  priv_administer,
		   							  priv_new_forms,
		   							  priv_new_themes,
		   							  cookie_hash,
		   							  `status`)
								SELECT 
									  '1' as user_id,
									  admin_login,
									  admin_password,
									  'Administrator' as user_fullname, 
									  '1' as priv_administer, 
									  '1' as priv_new_forms,
									  '1' as priv_new_themes,
									  cookie_hash,
									  '1' as `status` 
								  FROM 
									  ".MF_TABLE_PREFIX."settings";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		$query = "ALTER TABLE ".MF_TABLE_PREFIX."settings DROP COLUMN `admin_login`,DROP COLUMN `admin_password`,DROP COLUMN `cookie_hash`;";
		$params = array();
		$sth = $dbh->prepare($query);
		try{
			$sth->execute($params);
		}catch(PDOException $e) {
			$post_install_error .= $e->getMessage().'<br/><br/>';
		}

		//12. Loop through each "files" folder and to "data" folder. Create an empty "index.html" file.
		$query = "select `form_id` from ".MF_TABLE_PREFIX."forms";
		$params = array();
		$sth 	= mf_do_query($query,$params,$dbh);
				
		$form_id_array = array();
		while($row = mf_do_fetch_result($sth)){
			$form_id = $row['form_id'];

			if(is_writable($mf_settings['upload_dir']."/form_{$form_id}/files")){
				@file_put_contents($mf_settings['upload_dir']."/form_{$form_id}/files/index.html",' ');
			}
		}

		if(is_writable("./data")){
			@file_put_contents("./data/index.html",' ');
		}

		return $post_install_error;
	}
?>