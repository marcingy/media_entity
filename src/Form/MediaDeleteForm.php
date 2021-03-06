<?php

/**
 * @file
 * Contains \Drupal\media_entity\Form\MediaDeleteForm.
 */

namespace Drupal\media_entity\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\media_entity\Entity\MediaBundle;

/**
 * Provides a form for deleting a media.
 */
class MediaDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete %title?', array('%title' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return $this->entity->urlInfo();
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();
    $bundle = MediaBundle::getLabel($this->entity);
    drupal_set_message(t('@type %title has been deleted.', array('@type' => $bundle, '%title' => $this->entity->label())));
    $form_state->setRedirect('<front>');
  }

}
