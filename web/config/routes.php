<?php

use core\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_pref' => 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_pref' => 'admin']);

Router::add('^(?P<lang>[a-z]+)?/?product/(?P<slug>[a-z0-9-_]+)/?$', ['controller' => 'Product', 'action' => 'item']);

Router::add('^(?P<lang>[a-z]+)?/?category/(?P<slug>[a-z0-9-_]+)/?$', ['controller' => 'Category', 'action' => 'view']);

Router::add('^(?P<lang>[a-z]+)?/?$', ['controller' => 'Main', 'action' => 'index']);

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)/?$');
Router::add('^(?P<lang>[a-z]+)/?(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
