<?php
/*
 * This file is part of ThraceComponentBundle
 *
 * (c) Nikolay Georgiev <symfonist@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Thrace\ComponentBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Container;

/**
 * Twig extension
 *
 * @author Nikolay Georgiev <symfonist@gmail.com>
 * @since 1.0
 */
class FlagTranslationExtension extends \Twig_Extension
{

    /**
     * @var \Symfony\Component\DependencyInjection\Container
     */
    protected $container;

    /**
     * Construct
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function convertToYesNo($value)
    {
        $value = (int) $value;
        
        if ($value){
            return $this->container->get('translator')
                ->trans('twig.extension.yes_no.yes', array(), 'ThraceComponentBundle');
        } 
        
        return $this->container->get('translator')
            ->trans('twig.extension.yes_no.no', array(), 'ThraceComponentBundle');
        
    }
    
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'yes_no' => new \Twig_Filter_Method($this, 'convertToYesNo'),
        );
    }

    /**
     * (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'thrace_flag_translation_extension';
    }
}
