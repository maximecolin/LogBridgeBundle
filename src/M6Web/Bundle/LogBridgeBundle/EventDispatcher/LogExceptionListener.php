<?php

namespace M6Web\Bundle\LogBridgeBundle\EventDispatcher;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * LogExceptionListener overload here to send the entire exception to log bridge.
 */
class LogExceptionListener
{
    /**
     * @var string
     */
    protected $requestExceptionAttribute;

    /**
     * @param string $requestExceptionAttribute
     */
    public function __construct($requestExceptionAttribute)
    {
        $this->requestExceptionAttribute = $requestExceptionAttribute;
    }

    /**
     * React to an exception to give error message to log bridge
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();
        $request->setRequestFormat('json');
        $request->attributes->add([$this->requestExceptionAttribute => $event->getException()]);
    }
}
