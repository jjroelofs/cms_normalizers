<?php

namespace Drupal\cms_normalizers;

use Drupal\default_content\Normalizer\TermEntityNormalizer as BaseTermEntityNormalizer;

/**
 * Normalizer for Taxonomy term entity.
 */
class TermEntityNormalizer extends BaseTermEntityNormalizer {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = 'Drupal\taxonomy\TermInterface';

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = array()) {
    $normalized = parent::normalize($entity, $format, $context);

    unset(
      $normalized['tid'],
      $normalized['changed'],
      $normalized['default_langcode']
    );

    return $normalized;
  }

}
