<?php

    use core\Router;

    Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_pref' => 'admin']);
    Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_pref' => 'admin']);

    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);

    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

