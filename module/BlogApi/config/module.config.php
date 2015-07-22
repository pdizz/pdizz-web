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
            'blog-api.rest.asset' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/blog/asset[/:asset_id]',
                    'defaults' => array(
                        'controller' => 'BlogApi\\V1\\Rest\\Asset\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'blog-api.rest.post',
            1 => 'blog-api.rest.asset',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'BlogApi\\V1\\Rest\\Asset\\AssetHalListener' => 'BlogApi\\V1\\Rest\\Asset\\AssetHalListener',
        ),
        'factories' => array(
            'BlogApi\\V1\\Rest\\Post\\PostResource' => 'BlogApi\\V1\\Rest\\Post\\PostResourceFactory',
            'BlogApi\\V1\\Rest\\Asset\\AssetResource' => 'BlogApi\\V1\\Rest\\Asset\\AssetResourceFactory',
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
        'BlogApi\\V1\\Rest\\Asset\\Controller' => array(
            'listener' => 'BlogApi\\V1\\Rest\\Asset\\AssetResource',
            'route_name' => 'blog-api.rest.asset',
            'route_identifier_name' => 'asset_id',
            'collection_name' => 'asset',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'DELETE',
                2 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'page_size',
                1 => 'page',
                2 => 'blog_post_id',
            ),
            'page_size' => 25,
            'page_size_param' => 'page_size',
            'entity_class' => 'BlogServices\\Asset\\AssetEntity',
            'collection_class' => 'BlogServices\\Asset\\AssetCollection',
            'service_name' => 'Asset',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'BlogApi\\V1\\Rest\\Post\\Controller' => 'HalJson',
            'BlogApi\\V1\\Rest\\Asset\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'BlogApi\\V1\\Rest\\Post\\Controller' => array(
                0 => 'application/vnd.blog-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'BlogApi\\V1\\Rest\\Asset\\Controller' => array(
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
            'BlogApi\\V1\\Rest\\Asset\\Controller' => array(
                0 => 'application/vnd.blog-api.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
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
            'BlogApi\\V1\\Rest\\Asset\\AssetEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.asset',
                'route_identifier_name' => 'asset_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'BlogApi\\V1\\Rest\\Asset\\AssetCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.asset',
                'route_identifier_name' => 'asset_id',
                'is_collection' => true,
            ),
            'BlogServices\\Asset\\AssetEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.asset',
                'route_identifier_name' => 'asset_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'BlogServices\\Asset\\AssetCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'blog-api.rest.asset',
                'route_identifier_name' => 'asset_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'BlogApi\\V1\\Rest\\Post\\Controller' => array(
            'input_filter' => 'BlogApi\\V1\\Rest\\Post\\Validator',
        ),
        'BlogApi\\V1\\Rest\\Asset\\Controller' => array(
            'input_filter' => 'BlogApi\\V1\\Rest\\Asset\\Validator',
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
        'BlogApi\\V1\\Rest\\Asset\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'blog_post_id',
            ),
            1 => array(
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\File\\IsImage',
                        'options' => array(),
                    ),
                ),
                'type' => 'Zend\\InputFilter\\FileInput',
                'allow_empty' => false,
                'continue_if_empty' => false,
                'name' => 'file',
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
            'BlogApi\\V1\\Rest\\Asset\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => true,
                ),
            ),
        ),
    ),
);
