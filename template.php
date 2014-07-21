<?php

/**
 * function list:
 *
 * hook_css_alter()
 *
 * template_preprocess_block()
 * template_preprocess_html()
 * template_preprocess_node()
 * template_preprocess_page()
 * template_preprocess_region()
 *
 * theme_menu_link()
 * theme_menu_tree()
 *
 */

/**
 * Implements hook_css_alter().
 */
function ngarang_css_alter(&$css) {
  if (isset($css['modules/system/system.admin.css'])) {
    $css['modules/system/system.admin.css']['data'] = path_to_theme() . '/css/system.admin.css';
  }
  if (isset($css['modules/system/system.base.css'])) {
    $css['modules/system/system.base.css']['data'] = path_to_theme() . '/css/system.base.css';
  }
  if (isset($css['modules/system/system.menus.css'])) {
    $css['modules/system/system.menus.css']['data'] = path_to_theme() . '/css/system.menus.css';
  }
  if (isset($css['modules/system/system.theme.css'])) {
    $css['modules/system/system.theme.css']['data'] = path_to_theme() . '/css/system.theme.css';
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
        'content' => 'width=device-width, initial-scale=1',
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
        //'href' => $base_url . '/humans.txt', // uncomment if humans.txt placed in base dir.
        'href' => $base_url . '/' . path_to_theme() . '/humans.txt', // uncomment if humans.txt placed in theme dir.
      ),
    ),
  );
  foreach ($elements as $name => $element) {
    drupal_add_html_head($element, $name);
  }
  drupal_add_css('http://fonts.googleapis.com/css?family=Open+Sans', array(
    'type' => 'external',
    'every_page' => TRUE
  ));
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
 * Implements template_preprocess_page().
 */
function ngarang_preprocess_page(&$variables, $hook) {
  if (isset($variables['node'])) {
    $variables['theme_hook_suggestions'][] = 'page__' . str_replace('_', '--', $variables['node']->type);
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
 * Implements theme_menu_link().
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

/**
 * Implements theme_menu_tree().
 */
function ngarang_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}
