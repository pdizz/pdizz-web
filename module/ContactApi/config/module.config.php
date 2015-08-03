<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'ContactApi\\V1\\Rest\\Contact\\ContactResource' => 'ContactApi\\V1\\Rest\\Contact\\ContactResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'contact-api.rest.contact' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/contact[/:contact_id]',
                    'defaults' => array(
                        'controller' => 'ContactApi\\V1\\Rest\\Contact\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'contact-api.rest.contact',
        ),
    ),
    'zf-rest' => array(
        'ContactApi\\V1\\Rest\\Contact\\Controller' => array(
            'listener' => 'ContactApi\\V1\\Rest\\Contact\\ContactResource',
            'route_name' => 'contact-api.rest.contact',
            'route_identifier_name' => 'contact_id',
            'collection_name' => 'contact',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'page_size',
                1 => 'page',
            ),
            'page_size' => 25,
            'page_size_param' => 'page_size',
            'entity_class' => 'ContactServices\\ContactEntity',
            'collection_class' => 'ContactServices\\ContactCollection',
            'service_name' => 'Contact',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'ContactApi\\V1\\Rest\\Contact\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'ContactApi\\V1\\Rest\\Contact\\Controller' => array(
                0 => 'application/vnd.contact-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'ContactApi\\V1\\Rest\\Contact\\Controller' => array(
                0 => 'application/vnd.contact-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'ContactApi\\V1\\Rest\\Contact\\ContactEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'contact-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'ContactApi\\V1\\Rest\\Contact\\ContactCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'contact-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'is_collection' => true,
            ),
            'ContactServices\\ContactEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'contact-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'ContactServices\\ContactCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'contact-api.rest.contact',
                'route_identifier_name' => 'contact_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'ContactApi\\V1\\Rest\\Contact\\Controller' => array(
            'input_filter' => 'ContactApi\\V1\\Rest\\Contact\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'ContactApi\\V1\\Rest\\Contact\\Validator' => array(
            0 => array(
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
                'name' => 'name',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'email',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'message',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'ContactApi\\V1\\Rest\\Contact\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
);
