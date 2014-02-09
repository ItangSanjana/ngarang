<?php

/**
 * Implements template_preprocess_html().
 */
function ngarang_preprocess_html(&$variables) {
  global $base_url;
  $elements = array(
    'MobileOptimized' => array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'MobileOptimized',
        'content' => 'width',
      ),
    ),
    'HandheldFriendly' => array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'HandheldFriendly',
        'content' => 'true',
      ),
    ),
    'viewport' => array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'viewport',
        'content' => 'initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, width=device-width',
      ),
    ),
    'cleartype' => array(
      '#tag' => 'meta',
      '#attributes' => array(
        'http-equiv' => 'cleartype',
        'content' => 'on',
      ),
    ),
    'humans_txt' => array(
      '#tag' => 'link',
      '#attributes' => array(
        'type' => 'text/plain',
        'rel' => 'author',
        //'href' => $base_url . '/humans.txt',
        'href' => $base_url . '/' . path_to_theme() . '/humans.txt',
      ),
    ),
  );
  foreach ($elements as $name => $element) {
    drupal_add_html_head($element, $name);
  }
  drupal_add_css(path_to_theme() . '/css/ie.css', array(
    'group' => CSS_THEME, 'browsers' => array(
      'IE' => 'lte IE 8',
      '!IE' => FALSE
    ),
    'weight' => 999,
    'preprocess' => FALSE
  ));
  drupal_add_css(path_to_theme() . '/css/ie7.css', array(
    'group' => CSS_THEME, 'browsers' => array(
      'IE' => 'lte IE 7',
      '!IE' => FALSE
    ),
    'weight' => 999,
    'preprocess' => FALSE
  ));
  drupal_add_css(path_to_theme() . '/css/ie6.css', array(
    'group' => CSS_THEME, 'browsers' => array(
      'IE' => 'lte IE 6',
      '!IE' => FALSE
    ),
    'weight' => 999,
    'preprocess' => FALSE
  ));
}

/**
 * Implements template_preprocess_page().
 */
function ngarang_preprocess_page(&$variables, $hook) {
  if (isset($variables['node'])) {
    $variables['theme_hook_suggestions'][] = 'page__' . str_replace('_', '--', $variables['node']->type);
  }
}

/**
 * Implements template_preprocess_node().
 */
function ngarang_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'teaser') {
    $variables['classes_array'][] = 'node-row-' . $variables['id'];
    $variables['title_attributes_array']['class'][] = 'title';
    $variables['title_attributes_array']['class'][] = 'title-node';
  }
  if ($variables['view_mode'] == 'teaser' ||
      !empty($variables['content']['comments']['comment_form'])) {
    unset($variables['content']['links']['comment']['#links']['comment-add']);
  }
}

/**
 * Implements template_preprocess_region().
 */
function ngarang_preprocess_region(&$variables) {
  if ($variables['region'] == 'header' ||
      $variables['region'] == 'footer') {
    $variables['classes_array'][] = 'grid';
  }
}

/**
 * Implements template_preprocess_block().
 */
function ngarang_preprocess_block(&$variables) {
  if ($variables['block']->subject != '') {
    $variables['title_attributes_array']['class'][] = 'title';
    $variables['title_attributes_array']['class'][] = 'title-block';
  }
}

/**
 * Implements theme_menu_tree().
 */
function ngarang_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements hook_menu_link().
 */
function ngarang_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  $element['#attributes']['class'][] = 'menu-' . $element['#original_link']['mlid'];
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
