<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Không tìm thấy nội dung</title>
    <style>
        .title {
            font-size: 10rem;
            font-weight: 800;
            background: linear-gradient(to right, #ff6565, #ffa849, #ffeb3b, #7fc9ff);
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            margin-bottom: 0;
        }

        .lead {
            font-size: 1.5rem !important;
            font-weight: bold !important;
            margin-bottom: 20px !important;
            color: #000000 !important;
        }

        p {
            color: #666666;
        }

        .emoji {
            font-size: 2rem;
            margin-left: 10px;
            vertical-align: middle;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .__custom_container {
            align-items: center;
            display: flex;
            flex-direction: column;
            height: 46vh;
            justify-content: center;
        }
    </style>
    @include('Client.components.header')
    <div class="container __custom_container">
        <h1 class="title">404</h1>
        <p class="lead">Không tìm thấy nội dung <span class="emoji">😓</span></p>
        <p>URL của nội dung này đã bị thay đổi hoặc không còn tồn tại.</p>
        <p>Nếu bạn đang lưu URL này, hãy thử truy cập lại từ trang chủ thay vì dùng URL đã lưu.</p>
        <a href="/" class="btn btn-primary">Về trang chủ</a>
    </div>
    @include('Client.components.footer')
