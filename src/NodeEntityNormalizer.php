<?php

namespace Drupal\cms_normalizers;

use Drupal\hal\Normalizer\ContentEntityNormalizer;

/**
 * Normalizer for Node entity.
 */
class NodeEntityNormalizer extends ContentEntityNormalizer {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = 'Drupal\node\NodeInterface';

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = array()) {
    $normalized = parent::normalize($entity, $format, $context);

    $node_relation_prefix = 'http://drupal.org/rest/relation/node/' . $entity->getType();
    unset(
      $normalized['nid'],
      $normalized['vid'],
      $normalized['_links'][$node_relation_prefix . '/uid'],
      $normalized['_links'][$node_relation_prefix . '/revision_uid'],
      $normalized['_embedded'][$node_relation_prefix . '/uid'],
      $normalized['_embedded'][$node_relation_prefix . '/revision_uid'],
      $normalized['created'],
      $normalized['changed'],
      $normalized['revision_timestamp'],
      $normalized['revision_translation_affected'],
      $normalized['default_langcode']
    );

    // Assign nodes to admin account since we don't export user entities.
    $normalized['uid'][0]['target_id'] = "1";

    return $normalized;
  }

}
