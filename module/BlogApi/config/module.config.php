<?php
return array(
    'router' => array(
        'routes' => array(
            'blog-api.rest.post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/blog/post[/:post_id]',
                    'defaults' => array(
                        'controller' => 'BlogApi\\V1\\Rest\\Post\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'blog-api.rest.post',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'BlogApi\\V1\\Rest\\Post\\PostResource' => 'BlogApi\\V1\\Rest\\Post\\PostResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'BlogApi\\V1\\Rest\\Post\\Controller' => array(
            'listener' => 'BlogApi\\V1\\Rest\\Post\\PostResource',
            'route_name' => 'blog-api.rest.post',
            'route_identifier_name' => 'post_id',
            'collection_name' => 'post',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'BlogServices\\Post\\PostEntity',
            'collection_class' => 'BlogServices\\Post\\PostCollection',
            'service_name' => 'Post',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'BlogApi\\V1\\Rest\\Post\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'BlogApi\\V1\\Rest\\Post\\Controller' => array(
                0 => 'application/vnd.blog-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'BlogApi\\V1\\Rest\\Post\\Controller' => array(
                0 => 'application/vnd.blog-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'BlogApi\\V1\\Rest\\Post\\PostEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.post',
                'route_identifier_name' => 'post_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'BlogApi\\V1\\Rest\\Post\\PostCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.post',
                'route_identifier_name' => 'post_id',
                'is_collection' => true,
            ),
        ),
    ),
);
