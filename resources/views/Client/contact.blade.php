<title>@yield('title', 'Trang chủ')</title>
@extends('layout.client')
@section('body')
    <div class="page_contact ">
        <div class="container">
            <div class="title-block-page">
                <h1>Liên hệ</h1>
            </div>
            <div class="row">
                <div class="col-12 order-lg-2 order-2">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="item-contacts">
                                <div class="img">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="content-r">
                                    Địa chỉ:
                                    <p>
                                        Tầng 3, Dream Home Center, 11a ngõ 282 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="item-contacts">
                                <div class="img">
                                    <i class="fas fa-question"></i>
                                </div>
                                <div class="content-r">
                                    Gửi thắc mắc:
                                    <a href=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="item-contacts">
                                <div class="img">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="content-r">
                                    Điện thoại:
                                    <a class="fone" href="tel:0932329959">0932 329 959</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div id="pagelogin">
                                <form method="post" action="/postcontact" id="contact" accept-charset="UTF-8"><input
                                        name="FormType" type="hidden" value="contact" /><input name="utf8"
                                        type="hidden" value="true" /><input type="hidden"
                                        id="Token-ed776a205ca64b249ba5f2072df14c4a" name="Token" />

                                    <div class="form-signup clearfix">
                                        <div class="row group_contact">
                                            <div class="col-lg-4 col-12">
                                                <div class="row">
                                                    <fieldset class="form-group col-12">
                                                        <label>Họ và tên <em>*</em></label>
                                                        <input placeholder="" type="text"
                                                            class="form-control  form-control-lg" required value=""
                                                            name="contact[Name]">
                                                    </fieldset>

                                                    <fieldset class="form-group col-12">
                                                        <label>Email <em>*</em></label>
                                                        <input placeholder="" type="email"
                                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required
                                                            id="email1" class="form-control form-control-lg"
                                                            value="" name="contact[email]">
                                                    </fieldset>

                                                    <fieldset class="form-group col-12">
                                                        <label>SĐT <em>*</em></label>
                                                        <input placeholder="" type="text" required id="phone"
                                                            class="form-control form-control-lg" name="contact[phone]">
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-12">
                                                <div class="row">
                                                    <fieldset class="form-group col-12">
                                                        <label>Nội dung <em>*</em></label>
                                                        <textarea placeholder="" name="contact[body]" id="comment" class="form-control content-area form-control-lg"
                                                            rows="5" Required></textarea>
                                                    </fieldset>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <button type="submit" class="button-default">Gửi liên hệ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 order-1 order-lg-1">
                    <div class="wrapcontact">
                        <div class="iFrameMap">
                            <div id="contact_map" class="map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.3068335312755!2d106.77836401129628!3d10.864250957521621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175277b187354e5%3A0x4ff7a94ae8c1e7aa!2zNzYgTMOqIFbEg24gQ2jDrSwgUGjGsOG7nW5nIExpbmggVHJ1bmcsIFRo4bunIMSQ4bupYywgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1732976571768!5m2!1svi!2s"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
