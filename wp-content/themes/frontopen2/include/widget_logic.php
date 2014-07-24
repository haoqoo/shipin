<?php

$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'widget-logic', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

global $wl_options;
$wl_load_points=array(	'plugins_loaded'    =>	__( 'when plugin starts (default)', 'widget-logic' ),
                        'after_setup_theme' =>	__( 'after theme loads', 'widget-logic' ),
                        'wp_loaded'         =>	__( 'when all PHP loaded', 'widget-logic' ),
                        'wp_head'           =>	__( 'during page header', 'widget-logic' )
					);

if((!$wl_options = get_option('widget_logic')) || !is_array($wl_options) ) $wl_options = array();

if (is_admin())
{
	add_filter( 'widget_update_callback', 'widget_logic_ajax_update_callback', 10, 3); 				// widget changes submitted by ajax method
	add_action( 'sidebar_admin_setup', 'widget_logic_expand_control');								// before any HTML output save widget changes and add controls to each widget on the widget admin page
	add_action( 'sidebar_admin_page', 'widget_logic_options_control');								// add Widget Logic specific options on the widget admin page
	add_filter( 'plugin_action_links', 'wl_charity', 10, 2);										// add my justgiving page link to the plugin admin page
}
else
{
	if (	isset($wl_options['widget_logic-options-load_point']) &&
			($wl_options['widget_logic-options-load_point']!='plugins_loaded') &&
			array_key_exists($wl_options['widget_logic-options-load_point'],$wl_load_points )
		)
		add_action ($wl_options['widget_logic-options-load_point'],'widget_logic_sidebars_widgets_filter_add');
	else
		widget_logic_sidebars_widgets_filter_add();
		
	if ( isset($wl_options['widget_logic-options-filter']) && $wl_options['widget_logic-options-filter'] == 'checked' )
		add_filter( 'dynamic_sidebar_params', 'widget_logic_widget_display_callback', 10); 			// redirect the widget callback so the output can be buffered and filtered
}

function widget_logic_sidebars_widgets_filter_add()
{
	add_filter( 'sidebars_widgets', 'widget_logic_filter_sidebars_widgets', 10);					// actually remove the widgets from the front end depending on widget logic provided
}
// wp-admin/widgets.php explicitly checks current_user_can('edit_theme_options')
// which is enough security, I believe. If you think otherwise please contact me


// CALLED VIA 'widget_update_callback' FILTER (ajax update of a widget)
function widget_logic_ajax_update_callback($instance, $new_instance, $this_widget)
{	global $wl_options;
	$widget_id=$this_widget->id;
	if ( isset($_POST[$widget_id.'-widget_logic']))
	{	$wl_options[$widget_id]=trim($_POST[$widget_id.'-widget_logic']);
		update_option('widget_logic', $wl_options);
	}
	return $instance;
}


// CALLED VIA 'sidebar_admin_setup' ACTION
// adds in the admin control per widget, but also processes import/export
function widget_logic_expand_control()
{	global $wp_registered_widgets, $wp_registered_widget_controls, $wl_options;


	// EXPORT ALL OPTIONS
	if (isset($_GET['wl-options-export']))
	{
		header("Content-Disposition: attachment; filename=widget_logic_options.txt");
		header('Content-Type: text/plain; charset=utf-8');
		
		echo "[START=WIDGET LOGIC OPTIONS]\n";
		foreach ($wl_options as $id => $text)
			echo "$id\t".json_encode($text)."\n";
		echo "[STOP=WIDGET LOGIC OPTIONS]";
		exit;
	}


	// IMPORT ALL OPTIONS
	if ( isset($_POST['wl-options-import']))
	{	if ($_FILES['wl-options-import-file']['tmp_name'])
		{	$import=split("\n",file_get_contents($_FILES['wl-options-import-file']['tmp_name'], false));
			if (array_shift($import)=="[START=WIDGET LOGIC OPTIONS]" && array_pop($import)=="[STOP=WIDGET LOGIC OPTIONS]")
			{	foreach ($import as $import_option)
				{	list($key, $value)=split("\t",$import_option);
					$wl_options[$key]=json_decode($value);
				}
				$wl_options['msg']= __('Success! Options file imported','widget-logic');
			}
			else
			{	$wl_options['msg']= __('Invalid options file','widget-logic');
			}
			
		}
		else
			$wl_options['msg']= __('No options file provided','widget-logic');
		
		update_option('widget_logic', $wl_options);
		wp_redirect( admin_url('widgets.php') );
		exit;
	}


	// ADD EXTRA WIDGET LOGIC FIELD TO EACH WIDGET CONTROL
	// pop the widget id on the params array (as it's not in the main params so not provided to the callback)
	foreach ( $wp_registered_widgets as $id => $widget )
	{	// controll-less widgets need an empty function so the callback function is called.
		if (!$wp_registered_widget_controls[$id])
			wp_register_widget_control($id,$widget['name'], 'widget_logic_empty_control');
		$wp_registered_widget_controls[$id]['callback_wl_redirect']=$wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback']='widget_logic_extra_control';
		array_push($wp_registered_widget_controls[$id]['params'],$id);	
	}


	// UPDATE WIDGET LOGIC WIDGET OPTIONS (via accessibility mode?)
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
	{	foreach ( (array) $_POST['widget-id'] as $widget_number => $widget_id )
			if (isset($_POST[$widget_id.'-widget_logic']))
				$wl_options[$widget_id]=trim($_POST[$widget_id.'-widget_logic']);
		
		// clean up empty options (in PHP5 use array_intersect_key)
		$regd_plus_new=array_merge(array_keys($wp_registered_widgets),array_values((array) $_POST['widget-id']),
			array('widget_logic-options-filter', 'widget_logic-options-wp_reset_query', 'widget_logic-options-load_point'));
		foreach (array_keys($wl_options) as $key)
			if (!in_array($key, $regd_plus_new))
				unset($wl_options[$key]);
	}

	// UPDATE OTHER WIDGET LOGIC OPTIONS
	// must update this to use http://codex.wordpress.org/Settings_API
	if ( isset($_POST['widget_logic-options-submit']) )
	{	$wl_options['widget_logic-options-filter']=$_POST['widget_logic-options-filter'];
		$wl_options['widget_logic-options-wp_reset_query']=$_POST['widget_logic-options-wp_reset_query'];
		$wl_options['widget_logic-options-load_point']=$_POST['widget_logic-options-load_point'];
	}


	update_option('widget_logic', $wl_options);

}




// CALLED VIA 'sidebar_admin_page' ACTION
// output extra HTML
// to update using http://codex.wordpress.org/Settings_API asap
function widget_logic_options_control()
{	global $wp_registered_widget_controls, $wl_options, $wl_load_points;

	if ( isset($wl_options['msg']))
	{	if (substr($wl_options['msg'],0,2)=="OK")
			echo '<div id="message" class="updated">';
		else
			echo '<div id="message" class="error">';
		echo '<p>Widget Logic – '.$wl_options['msg'].'</p></div>';
		unset($wl_options['msg']);
		update_option('widget_logic', $wl_options);
	}


	?><div class="wrap">
		
		<h2><?php _e('小工具显示判断设置', 'widget-logic'); ?></h2>
        <p><b>使用示例</b></p>
        <p>例如需要一个小工具边栏只在首页显示可以使用is_home()条件，如果需要让这个小工具除了不在首页显示以外，在其他页面都显示则可以使用!is_home()条件</p>
        <p>假如需要有两个条件，则可是使用逻辑符号进行连接。一般使用 && 进行两个条件的连接</p>
        <br />
        <p><b>常用的判断函数条件</b></p>
        <p>
        is_home() - 函数所在的页面是否为主页 <br />
        is_single()  - 是否为内容页（Post） <br /> 
        is_page()  - 是否为内容页（Page） <br /> 
        is_category()  - 是否为Category/Archive页 <br /> 
        is_tag()  - 是否为Tag存档页 <br /> 
        is_date()  - 是否为指定日期存档页 <br /> 
        is_year()  - 是否为指定年份存档页 <br /> 
        is_month()  - 是否为指定月份存档页 <br /> 
        is_day()  - 是否为指定日存档页 <br /> 
        is_time()  - 是否为指定时间存档页 <br /> 
        is_archive()  - 是否为存档页 <br /> 
        is_search()  - 是否为搜索结果页 <br /> 
        is_404()  - 是否为 "HTTP 404： Not Found" 错误页 <br /> 
        is_paged()  - 主页/Category/Archive页是否以多页显示
        </p>
		<form method="POST" style="float:left; width:45%">
			<ul>
				<li><label for="widget_logic-options-filter" title="<?php _e('添加一个新的WP过滤器，你可以在自己的代码中使用。不需要主要的Widget逻辑功能。', 'widget-logic'); ?>">
					<input id="widget_logic-options-filter" name="widget_logic-options-filter" type="checkbox" value="checked" class="checkbox" <?php if (isset($wl_options['widget_logic-options-filter'])) echo "checked" ?>/>
					<?php _e('增加widget内容过滤器', 'widget-logic'); ?>
					</label>
				</li>
				<li><label for="widget_logic-options-wp_reset_query" title="<?php _e('重置一个主题中的自定义查询，以确保后续查询能够正常运行。', 'widget-logic'); ?>">
					<input id="widget_logic-options-wp_reset_query" name="widget_logic-options-wp_reset_query" type="checkbox" value="checked" class="checkbox" <?php if (isset($wl_options['widget_logic-options-wp_reset_query'])) echo "checked" ?> />
					<?php _e('使用\'wp_reset_query\'', 'widget-logic'); ?>
					</label>
				</li>
				<li><label for="widget_logic-options-load_point" title="<?php _e('widget判断条件的加载逻辑', 'widget-logic'); ?>"><?php _e('加载逻辑', 'widget-logic'); ?>
					<select id="widget_logic-options-load_point" name="widget_logic-options-load_point" ><?php
						foreach($wl_load_points as $action => $action_desc)
						{	echo "<option value='".$action."'";
							if (isset($wl_options['widget_logic-options-load_point']) && $action==$wl_options['widget_logic-options-load_point'])
								echo " selected ";
							echo ">".$action_desc."</option>"; // 
						}
						?>
					</select>
					</label>
				</li>
			</ul>
			<?php submit_button( __( '保存WL设置', 'widget-logic' ), 'button-primary', 'widget_logic-options-submit', false ); ?>

		</form>
		<form method="POST" enctype="multipart/form-data" style="float:left; width:45%">
			<a class="submit button" href="?wl-options-export" title="<?php _e('保存当前的显示判断设置', 'widget-logic'); ?>"><?php _e('导出配置文件', 'widget-logic'); ?></a><p>
			<?php submit_button( __( '导入配置文件', 'widget-logic' ), 'button', 'wl-options-import', false, array('title'=> __( '从文件中导入判断显示规则', 'widget-logic' ) ) ); ?>
			<input type="file" name="wl-options-import-file" id="wl-options-import-file" title="<?php _e('Select file for importing', 'widget-logic'); ?>" /></p>
		</form>

	</div>

	<?php
}

// added to widget functionality in 'widget_logic_expand_control' (above)
function widget_logic_empty_control() {}



// added to widget functionality in 'widget_logic_expand_control' (above)
function widget_logic_extra_control()
{	global $wp_registered_widget_controls, $wl_options;

	$params=func_get_args();
	$id=array_pop($params);

	// go to the original control function
	$callback=$wp_registered_widget_controls[$id]['callback_wl_redirect'];
	if (is_callable($callback))
		call_user_func_array($callback, $params);		
	
	$value = !empty( $wl_options[$id ] ) ? htmlspecialchars( stripslashes( $wl_options[$id ] ),ENT_QUOTES ) : '';

	// dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
	$number=$params[0]['number'];
	if ($number==-1) {$number="__i__"; $value="";}
	$id_disp=$id;
	if (isset($number)) $id_disp=$wp_registered_widget_controls[$id]['id_base'].'-'.$number;

	// output our extra widget logic field
	echo "<p><label for='".$id_disp."-widget_logic'>显示判断条件： <textarea class='widefat' type='text' name='".$id_disp."-widget_logic' id='".$id_disp."-widget_logic' >".$value."</textarea></label></p>";
}



// CALLED ON 'plugin_action_links' ACTION
function wl_charity($links, $file)
{	if ($file == plugin_basename(__FILE__))
		array_push($links, '<a href="http://www.justgiving.com/widgetlogic_cancerresearchuk/">Charity Donation</a>');
	return $links;
}



// FRONT END FUNCTIONS...



// CALLED ON 'sidebars_widgets' FILTER
function widget_logic_filter_sidebars_widgets($sidebars_widgets)
{	global $wp_reset_query_is_done, $wl_options;

	// reset any database queries done now that we're about to make decisions based on the context given in the WP query for the page
	if ( !empty( $wl_options['widget_logic-options-wp_reset_query'] ) && ( $wl_options['widget_logic-options-wp_reset_query'] == 'checked' ) && empty( $wp_reset_query_is_done ) )
	{	wp_reset_query(); $wp_reset_query_is_done=true;	}

	// loop through every widget in every sidebar (barring 'wp_inactive_widgets') checking WL for each one
	foreach($sidebars_widgets as $widget_area => $widget_list)
	{	if ($widget_area=='wp_inactive_widgets' || empty($widget_list)) continue;

		foreach($widget_list as $pos => $widget_id)
		{	if (empty($wl_options[$widget_id]))  continue;
			$wl_value=stripslashes(trim($wl_options[$widget_id]));
			if (empty($wl_value))  continue;

			$wl_value=apply_filters( "widget_logic_eval_override", $wl_value );
			if ($wl_value===false)
			{	unset($sidebars_widgets[$widget_area][$pos]);
				continue;
			}
			if ($wl_value===true) continue;

			if (stristr($wl_value,"return")===false)
				$wl_value="return (" . $wl_value . ");";

			if (!eval($wl_value))
				unset($sidebars_widgets[$widget_area][$pos]);
		}
	}
	return $sidebars_widgets;
}



// If 'widget_logic-options-filter' is selected the widget_content filter is implemented...



// CALLED ON 'dynamic_sidebar_params' FILTER - this is called during 'dynamic_sidebar' just before each callback is run
// swap out the original call back and replace it with our own
function widget_logic_widget_display_callback($params)
{	global $wp_registered_widgets;
	$id=$params[0]['widget_id'];
	$wp_registered_widgets[$id]['callback_wl_redirect']=$wp_registered_widgets[$id]['callback'];
	$wp_registered_widgets[$id]['callback']='widget_logic_redirected_callback';
	return $params;
}


// the redirection comes here
function widget_logic_redirected_callback()
{	global $wp_registered_widgets, $wp_reset_query_is_done;

	// replace the original callback data
	$params=func_get_args();
	$id=$params[0]['widget_id'];
	$callback=$wp_registered_widgets[$id]['callback_wl_redirect'];
	$wp_registered_widgets[$id]['callback']=$callback;

	// run the callback but capture and filter the output using PHP output buffering
	if ( is_callable($callback) ) 
	{	ob_start();
		call_user_func_array($callback, $params);
		$widget_content = ob_get_contents();
		ob_end_clean();
		echo apply_filters( 'widget_content', $widget_content, $id);
	}
}



?>