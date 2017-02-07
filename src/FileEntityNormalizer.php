<?php

namespace Drupal\cms_normalizers;

use Drupal\better_normalizers\Normalizer\FileEntityNormalizer as BaseFileEntityNormalizer;

/**
 * Normalizer for File entity.
 */
class FileEntityNormalizer extends BaseFileEntityNormalizer {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = 'Drupal\file\FileInterface';

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = array()) {
    $normalized = parent::normalize($entity, $format, $context);

    $uid_relation = 'http://drupal.org/rest/relation/file/file/uid';
    unset(
      $normalized['_links'][$uid_relation],
      $normalized['_embedded'][$uid_relation],
      $normalized['fid'],
      $normalized['created'],
      $normalized['changed']
    );

    // Assign files to admin account since we don't export user entities.
    $normalized['uid'][0]['target_id'] = "1";

    return $normalized;
  }

}
