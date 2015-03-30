<?php

namespace YYY;
 
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\EventManager\EventInterface;
use YYY\YYY\YYYHelper;

class Module implements AutoloaderProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event)
    {
        /* @var $app \Zend\Mvc\ApplicationInterface */
        $app  = $event->getTarget();
        /* @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
        $app->getEventManager()->attach(new YYYHelper);

    }
    
    public function getViewHelperConfig() 
    {
        return array(
        'invokables' => array(
             'YYYHelper' => 'YYY\View\Helper\YYYHelper',
        ));
    }            
    
    /**
     * 
     * Classic config
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
     * 
     * Classic config
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /**
     * 
     * Service config 
     * 
     */
    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                /* declare Services needed here */            
            ),      
        );
    }
 
}