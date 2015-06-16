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
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'is_visible',
                1 => 'page',
                2 => 'page_size',
            ),
            'page_size' => 25,
            'page_size_param' => 'page_size',
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
            'BlogServices\\Post\\PostEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.post',
                'route_identifier_name' => 'post_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'BlogServices\\Post\\PostCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.post',
                'route_identifier_name' => 'post_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'BlogApi\\V1\\Rest\\Post\\Controller' => array(
            'input_filter' => 'BlogApi\\V1\\Rest\\Post\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'BlogApi\\V1\\Rest\\Post\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'content',
                'description' => 'The blog post content',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'is_visible',
                'description' => 'Is this post visible to users?',
            ),
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '200',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'title',
            ),
            3 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '80',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'author',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'BlogApi\\V1\\Rest\\Post\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
        ),
    ),
);
