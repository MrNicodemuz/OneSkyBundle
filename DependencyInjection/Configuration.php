<?php

namespace OpenClassrooms\Bundle\OneSkyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('openclassrooms_onesky');
        
        // Keep compatibility with symfony/config < 4.2
        if (\method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('openclassrooms_onesky');
        }

        $rootNode->children()
            ->scalarNode('api_key')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('api_secret')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('project_id')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('file_format')->cannotBeEmpty()->defaultValue('xliff')->end()
            ->scalarNode('source_locale')->cannotBeEmpty()->defaultValue('en')->end()
            ->arrayNode('locales')->requiresAtLeastOneElement()->cannotBeEmpty()->prototype('scalar')->end()->end()
            ->arrayNode('file_paths')->requiresAtLeastOneElement()->cannotBeEmpty()->prototype('scalar')->end()->end()
            ->scalarNode('keep_all_strings')->cannotBeEmpty()->defaultValue(true)->end()
            ->end();

        return $treeBuilder;
    }
}
