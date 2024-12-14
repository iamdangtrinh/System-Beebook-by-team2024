<title>
    @yield('title', 'Cấu hình website')</title>
@extends('layout.admin')

@section('body')
    <h3>Cấu hình admin</h3>
    {{-- email gửi --}}
    {{-- Phí vận chuyển --}}
    {{-- Ví sepay  --}}
    <div class="">
        <form action="{{ route('admin.settings.udpate') }}" method="post">
            @csrf
            <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                @if ($errors->any())
                    <ul class="alert nav d-block alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            @php
                $fields = [
                    [
                        'label' => 'Email admin nhận đơn hàng',
                        'id' => 'email',
                        'name' => 'email_admin',
                        'value' => $email_admin->value ?? '',
                        'inputGroupText' => 'Email',
                        'required' => true,
                    ],
                    [
                        'label' => 'Phí vận chuyển',
                        'id' => 'fee-shipping',
                        'name' => 'fee-shipping',
                        'value' => $feeShipping->value ?? '',
                        'inputGroupText' => 'VNĐ',
                        'required' => true,
                    ],
                ];
            @endphp

            @foreach ($fields as $field)
                <div class="col-xl-3 col-md-6 col-sm-12 mb-3">
                    <label for="{{ $field['id'] }}">{{ $field['label'] }} @if ($field['required'])
                            <span class="text-danger">*</span>
                        @endif
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="{{ $field['id'] }}Nomorl">{{ $field['inputGroupText'] }}</span>
                        <input autocomplete="off" type="text" class="form-control" id="{{ $field['id'] }}"
                            name="{{ $field['name'] }}" value="{{ $field['value'] }}">
                    </div>
                </div>
            @endforeach

            <button class="btn btn-primary">Lưu và cập nhật</button>
    </div>
@endsection
