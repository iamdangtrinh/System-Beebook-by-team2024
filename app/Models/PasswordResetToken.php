<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    // Chỉ định tên bảng
    protected $table = 'password_reset_tokens';
    // Các cột được phép điền giá trị
    protected $fillable = ['email', 'token', 'created_at'];
    // Tắt tự động cập nhật timestamp nếu không có cột updated_at
    public $timestamps = false;
}
