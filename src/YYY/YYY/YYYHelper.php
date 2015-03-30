<?php
namespace Auth\Acl;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Application;

class YYYHelper extends AbstractListenerAggregate
{
    public $yyy;
    public $_route;
    public $eventManager;
    
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->eventManager = $events; 
        $this->listeners[]  = $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'initYYY'), -100);
        $this->listeners[]  = $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'checkYYY'), -1000);
        $this->listeners[]  = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'attachYYY'), -100);
        $this->listeners[]  = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'handleDispatchError'), -100);
    }

    public function initYYY(MvcEvent $e) 
    {
        $this->_route = $e->getRouteMatch()->getMatchedRouteName();
        /* Your treatment with $e */
    }
    
    public function checkYYY(MvcEvent $e) 
    {
        /* Your treatment with $e */
    }
    
    public function attachYYY(MvcEvent $event)
    {
        $params = [];
        $params['yyy']       = $this->yyy;
                
        $YYYFacade = new YYYFacade($params);
        
        $layout = $event->getViewModel();
        $childView = $event->getViewModel()->getChildren();
        
        /* Send data to all views */
        $childView[0]->YYY              = $this->yyy;
        
        /* Send data to the layout */
        $layout->setVariables([ 'YYY'    => $this->yyy ]);
    }        

    public function handleDispatchError(MvcEvent $e)
    {
        $error  = $e->getError();
        if ($error == Application::ERROR_CONTROLLER_NOT_FOUND) {
            //there is no controller named $e->getRouteMatch()->getParam('controller')
            $logText =  'The requested controller '
                        .$e->getRouteMatch()->getParam('controller'). '  could not be mapped to an existing controller class.';
            //you can do logging, redirect, etc here..
            echo $logText;
        }
         
        if ($error == Application::ERROR_CONTROLLER_INVALID) {
            //the controller doesn't extends AbstractActionController
            $logText =  'The requested controller '
                        .$e->getRouteMatch()->getParam('controller'). ' is not dispatchable';
             
            //you can do logging, redirect, etc here..
            echo $logText;
        }
         
        if ($error == Application::ERROR_ROUTER_NO_MATCH) {
            
            $url = $e->getRouter()->assemble(array(), array('name' => 'error/yyy'));
            $response= $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(404);
            $response->sendHeaders();
            
            $stopCallBack = function($event) use ($response){
                $event->stopPropagation();
                return $response;
            };
            //Attach the "break" as a listener with a high priority
            $this->eventManager->attach(MvcEvent::EVENT_ROUTE, $stopCallBack,-10000);
            return $response;
        }
        if ($error == 'ERROR_NOT_AUTHORIZED') {
            /* Your treatment */
            
        }
    } 
    
}