<?php

namespace CQRSModule\Options;

use CQRS\CommandHandling\SequentialCommandBus;
use Zend\Stdlib\AbstractOptions;

class CommandBus extends AbstractOptions
{
    /** @var string */
    protected $class = SequentialCommandBus::class;

    /** @var string */
    protected $commandHandlerLocator = 'cqrs_default';

    /** @var string */
    protected $transactionManager = 'cqrs_default';

    /** @var string */
    protected $eventPublisher = 'cqrs_default';

    /**
     * @param string $class
     * @return self
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $commandHandlerLocator
     * @return self
     */
    public function setCommandHandlerLocator($commandHandlerLocator)
    {
        $this->commandHandlerLocator = $commandHandlerLocator;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommandHandlerLocator()
    {
        return "cqrs.command_handler_locator.{$this->commandHandlerLocator}";
    }

    /**
     * @param string $transactionManager
     * @return self
     */
    public function setTransactionManager($transactionManager)
    {
        $this->transactionManager = $transactionManager;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionManager()
    {
        return "cqrs.transaction_manager.{$this->transactionManager}";
    }

    /**
     * @param string $eventPublisher
     * @return self
     */
    public function setEventPublisher($eventPublisher)
    {
        $this->eventPublisher = $eventPublisher;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventPublisher()
    {
        return "cqrs.event_publisher.{$this->eventPublisher}";
    }
} 
