<?php

namespace SpiffyUser\Extension;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;

abstract class AbstractExtension extends AbstractListenerAggregate implements ExtensionInterface
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getOption($name)
    {
        if (!isset($this->options[$name])) {
            throw new Exception\InvalidOptionException(sprintf(
                'Unknown option "%s" for extension "%s"',
                $name,
                $this->getName()
            ));
        }
        return $this->options[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (!isset($this->options[$key])) {
                throw new Exception\InvalidOptionException(sprintf(
                    'Unknown option "%s" for extension "%s"',
                    $key,
                    $this->getName()
                ));
            }
        }
        $this->options = $options;
        return $this;
    }

    /**
     * @param Manager $manager
     * @return $this
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * {@iheritDoc}
     */
    public function getManager()
    {
        return $this->manager;
    }
}