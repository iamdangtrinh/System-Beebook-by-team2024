<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show404()
    {
        return view('admin.404');
    }
    public function show500()
    {
        return view('admin.500');
    }
    public function activity_stream()
    {
        return view('admin.activity_stream');
    }
    public function agile_board()
    {
        return view('admin.agile_board');
    }
    public function article()
    {
        return view('admin.article');
    }
    public function badges_labels()
    {
        return view('admin.badges_labels');
    }
    public function basic_gallery()
    {
        return view('admin.basic_gallery');
    }
    public function blogs()
    {
        return view('admin.blogs');
    }
    public function buttons()
    {
        return view('admin.buttons');
    }
    public function c3()
    {
        return view('admin.c3');
    }
    public function calendar()
    {
        return view('admin.calendar');
    }
    public function carousel()
    {
        return view('admin.carousel');
    }
    public function chat_view()
    {
        return view('admin.chat_view');
    }
    public function clients()
    {
        return view('admin.clients');
    }
    public function clipboard()
    {
        return view('admin.clipboard');
    }
    public function code_editor()
    {
        return view('admin.code_editor');
    }
    public function contacts_2()
    {
        return view('admin.contacts_2');
    }
    public function contacts()
    {
        return view('admin.contacts');
    }
    public function css_animation()
    {
        return view('admin.css_animation');
    }
    public function dashboard_2()
    {
        return view('admin.dashboard_2');
    }
    public function dashboard_3()
    {
        return view('admin.dashboard_3');
    }
    public function dashboard_4_1()
    {
        return view('admin.dashboard_4_1');
    }
    public function dashboard_4()
    {
        return view('admin.dashboard_4');
    }
    public function dashboard_5()
    {
        return view('admin.dashboard_5');
    }
    public function datamaps()
    {
        return view('admin.datamaps');
    }
    public function diff()
    {
        return view('admin.diff');
    }
    public function draggable_panels()
    {
        return view('admin.draggable_panels');
    }
    public function ecommerce_payments()
    {
        return view('admin.ecommerce_payments');
    }
    public function ecommerce_product_detail()
    {
        return view('admin.ecommerce_product_detail');
    }
    public function ecommerce_product_list()
    {
        return view('admin.ecommerce_product_list');
    }
    public function ecommerce_product()
    {
        return view('admin.ecommerce_product');
    }
    public function ecommerce_products_grid()
    {
        return view('admin.ecommerce_products_grid');
    }
    public function ecommerce_cart()
    {
        return view('admin.ecommerce_cart');
    }
    public function ecommerce_orders()
    {
        return view('admin.ecommerce_orders');
    }
    public function email_template()
    {
        return view('admin.email_template');
    }
    public function empty_page()
    {
        return view('admin.empty_page');
    }
    public function faq()
    {
        return view('admin.faq');
    }
    public function file_manager()
    {
        return view('admin.file_manager');
    }public function forgot_password()
    {
        return view('admin.forgot_password');
    }
    public function form_advanced()
    {
        return view('admin.form_advanced');
    }
    public function form_autocomplete()
    {
        return view('admin.form_autocomplete');
    }
    public function form_basic()
    {
        return view('admin.form_basic');
    }
    public function form_editors()
    {
        return view('admin.form_editors');
    }
    public function form_file_upload()
    {
        return view('admin.form_file_upload');
    }
    public function form_markdown()
    {
        return view('admin.form_markdown');
    }
    public function form_wizard()
    {
        return view('admin.form_wizard');
    }
    public function forum_main()
    {
        return view('admin.forum_main');
    }
    public function forum_post()
    {
        return view('admin.forum_post');
    }
    public function full_height()
    {
        return view('admin.full_height');
    }
    public function google_maps()
    {
        return view('admin.google_maps');
    }
    public function graph_chartist()
    {
        return view('admin.graph_chartist');
    }
    public function graph_chartjs()
    {
        return view('admin.graph_chartjs');
    }
    public function graph_flot()
    {
        return view('admin.graph_flot');
    }
    public function graph_morris()
    {
        return view('admin.graph_morris');
    }
    public function graph_peity()
    {
        return view('admin.graph_peity');
    }
    public function graph_rickshaw()
    {
        return view('admin.graph_rickshaw');
    }
    public function graph_sparkline()
    {
        return view('admin.graph_sparkline');
    }
    public function grid_options()
    {
        return view('admin.grid_options');
    }
    public function helper_classes()
    {
        return view('admin.helper_classes');
    }
    public function i18support()
    {
        return view('admin.i18support');
    }
    public function icons()
    {
        return view('admin.icons');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function invoice_print()
    {
        return view('admin.invoice_print');
    }
    public function invoice()
    {
        return view('admin.invoice');
    }
    public function issue_tracker()
    {
        return view('admin.issue_tracker');
    }
    public function jq_grid()
    {
        return view('admin.jq_grid');
    }
    public function landing()
    {
        return view('admin.landing');
    }
    public function layouts()
    {
        return view('admin.layouts');
    }
    public function loading_buttons()
    {
        return view('admin.loading_buttons');
    }
    public function lockscreen()
    {
        return view('admin.lockscreen');
    }
    public function login_two_columns()
    {
        return view('admin.login_two_columns');
    }
    public function login()
    {
        return view('admin.login');
    }
    public function mail_compose()
    {
        return view('admin.mail_compose');
    }
    public function mail_detail()
    {
        return view('admin.mail_detail');
    }
    public function mailbox()
    {
        return view('admin.mailbox');
    }
    public function masonry()
    {
        return view('admin.masonry');
    }
    public function md_skin()
    {
        return view('admin.md_skin');
    }
    public function metrics()
    {
        return view('admin.metrics');
    }
    public function modal_window()
    {
        return view('admin.modal_window');
    }
    public function nestable_list()
    {
        return view('admin.nestable_list');
    }
    public function notifications()
    {
        return view('admin.notifications');
    }
    public function off_canvas_menu()
    {
        return view('admin.off_canvas_menu');
    }
    public function package()
    {
        return view('admin.package');
    }
    public function password_meter()
    {
        return view('admin.password_meter');
    }
    public function pdf_viewer()
    {
        return view('admin.pdf_viewer');
    }
    public function pin_board()
    {
        return view('admin.pin_board');
    }
    public function profile_2()
    {
        return view('admin.profile_2');
    }
    public function profile()
    {
        return view('admin.profile');
    }
    public function project_detail()
    {
        return view('admin.project_detail');
    }
    public function projects()
    {
        return view('admin.projects');
    }
    public function register()
    {
        return view('admin.register');
    }
    public function resizeable_panels()
    {
        return view('admin.resizeable_panels');
    }
    public function search_results()
    {
        return view('admin.search_results');
    }
    public function skin_config()
    {
        return view('admin.skin_config');
    }
    public function slick_carousel()
    {
        return view('admin.slick_carousel');
    }
    public function social_buttons()
    {
        return view('admin.social_buttons');
    }
    public function social_feed()
    {
        return view('admin.social_feed');
    }
    public function spimners_usage()
    {
        return view('admin.spimmers_usage');
    }
    public function spinners()
    {
        return view('admin.spinners');
    }
    public function sweetalert()
    {
        return view('admin.sweetalert');
    }
    public function table_basic()
    {
        return view('admin.table_basic');
    }
    public function table_data_tables()
    {
        return view('admin.table_data_tables');
    }
    public function table_foo_tables()
    {
        return view('admin.table_foo_tables');
    }
    public function tabs_panels()
    {
        return view('admin.tabs_panels');
    }
    public function tabs()
    {
        return view('admin.tabs');
    }
    public function teams_board()
    {
        return view('admin.teams_board');
    }
    public function text_spinners()
    {
        return view('admin.text_spinners');
    }
    public function timeline_2()
    {
        return view('admin.timeline_2');
    }
    public function timeline()
    {
        return view('admin.timeline');
    }
    public function tinycon()
    {
        return view('admin.tinycon');
    }
    public function toastr_notifications()
    {
        return view('admin.toastr_notifications');
    }
    public function tour()
    {
        return view('admin.tour');
    }
    public function tree_view()
    {
        return view('admin.tree_view');
    }
    public function truncate()
    {
        return view('admin.truncate');
    }
    public function typography()
    {
        return view('admin.typography');
    }
    public function validation()
    {
        return view('admin.validation');
    }
    public function video()
    {
        return view('admin.video');
    }
    public function vote_list()
    {
        return view('admin.vote_list');
    }
    public function widgets()
    {
        return view('admin.widgets');
    }
}
