<?php

namespace CQRSModule\Service;

use Interop\Container\ContainerInterface;
use RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\AbstractOptions;

abstract class AbstractFactory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var AbstractOptions
     */
    protected $options;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets options from configuration based on name.

     *
     * @param ContainerInterface $container
     * @param string $key
     * @param null|string $name
     * @return AbstractOptions
     * @throws RuntimeException
     */
    public function getOptions(ContainerInterface $container, $key, $name = null)
    {
        if ($name === null) {
            $name = $this->getName();
        }

        $options = $container->get('Configuration');
        $options = $options['cqrs'];
        $options = isset($options[$key][$name]) ? $options[$key][$name] : null;

        if (null === $options) {
            throw new RuntimeException(
                sprintf(
                    'Options with name "%s" could not be found in "cqrs.%s".',
                    $name,
                    $key
                )
            );
        }

        $optionsClass = $this->getOptionsClass();

        return new $optionsClass($options);
    }

    /**
     * Get the class name of the options associated with this factory.
     *
     * @abstract
     * @return string
     */
    abstract public function getOptionsClass();
}
