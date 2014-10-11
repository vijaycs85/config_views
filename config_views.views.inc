<?php

/**
 * @file
 * Provide views data for dblog.module.
 */

/**
 * Implements hook_views_data().
 */
function config_views_views_data() {
  $data = array();

  $data['config_views']['table']['group'] = t('Configuration');
  $data['config_views']['table']['wizard_id'] = 'config_entity';
  $data['config_views']['table']['base'] = array(
    'query_id' => 'config_entity_query',
    'field' => 'id',
    'title' => t('Configuration Entity'),
    'help' => t('Contains list of configuration entities.'),
  );

  $data['config_views']['id'] = array(
    'title' => t('Machine name'),
    'help' => t('Unique configuration entity ID.'),
    'field' => array(
      'id' => 'config_entity',
    ),
    'filter' => array(
      'id' => 'string',
    ),
    'argument' => array(
      'id' => 'string',
    ),
    'sort' => array(
      'id' => 'standard',
    ),
    'search' => array(
      'id' => 'standard',
    ),
  );

  $data['config_views']['name'] = array(
    'title' => t('Name'),
    'help' => t('Name'),
    'field' => array(
      'id' => 'config_entity',
    ),
    'filter' => array(
      'id' => 'string',
    ),
    'argument' => array(
      'id' => 'string',
    ),
    'sort' => array(
      'id' => 'standard',
    ),
    'search' => array(
      'id' => 'standard',
    ),
  );

  $data['config_views']['description'] = array(
    'title' => t('Description'),
    'help' => t('Description'),
    'field' => array(
      'id' => 'config_entity',
    ),
    'filter' => array(
      'id' => 'string',
    ),
    'argument' => array(
      'id' => 'string',
    ),
    'sort' => array(
      'id' => 'standard',
    ),
    'search' => array(
      'id' => 'standard',
    ),
  );

  $data['config_views']['operation'] = array(
    'title' => t('Operations'),
    'help' => t('Operations'),
    'field' => array(
      'id' => 'config_entity',
    ),
  );


  return $data;

}

