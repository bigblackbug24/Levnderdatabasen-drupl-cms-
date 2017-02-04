<?php

function leverandors_theme(&$existing, $type, $theme, $path) {
    
  $hooks['user_login_block'] = array(
    'template' => 'templates/user-login-block',
    'render element' => 'form',
  );
  
  $hooks['user_login'] = array(
	  'render element' => 'form',
	  'path' => drupal_get_path('theme', 'leverandors') . '/templates',
	  'template' => 'user-login',
	  'preprocess functions' => array(
		  'yourthemename_preprocess_user_login'
	  )
  );

  return $hooks;

}

function leverandors_preprocess_page() 
{  
	if( !empty($vars['node'])) {
		$vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
  	}

  	if ($user->uid != 0) {
		$new_links['logout-link'] = array(
      		'attributes' => array('title' => 'Logout link'), 
      		'href' => 'logout', 
      		'title' => 'Logout'
    	);
	} else {
		$new_links['login-link'] = array(
      		'attributes' => array('title' => 'Login link'), 
			'href' => 'user', 
			'title' => 'Login'
		);
	}
	
}

function bloglist_block($op='list', $delta=0) { 

  // listing of blocks, such as on the admin/system/block page 
  if ($op == "list") { 
    $block[0]["info"] = t("Blog List"); 
    return $block; 
  } else { 
  // our block content 

    // content variable that will be returned for display 
    $block_content = ''; 

    // Get list of blogs 
    $query = "SELECT nid, title, created FROM " . 
             "{node} WHERE type = 'blog'"; 

    // get the links 
    $queryResult =  db_query($query); 
    while ($links = db_fetch_object($queryResult)) { 
      $block_content .= '< a href="'.url('node/view/'.$links->nid).'" >'. 
                        $links->title . '< /a>< br />'; 
    } 
	
    // set up the block 
    $block['subject'] = 'Blog List'; 
    $block['content'] = $block_content; 
    return $block; 
  } 
}
 
function leverandors_preprocess_user_login_block(&$vars) {
  // For debug only
  //print '<pre>';
  //print_r($vars['form']);
  //print '</pre>';
  //exit;
  $vars['name'] = render($vars['form']['name']);
  $vars['pass'] = render($vars['form']['pass']);
  $vars['submit'] = render($vars['form']['actions']['submit']);
  $vars['rendered'] = drupal_render_children($vars['form']);
  
}
