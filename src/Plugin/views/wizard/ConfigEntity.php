<?php

/**
 * @file
 * Definition of Drupal\config_views\Plugin\views\wizard\ConfigEntity.
 */

namespace Drupal\config_views\Plugin\views\wizard;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\wizard\WizardPluginBase;

/**
 * Tests creating configuration entity views with the wizard.
 *
 * @ViewsWizard(
 *   id = "config_entity",
 *   base_table = "config_views",
 *   title = @Translation("Configurations")
 * )
 */
class ConfigEntity extends WizardPluginBase {

  /**
   * Constructs a WizardPluginBase object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->base_table = $this->definition['base_table'];
  }

  /**
   * Overrides Drupal\views\Plugin\views\wizard\WizardPluginBase::getAvailableSorts().
   *
   * @return array
   */
  public function getAvailableSorts() {
    // You can't execute functions in properties, so override the method
    return array(
      'node_field_data-title:DESC' => $this->t('Title')
    );
  }

  /**
   * Overrides Drupal\views\Plugin\views\wizard\WizardPluginBase::rowStyleOptions().
   */
  protected function rowStyleOptions() {
    $options = array();
    return $options;
  }

  /**
   * Overrides Drupal\views\Plugin\views\wizard\WizardPluginBase::buildFilters().
   *
   * Add some options for filter by taxonomy terms.
   */
  protected function buildFilters(&$form, FormStateInterface $form_state) {
    module_load_include('inc', 'views_ui', 'admin');
    $list = $this->listConfigEntity();
    foreach ($list as $type => $definition) {
      $options[$type] = $definition->getLabel();
    }
    asort($options);
    if ($options) {
      $form['displays']['show']['type'] = array(
        '#type' => 'select',
        '#title' => $this->t('of type'),
        '#options' => array('all' => $this->t('All')) + $options,
      );
      $selected_bundle = static::getSelected($form_state, array('show', 'type'), 'all', $form['displays']['show']['type']);
      $form['displays']['show']['type']['#default_value'] = $selected_bundle;
      // Changing this dropdown updates the entire content of $form['displays']
      // via AJAX, since each bundle might have entirely different fields
      // attached to it, etc.
      views_ui_add_ajax_trigger($form['displays']['show'], 'type', array('displays'));
    }
  }

  protected function defaultDisplayFiltersUser(array $form, FormStateInterface $form_state) {
    $filters = array();

    if (($type = $form_state->getValue(array('show','type'))) && $type != 'all') {
      $options = $this->listConfigEntity();
      $config_entity = $options[$type];
      $filters[$type] = array(
        'id' => $config_entity->getKey('id'),
        'value' => $config_entity->getLabel(),
      );
    }
    return $filters;
  }

  /**
   * @return \Drupal\Core\Config\Entity\ConfigEntityType[]
   */
  protected function listConfigEntity() {
    $entity_types = \Drupal::entityManager()->getDefinitions();
    $list = array();
    foreach ($entity_types as $type => $definition) {
      if ($definition->getGroup() == 'configuration') {
        $list[$type] = $definition;
      }
    }
    return $list;
  }

}
