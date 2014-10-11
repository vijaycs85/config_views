<?php

/**
 * @file
 * Definition of Drupal\config_views\Plugin\views\field\Node.
 */

namespace Drupal\config_views\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\field\FieldPluginBase;

/**
 * Field handler to provide simple renderer that allows linking to a entity.
 * Definition terms:
 * - link_to_entity default: Should this field have the checkbox "link to node" enabled by default.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("config_entity")
 */
class ConfigEntity extends FieldPluginBase {

  /**
   * Overrides \Drupal\views\Plugin\views\field\FieldPluginBase::init().
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);

    // Don't add the additional fields to groupby
    if (!empty($this->options['link_to_entity'])) {
      $this->additional_fields['nid'] = array('table' => 'node', 'field' => 'nid');
    }
  }

  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['link_to_entity'] = array('default' => isset($this->definition['link_to_entity default']) ? $this->definition['link_to_entity default'] : FALSE);
    return $options;
  }

  /**
   * Provide link to node option
   */
  public function link_to_entity(&$form, FormStateInterface $form_state) {
    $form['link_to_entity'] = array(
      '#title' => $this->t('Link this field to the original piece of content'),
      '#description' => $this->t("Enable to override this field's links."),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['link_to_entity']),
    );

    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * Prepares link to the entity.
   *
   * @param string $data
   *   The XSS safe string for the link text.
   * @param \Drupal\views\ResultRow $values
   *   The values retrieved from a single row of a view's query result.
   *
   * @return string
   *   Returns a string for the link text.
   */
  protected function renderLink($data, ResultRow $values) {
    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $this->field_alias = $this->field;
    $value = $this->getValue($values);
    return $this->renderLink($this->sanitizeValue($value), $values);
  }

}
