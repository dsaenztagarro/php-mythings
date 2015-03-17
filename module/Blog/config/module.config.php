<?php

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'username'       => 'development',
        'password'       => 'development',
        'dsn'            => 'mysql:dbname=zf2blog_development;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),

    'controllers' => array(
        'factories' => array(
            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory',
            'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory'
        ),
    ),

    'router' => array(
        'routes' => array(
            'post' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/blog',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\List',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*'
                            )
                        )
                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\Write',
                                'action'     => 'add'
                            )
                        )
                    )
                )
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'thing' => __DIR__ . '/../view',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'Blog\Mapper\PostMapperInterface'   => 'Blog\Factory\ZendDbSqlMapperFactory',
            'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
            'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    ),

);
