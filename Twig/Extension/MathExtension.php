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

use Thrace\ComponentBundle\Util\Math;

use Symfony\Component\DependencyInjection\Container;

/**
 * Twig extension
 *
 * @author Nikolay Georgiev <symfonist@gmail.com>
 * @since 1.0
 */
class MathExtension extends \Twig_Extension
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

    public function calculatePercentage($amount, $total)
    {
        return Math::calculatePercentage($amount, $total);
    }
    
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFunctions ()
    {
        return array(
            'thrace_calculate_percentage' => new \Twig_Function_Method($this, 'calculatePercentage',
                array('is_safe' => array('html'))
            )
        );
    }

    /**
     * (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'thrace_math_extension';
    }
}
