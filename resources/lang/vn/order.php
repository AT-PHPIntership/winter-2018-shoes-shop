<?php

return [
    'title' => 'Quản lý đơn hàng',
    'list' => [
        'title' => 'Danh sách đơn hàng',
    ],
    'table' => [
        'id' => 'Id',
        'user' => 'Người đặt',
        'code' => 'Mã giảm giá',
        'created_at' => 'Ngày đặt',
        'delivered_at' => 'Ngày giao',
        'shipping_address' => 'Địa chỉ',
        'phone_number' => 'Số điện thoại',
        'amount' => 'Tổng tiền',
        'status' => 'Trạng thái',
        'action' => 'Hành động'
    ],
    'show' => [
        'title' => 'Chi tiết đơn hàng',
    ],
    'status' => [
        'pending' => 'Đang chờ',
        'confirmed' => 'Đã xác nhận',
        'processing' => 'Đang xử lý',
        'quality_check' => 'Kiểm tra chất lượng',
        'dispatched_item' => 'Đã gửi hàng',
        'delivered' => 'Đã giao hàng',
        'canceled' => 'Hủy đơn hàng',
    ]
];
