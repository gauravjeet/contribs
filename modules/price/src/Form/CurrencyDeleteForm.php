<?php

namespace Drupal\commerce_price\Form;

use Drupal\Core\Entity\EntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;

class CurrencyDeleteForm extends EntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\Core\Config\Entity\ConfigEntityType $bundle_entity_type */
    $bundle_entity_type = $this->entityTypeManager->getDefinition($this->entity->getEntityTypeId());
    /** @var \Drupal\Core\Entity\ContentEntityType $content_entity_type */
    $content_entity_type = $this->entityTypeManager->getDefinition($bundle_entity_type->getBundleOf());
    $usage_count = $this->entityTypeManager->getStorage($content_entity_type->id())
      ->getQuery()
      ->condition('default_currency', $this->entity->id())
      ->count()
      ->execute();
    if ($usage_count) {
      $caption = '<p>' . $this->formatPlural($usage_count,
          '%type is used by 1 %entity on your site. You cannot remove this %entity_type until you have removed all of the %type %entities.',
          '%type is used by @count %entities on your site. You cannot remove this %entity_type until you have removed all of the %type %entities.',
          [
            '%type' => $this->entity->label(),
            '%entity' => $content_entity_type->getSingularLabel(),
            '%entities' => $content_entity_type->getPluralLabel(),
            '%entity_type' => $content_entity_type->getBundleLabel(),
          ]) . '</p>';
      $form['#title'] = $this->getQuestion();
      $form['description'] = ['#markup' => $caption];
      return $form;
    }

    return parent::buildForm($form, $form_state);
  }

}
