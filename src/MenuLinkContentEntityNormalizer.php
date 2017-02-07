<?php

namespace Drupal\cms_normalizers;

use Drupal\hal\Normalizer\ContentEntityNormalizer;

/**
 * Normalizer for Menu link content entity.
 */
class MenuLinkContentEntityNormalizer extends ContentEntityNormalizer {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = 'Drupal\menu_link_content\MenuLinkContentInterface';

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = array()) {
    $normalized = parent::normalize($entity, $format, $context);

    unset(
      $normalized['id'],
      $normalized['changed'],
      $normalized['default_langcode']
    );

    return $normalized;
  }

}
