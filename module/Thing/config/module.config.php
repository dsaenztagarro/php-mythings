<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Thing\Controller\Thing' => 'Thing\Controller\ThingController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'thing' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/thing[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Thing\Controller\Thing',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'thing' => __DIR__ . '/../view',
        ),
    ),
);
