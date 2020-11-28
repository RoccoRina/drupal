<?php

namespace Drupal\custom_rina\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a custom slogan block.
 *
 * @Block(
 *   id = "custom_rina_custom_slogan",
 *   admin_label = @Translation("Custom Slogan"),
 *   category = @Translation("Custom")
 * )
 */
class CustomSloganBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->configFactory = $container->get('config.factory');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $config = $this->configFactory->get('system.site');
    $build['site_mail'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $config->get('mail'),
      '#attributes' => [
        'class' => ['mail'],
      ],
    ];
    $build['site_slogan'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $config->get('slogan'),
      '#attributes' => [
        'class' => ['slogan'],
      ],
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(
      parent::getCacheTags(),
      $this->configFactory->get('system.site')->getCacheTags()
    );
  }

}
