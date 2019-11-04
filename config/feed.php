<?php

/* Simple configuration file for Laravel Sitemap package */
return [
    'use_cache' => true,
    'cache_key' => 'coreblog.feed',
    'cache_duration' => 3600,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => null,
    'use_styles' => true,
    'styles_location' => null,
];
