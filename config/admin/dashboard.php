<?php
return [
      'banner' => [
            'banner' => "Banner chính",
            'secondaryBanner' => "Banner phụ",
            'thirdBanner' => "Banner phụ 2"
      ],

      'navMenu' => [
            [
                  'route' => 'overview.index',
                  'icon' => 'fa fa-th-large',
                  'label' => 'Tổng quan',
            ],
            [
                  'route' => 'adminCategory.index',
                  'icon' => 'fa fa-list',
                  'label' => 'Danh mục',
            ],
            [
                  'route' => 'order.index',
                  'icon' => 'fa fa-first-order',
                  'label' => 'Đơn hàng',
            ],
            [
                  'route' => 'adminproduct.index',
                  'icon' => 'fa fa-book',
                  'label' => 'Sách',
            ],
            [
                  'route' => 'admincomment.index',
                  'icon' => 'fa fa-comments',
                  'label' => 'Bình luận',
            ],
            [
                  'route' => 'adminblog.index',
                  'icon' => 'fa fa-book',
                  'label' => 'Bài viết',
            ],
            [
                  'route' => 'admincoupon.index',
                  'icon' => 'fa fa-ticket',
                  'label' => 'Mã giảm giá',
            ],
            [
                  'route' => 'admintaxonomy.index',
                  'icon' => 'fa fa-book',
                  'label' => 'Tác giả',
            ],
            [
                  'route' => 'adminUser.index',
                  'icon' => 'fa fa-user',
                  'label' => 'Tài Khoản',
            ],
            [
                  'route' => 'admin.banner.index',
                  'icon' => 'fa fa-image',
                  'label' => 'Quản lý banner',
            ],
            [
                  'route' => 'transaction.history', // Assuming this route name exists
                  'icon' => 'fa fa-image',
                  'label' => 'Lịch sử giao dịch',
            ],
      ]

];
