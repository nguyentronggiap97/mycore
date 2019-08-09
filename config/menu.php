<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Define menu navigation for frontend
    |--------------------------------------------------------------------------
    */

    'frontend' => [
        '/home' => [
            'text' => 'Home',
            'icon' => '',
        ],
        '/accounts' => [
            'text' => 'Account',
            'icon' => '',
        ],
        '/suppliers' => [
            'text' => 'Supplier',
            'icon' => '',
        ],
        '/retailers' => [
            'text' => 'Retailer',
            'icon' => '',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define menu navigation for backend
    |--------------------------------------------------------------------------
    */
    'backend' => [
        /**
         * Dashboard section
         */
        ':dashboard' => [
            'type' => 'header',
            'text' => 'DASHBOARD',
            'can' => 'backend.view',
        ],
        '/' => [
            'type' => 'item',
            'text' => 'Dashboard',
            'icon' => 'ion ion-ios-home',
            'can' => 'backend.view',
        ],
        '/post' => [
            'type' => 'item',
            'text' => 'Bài viết',
            'icon' => 'ion ion-ios-list-outline',
            'can' => 'post.view',
        ],
        '/adsense' => [
            'type' => 'item',
            'text' => 'Quảng cáo',
            'icon' => 'ion ion-ios-flame-outline',
            'can' => 'adsense.view',
        ],
        /**
         * Bookcase section
         */
        ':bookcases' => [
            'type' => 'header',
            'text' => 'BOOKCASE',
            'can' => 'backend.admin',
        ],
        '/bookcases' => [
            'type' => 'item',
            'text' => 'Tủ sách',
            'icon' => 'ion ion-ios-bookmarks-outline',
            'can' => 'bookcase.view',
        ],
        '/classes' => [
            'type' => 'item',
            'text' => 'Lớp học',
            'icon' => 'ion ion-ios-color-filter-outline',
            'can' => 'classroom.view',
        ],
        '/schools' => [
            'type' => 'item',
            'text' => 'Trường học',
            'icon' => 'ion ion-ios-people-outline',
            'can' => 'school.view',
        ],
        '/publishers' => [
            'type' => 'item',
            'text' => 'Nhà xuất bản',
            'icon' => 'ion ion-ribbon-a',
            'can' => 'publisher.view',
        ],
        '/sponsors' => [
            'type' => 'item',
            'text' => 'Nhà tài trợ',
            'icon' => 'ion ion-ribbon-b',
            'can' => 'sponsor.view',
        ],
        '/reports' => [
            'type' => 'item',
            'text' => 'Thống kê',
            'icon' => 'ion ion-ios-pie',
            'can' => 'publisher.view',
        ],
        /**
         * Commerce section
         */
        ':commerce' => [
            'type' => 'header',
            'text' => 'STORE',
            'can' => 'product.view',
        ],
        '/carts' => [
            'type' => 'item',
            'text' => 'Giỏ hàng',
            'icon' => 'ion ion-ios-cart',
            'can' => 'cart.view',
        ],
        '/orders' => [
            'type' => 'item',
            'text' => 'Đơn hàng',
            'icon' => 'ion ion-bag',
            'can' => 'order.view',
        ],
        '/products' => [
            'type' => 'item',
            'text' => 'Bán sách',
            'icon' => 'ion ion-ios-book',
            'can' => 'product.view',
        ],
        '/campaigns' => [
            'type' => 'item',
            'text' => 'Chiến dịch',
            'icon' => 'ion ion-ios-analytics-outline',
            'can' => 'product.view',
        ],
        /**
         * Manager section
         */
        ':manager' => [
            'type' => 'header',
            'text' => 'MANAGER',
            'can' => 'backend.admin',
        ],
        ':management' => [
            'type' => 'tree',
            'text' => 'System',
            'icon' => 'ion ion-ios-people',
            'can' => 'backend.admin',
            'items' => [
                '/users' => [
                    'type' => 'item',
                    'text' => 'Users',
                    'icon' => 'ion ion-ios-people',
                    'can' => 'user.view',
                ],
                '/roles' => [
                    'type' => 'item',
                    'text' => 'Roles',
                    'icon' => 'ion ion-ios-personadd',
                    'can' => 'role.view',
                ],
                '/perms' => [
                    'type' => 'item',
                    'text' => 'Perms',
                    'icon' => 'ion ion-ios-filing',
                    'can' => 'perm.view',
                ],
                '/menu' => [
                    'type' => 'item',
                    'text' => 'Menu',
                    'icon' => 'ion ion-ios-filing',
                    'can' => 'perm.view',
                ],
            ]
        ],
        /**
         * E-commerce config sections
         */
        ':config' => [
            'type' => 'tree',
            'text' => 'Settings',
            'icon' => 'ion ion-ios-cog',
            'can' => 'backend.admin',
            'items' => [
                '/banner' => [
                    'type' => 'item',
                    'text' => 'Banner',
                    'icon' => 'ion ion-ios-browsers-outline',
                    'can' => 'banner.view',
                ],
                '/tag' => [
                    'type' => 'item',
                    'text' => 'Tags',
                    'icon' => 'ion ion-ios-list-outline',
                    'can' => 'tag.view',
                ],
                '/category' => [
                    'type' => 'item',
                    'text' => 'Category',
                    'icon' => 'ion ion-ios-list-outline',
                    'can' => 'category.view',
                ],
                '/collections' => [
                    'type' => 'item',
                    'text' => 'Collections',
                    'icon' => 'ion ion-ios-list-outline',
                    'can' => 'collection.view',
                ],
                '/attributes' => [
                    'type' => 'item',
                    'text' => 'Attribute',
                    'icon' => 'ion ion-ios-analytics-outline',
                    'can' =>  'attribute.view',
                ],
                '/locations' => [
                    'type' => 'item',
                    'text' => 'Location',
                    'icon' => 'ion ion-location',
                    'can' => 'location.view',
                ],
                '/currency' => [
                    'type' => 'item',
                    'text' => 'Currency',
                    'icon' => 'ion ion-social-usd-outline',
                    'can' => 'currency.view',
                ],
                '/payments' => [
                    'type' => 'item',
                    'text' => 'Payment',
                    'icon' => 'ion ion-ios-pie-outline',
                    'can' => 'payment.view',
                ],
                '/delivery' => [
                    'type' => 'item',
                    'text' => 'Delivery',
                    'icon' => 'ion ion-compass',
                    'can' => 'delivery.view',
                ],
                '/shipping' => [
                    'type' => 'item',
                    'text' => 'Shipping',
                    'icon' => 'ion ion-android-car',
                    'can' => 'shipping.view',
                ],
                '/templates' => [
                    'type' => 'item',
                    'text' => 'Templates',
                    'icon' => 'ion ion-ios-browsers-outline',
                    'can' => 'template.view',
                ],
                '/settings' => [
                    'type' => 'item',
                    'text' => 'Settings',
                    'icon' => 'ion ion-ios-gear',
                    'can' => 'setting.view',
                ],
            ]
        ],
    ],
];
