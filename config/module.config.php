<?php

use YYY\Service\MyServiceYYY;

return array(
    'controllers' => array(
        'invokables' => array(
           
        ),
    ),
    'router' => array(
        'routes' => array(
 
        ),
    ),
    'service_manager'=>array(
        'factories' => array(
            'MyServiceYYY' => function ($sm) {
                $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                $serviceYYY = MyServiceYYY::getInstance();
                $serviceYYY->setDbAdapter($adapter, $sm);
                return $serviceYYY;
            },        
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'YYY' => __DIR__ . '/../view',
        ),
    ),
);
