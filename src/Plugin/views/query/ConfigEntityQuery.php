<?php

/**
 * @file
 * Contains \Drupal\config_views\Plugin\views\query\ConfigEntityQuery.
 */

namespace Drupal\config_views\Plugin\views\query;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\Core\Database\DatabaseExceptionWrapper;
use Drupal\views\Plugin\views\join\JoinPluginBase;
use Drupal\views\Plugin\views\HandlerBase;
use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;
use Drupal\views\Views;
use Drupal\views\Plugin\views\query\QueryPluginBase;

/**
 * Views query plugin for an SQL query.
 *
 * @ingroup views_query_plugins
 *
 * @ViewsQuery(
 *   id = "config_entity_query",
 *   title = @Translation("Configuration entity query"),
 *   help = @Translation("Query will be generated and run using the Drupal database API.")
 * )
 */
class ConfigEntityQuery extends QueryPluginBase {
  /**
   * {@inheritdoc}
   */
  function execute(ViewExecutable $view) {

    $results = array(
      array(
        'id' => '1',
        'name' => 'name1',
        'description' => 'ddd1',
        'operation' => 'ddd1',
      ),
      array(
        'id' => '2',
        'name' => 'name2',
        'description' => 'ddd2',
        'operation' => 'ddd2',
      ),
      array(
        'id' => '3',
        'name' => 'name',
        'description' => 'ddd',
        'operation' => 'ddd',
      ),
      array(
        'id' => '4',
        'name' => 'name',
        'description' => 'ddd',
        'operation' => 'ddd',
      ),
    );

    foreach ($results as $result) {
      $view->result[] = new ResultRow($result);
    }
  }


  public function ensureTable($table, $relationship = NULL, JoinPluginBase $join = NULL) {
    return;
  }

  public function addField($table, $field, $alias = '', $params = array()) {
    return $alias;
  }
}
