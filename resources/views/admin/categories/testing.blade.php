
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>
        Line Operations
    </title>
    <meta name="description" content="Base form control examples"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="https://aslan.lol/admin_assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://aslan.lol/admin_assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>

    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="https://aslan.lol/admin_assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css"/>
    <link href="https://aslan.lol/admin_assets/css/style.css" rel="stylesheet" type="text/css"/>

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

    <!--end::Layout Themes-->
    <!--<link rel="shortcut icon" href="https://aslan.lol/admin_assets/media/logos/favicon.ico" />-->


    <link rel="shortcut icon" href="https://aslan.lol/uploads/settings/yAUo2t9EfZkyE7g93821231666977721_3820564.jpg"/>
    <style type="text/css">
        .box-filter-collapse {
            display: none;
        }

        .form-control {
            width: 100%;
            height: 34px;
            padding: 2px 12px;
        }
    </style>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="https://aslan.lol/en/admin/home">
        <img alt="Logo" height="50px" src="https://aslan.lol/uploads/settings/yAUo2t9EfZkyE7g93821231666977721_3820564.jpg"/>
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->

        <!--end::Header Menu Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24"/>
								<path
                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								<path
                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                    fill="#000000" fill-rule="nonzero"/>
							</g>
						</svg>
                        <!--end::Svg Icon-->
					</span>
        </button>
        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->


<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
            <!--begin::Brand-->
            <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <a href="/" class="brand-logo">
                    <img alt="Logo" style="margin: 3px 10px 0 !important; width: 27px;" src="https://aslan.lol/uploads/settings/yAUo2t9EfZkyE7g93821231666977721_3820564.jpg"/>
                    <!--<img alt="Logo" src="" />-->
                </a>
                <!--end::Logo-->
                <!--begin::Toggle-->
                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
										<path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
									</g>
								</svg>
                                <!--end::Svg Icon-->
							</span>
                </button>
                <!--end::Toolbar-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside Menu-->
            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <!--begin::Menu Container-->
                <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
                     data-menu-dropdown-timeout="500">
                    <ul class="menu-nav">
                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/home" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
            fill="#000000"/>
    </g>
</svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                <span class="menu-text">Home</span>
                            </a>
                        </li>

                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/admins" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                         <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Delete-user.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z M21,8 L17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L21,6 C21.5522847,6 22,6.44771525 22,7 C22,7.55228475 21.5522847,8 21,8 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>

                                <span class="menu-text">Admins Management</span>
                            </a>
                        </li>


                        <li class="menu-item menu-item-submenu" aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Users</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/representative" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Representative</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/end_user" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Normal User</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/pointOfSale" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Point Of Sale</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/deletedAccounts" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Deleted Accounts</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/mainCategory" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                         <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Delete-user.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z M21,8 L17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L21,6 C21.5522847,6 22,6.44771525 22,7 C22,7.55228475 21.5522847,8 21,8 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>

                                <span class="menu-text">Main Category</span>
                            </a>
                        </li>
                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/attributes" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                         <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Delete-user.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z M21,8 L17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L21,6 C21.5522847,6 22,6.44771525 22,7 C22,7.55228475 21.5522847,8 21,8 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>

                                <span class="menu-text">Attributes</span>
                            </a>
                        </li>




                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/export" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                     <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/Export.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <rect fill="#000000" opacity="0.3"
                                                          transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) "
                                                          x="11" y="2" width="2" height="12" rx="1"/>
                                                    <path
                                                        d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) "/>
                                                </g>
                                            </svg>
                                            </span>

                                <span class="menu-text">Excel Export</span>
                            </a>
                        </li>

                        <li class="menu-item menu-item-submenu" aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Accounts</span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/accounts" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Accounts</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/expenses" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Expenses</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/cash_box" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Cash Box</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/bank_accounts" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Bank Accounts</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/sims" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Sims</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </li>


                        <li class="menu-item menu-item-submenu  " aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Orders Management</span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="menu-submenu">

                                <ul class="menu-subnav ">

                                    <li class="menu-item "  aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/orderLine" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text ">Order Line</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/orderBallance" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Order Ballance</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/orderProduct" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Order Product</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/orderService" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Order Service</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </li>


                        <li class="menu-item menu-item-submenu" aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Companies And Shops</span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/company" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Products Companies</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/categories" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Categories</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/products" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Products</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/users_products" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Users Products</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/groups" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                     <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/Export.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <rect fill="#000000" opacity="0.3"
                                                          transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) "
                                                          x="11" y="2" width="2" height="12" rx="1"/>
                                                    <path
                                                        d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) "/>
                                                </g>
                                            </svg>
                                            </span>

                                <span class="menu-text">Groups</span>
                            </a>
                        </li>

                        <li class="menu-item menu-item-submenu" aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Lines</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/mobile_companies" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Line Companies</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/numbers" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Mobile Numbers</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/simBarcodes" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Sim Barcodes</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/line_operations" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Line Operations</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/price" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Line Price</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                         height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Services</span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/services" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Services</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/service_type" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Service Type</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/ServicePrice" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Services Prices</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>




                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/pages" class="menu-link">
                                            <span class="svg-icon menu-icon">
              <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-top-panel-6.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <span class="menu-text">Pages</span>
                            </a>
                        </li>



                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/landing" class="menu-link">
                                            <span class="svg-icon menu-icon">
              <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-top-panel-6.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <span class="menu-text">Landing Page</span>
                            </a>
                        </li>


                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/notifications" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Notifications1.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <path
            d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z"
            fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <span class="menu-text">Notifications</span>
                            </a>
                        </li>

                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/customerComments" class="menu-link">
 <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Group.svg--><svg
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
         viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path
            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span> <span class="menu-text">Customer Comments</span>
                            </a>
                        </li>
                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/ourCustomers" class="menu-link">
 <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Group.svg--><svg
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
         viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path
            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span> <span class="menu-text">Our Customers</span>
                            </a>
                        </li>
                        <li class="menu-item "
                            aria-haspopup="true">
                            <a href="https://aslan.lol/en/admin/contact" class="menu-link">
                                            <span class="svg-icon menu-icon">
                                          <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z M6.16794971,10.5547002 C7.67758127,12.8191475 9.64566871,14 12,14 C14.3543313,14 16.3224187,12.8191475 17.8320503,10.5547002 C18.1384028,10.0951715 18.0142289,9.47430216 17.5547002,9.16794971 C17.0951715,8.86159725 16.4743022,8.98577112 16.1679497,9.4452998 C15.0109146,11.1808525 13.6456687,12 12,12 C10.3543313,12 8.9890854,11.1808525 7.83205029,9.4452998 C7.52569784,8.98577112 6.90482849,8.86159725 6.4452998,9.16794971 C5.98577112,9.47430216 5.86159725,10.0951715 6.16794971,10.5547002 Z"
            fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <span class="menu-text">Contacts Messages</span>
                            </a>
                        </li>

                        <li class="menu-item menu-item-submenu" aria-haspopup="true"
                            data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                 height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                            fill="#000000"/>
                                                    </g>
                                                </svg>
                                            <!--end::Svg Icon-->
										</span>
                                <span class="menu-text">Settings</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">

                                <ul class="menu-subnav">

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/slider" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Banners</span>
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/pages" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Pages</span>
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/workThrow" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">How Work</span>
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/landing" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Landing Page</span>
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/governorates" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Country</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/cities" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Cities</span>
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/question" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">FAQ</span>
                                        </a>
                                    </li>


                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/settings" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">cp.settings</span>
                                        </a>
                                    </li>


                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="https://aslan.lol/en/admin/system_maintenance" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">System Maintenance</span>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </li>


                    </ul>
                    <!--end::Menu Nav-->
                </div>
                <!--end::Menu Container-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->


        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <!--begin::Header Menu-->
                        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                            <!--begin::Header Nav-->
                            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                <li class="breadcrumb-item">
                                    <a href="https://aslan.lol/en/admin/home"
                                       class="text-dark font-weight-bold">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="" class="text-muted"> Line Operations
                                    </a>
                                </li>
                            </ul>


                            <!--end::Header Nav-->
                        </div>
                        <!--end::Header Menu-->
                    </div>
                    <!--end::Header Menu Wrapper-->
                    <!--begin::Topbar-->
                    <div class="topbar">

                        <div class="topbar-item"  id="header_notification_bar">
                            <a href="https://aslan.lol/en/admin/orderBallance" >
                                <div class="btn btn-icon btn-clean btn-lg mr-1" title="طلبات الرصيد">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Wallet2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="2" y="2" width="10" height="12" rx="2"/>
        <path d="M4,6 L20,6 C21.1045695,6 22,6.8954305 22,8 L22,20 C22,21.1045695 21.1045695,22 20,22 L4,22 C2.8954305,22 2,21.1045695 2,20 L2,8 C2,6.8954305 2.8954305,6 4,6 Z M18,16 C19.1045695,16 20,15.1045695 20,14 C20,12.8954305 19.1045695,12 18,12 C16.8954305,12 16,12.8954305 16,14 C16,15.1045695 16.8954305,16 18,16 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span style="display:none" class=" newOrderBalance label label-danger label-rounded"></span>
                                </div>
                            </a>
                        </div>

                        <div class="topbar-item"  id="header_notification_bar">
                            <a href="https://aslan.lol/en/admin/orderLine" >
                                <div class="btn btn-icon btn-clean btn-lg mr-1" title="طلبات الخطوط">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Layers.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span style="display:none" class=" total_orders label label-danger label-rounded"></span>
                                </div>
                            </a>
                        </div>

                        <div class="topbar-item"  id="header_notification_bar">
                            <a href="https://aslan.lol/en/admin/orderProduct" >
                                <div class="btn btn-icon btn-clean btn-lg mr-1" title="طلبات المنتجات">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Price1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M3.52270623,14.028695 C2.82576459,13.3275941 2.82576459,12.19529 3.52270623,11.4941891 L11.6127629,3.54050571 C11.9489429,3.20999263 12.401513,3.0247814 12.8729533,3.0247814 L19.3274172,3.0247814 C20.3201611,3.0247814 21.124939,3.82955935 21.124939,4.82230326 L21.124939,11.2583059 C21.124939,11.7406659 20.9310733,12.2027862 20.5869271,12.5407722 L12.5103155,20.4728108 C12.1731575,20.8103442 11.7156477,21 11.2385688,21 C10.7614899,21 10.3039801,20.8103442 9.9668221,20.4728108 L3.52270623,14.028695 Z M16.9307214,9.01652093 C17.9234653,9.01652093 18.7282432,8.21174298 18.7282432,7.21899907 C18.7282432,6.22625516 17.9234653,5.42147721 16.9307214,5.42147721 C15.9379775,5.42147721 15.1331995,6.22625516 15.1331995,7.21899907 C15.1331995,8.21174298 15.9379775,9.01652093 16.9307214,9.01652093 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span style="display:none" class="orderProduct label label-danger label-rounded"></span>
                                </div>
                            </a>
                        </div>

                        <div class="topbar-item"  id="header_notification_bar">
                            <a href="https://aslan.lol/en/admin/orderService" >
                                <div class="btn btn-icon btn-clean btn-lg mr-1" title="طلبات الخدمات">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Settings4.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span style="display:none" class=" total_services label label-danger label-rounded"></span>
                                </div>
                            </a>
                        </div>

                        <div class="topbar-item"  id="header_notification_bar">
                            <a href="https://aslan.lol/en/admin/users_products" >
                                <div class="btn btn-icon btn-clean btn-lg mr-1" title="منتجات الزبائن">
        <span class="svg-icon svg-icon-xl svg-icon-primary">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			<rect x="0" y="0" width="24" height="24"></rect>
			<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
			</g>
			</svg>
            <!--end::Svg Icon-->
        </span>
                                    <span style="display:none" class=" newProduct label label-danger label-rounded"></span>
                                </div>
                            </a>
                        </div>


                        <div class="topbar-item"  id="header_notification_bar">
                            <a href="https://aslan.lol/en/admin/chats" >
                                <div class="btn btn-icon btn-clean btn-lg mr-1" title="الدردشة">
        <span class="svg-icon svg-icon-xl svg-icon-primary">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
                    <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
                                    <span style="display:none" class=" total_messages label label-danger label-rounded"></span>

                                </div>
                            </a>
                        </div>

                        <!--end::Chat-->
                        <!--begin::Languages-->
                        <div class="dropdown">
                            <!--begin::Toggle-->
                            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                    <img class="h-20px w-20px rounded-sm"
                                         src="https://aslan.lol/admin_assets/media/svg/flags/012-uk.svg"
                                         alt="">
                                </div>
                            </div>
                            <!--end::Toggle-->
                            <!--begin::Dropdown-->
                            <div
                                class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Nav-->
                                <ul class="navi navi-hover py-4">
                                    <!--begin::Item-->
                                    <!--begin::Item-->
                                    <li class="navi-item">
                                        <a href="https://aslan.lol/ar/admin/line_operations/7/edit"
                                           class="navi-link">
                                                <span class="symbol symbol-20 mr-3"><img
                                                        src="https://aslan.lol/admin_assets/media/svg/flags/008-saudi-arabia.svg"
                                                        alt=""></span>
                                            <span class="navi-text">العربية</span>
                                        </a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->


                                    <!--end::Item-->
                                </ul>
                                <!--end::Nav-->
                            </div>
                            <!--end::Dropdown-->
                        </div>
                        <!--end::Languages-->
                        <!--begin::User-->
                        <div class="topbar-item">
                            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                 id="kt_quick_user_toggle">

                                <span
                                    class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">admin</span>
                                <span class="symbol symbol-35 symbol-light-success">
											<span
                                                class="symbol-label font-size-h5 font-weight-bold"> a</span>
										</span>
                            </div>
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Topbar-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->

            <!--    -->




            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-1">
                            <div class="d-flex align-items-baseline mr-5">
                                <h3>Edit  Line Operations</h3>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <a href="https://aslan.lol/en/admin/line_operations"
                               class="btn btn-secondary  mr-2">Cancel </a>
                            <button id="submitButton" class="btn btn-success ">Save</button>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                            <form method="post" action="https://aslan.lol/en/admin/line_operations/7"
                                  enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                                <input type="hidden" name="_token" value="R5GE3xXexecINH32YfCXcPSKY5DIS9VrxoAQo8Xn">
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="card-header">
                                    <h3 class="card-title">Main info</h3>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile Company</label>
                                                    <select class="form-control form-control-solid"
                                                            name="mobile_company_id" required>
                                                        <option value="0">Select </option>
                                                        <option value="1"
                                                                class="btn--filter" selected >تركسل</option>
                                                        <option value="2"
                                                                class="btn--filter"  >تروكتليكوم</option>
                                                        <option value="4"
                                                                class="btn--filter"  >فودافون</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name </label>
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="name" value="خط جديد"
                                                           required/>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Cost Price</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                           Cost Price name="cost_price"
                                                           value="120"
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Is Sim Check</label>
                                                    <select class="form-control form-control-solid"
                                                            name="is_sim_check" required>
                                                        <option value="0"  >No</option>
                                                        <option value="1"  selected >Yes </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>





















                                    </div>

                                    <div class="card-body col-md-12">

                                        <div class="card-header">
                                            <h3 class="card-title">Attributes</h3>
                                        </div>

                                        <div class="task-list-item">
                                            <div class="row new-item align-items-center">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Attribute <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control form-control-solid"
                                                                    name="attributes[0][attribute_id]"
                                                                    required>
                                                                <option
                                                                    value="1" >
                                                                    Email
                                                                </option>
                                                                <option
                                                                    value="2" >
                                                                    User Mobile
                                                                </option>
                                                                <option
                                                                    value="3" selected>
                                                                    barcode
                                                                </option>
                                                                <option
                                                                    value="4" >
                                                                    user game id
                                                                </option>
                                                                <option
                                                                    value="5" >
                                                                    Photo ID
                                                                </option>
                                                                <option
                                                                    value="6" >
                                                                    ملاحظه
                                                                </option>
                                                                <option
                                                                    value="7" >
                                                                    صوره الضهر للكملك
                                                                </option>
                                                                <option
                                                                    value="8" >
                                                                    اختر رقم عادي
                                                                </option>
                                                                <option
                                                                    value="9" >
                                                                    اختر رقم فضي
                                                                </option>
                                                                <option
                                                                    value="10" >
                                                                    اختر رقم ذهبي
                                                                </option>
                                                                <option
                                                                    value="11" >
                                                                    Gamer Name
                                                                </option>
                                                                <option
                                                                    value="12" >
                                                                    خط ماسي
                                                                </option>
                                                                <option
                                                                    value="13" >
                                                                    VIP 1
                                                                </option>
                                                                <option
                                                                    value="14" >
                                                                    imei
                                                                </option>
                                                                <option
                                                                    value="15" >
                                                                    صوره الايمي
                                                                </option>
                                                                <option
                                                                    value="16" >
                                                                    صوره
                                                                </option>
                                                                <option
                                                                    value="17" >
                                                                    رابط
                                                                </option>
                                                                <option
                                                                    value="18" >
                                                                    اسم المستخدم
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label
                                                            class=" col-form-label px-8">Is Required</label>
                                                        <span class="switch switch-icon">
    												<label>
    													<input type="checkbox"
                                                               name="attributes[0][validation]"
                                                               checked
                                                        >
    													<span></span>
    												</label>
    											</span>

                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-parent-class="new-item"
                                                       data-original-title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="row new-item align-items-center">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Attribute <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control form-control-solid"
                                                                    name="attributes[1][attribute_id]"
                                                                    required>
                                                                <option
                                                                    value="1" >
                                                                    Email
                                                                </option>
                                                                <option
                                                                    value="2" >
                                                                    User Mobile
                                                                </option>
                                                                <option
                                                                    value="3" >
                                                                    barcode
                                                                </option>
                                                                <option
                                                                    value="4" >
                                                                    user game id
                                                                </option>
                                                                <option
                                                                    value="5" selected>
                                                                    Photo ID
                                                                </option>
                                                                <option
                                                                    value="6" >
                                                                    ملاحظه
                                                                </option>
                                                                <option
                                                                    value="7" >
                                                                    صوره الضهر للكملك
                                                                </option>
                                                                <option
                                                                    value="8" >
                                                                    اختر رقم عادي
                                                                </option>
                                                                <option
                                                                    value="9" >
                                                                    اختر رقم فضي
                                                                </option>
                                                                <option
                                                                    value="10" >
                                                                    اختر رقم ذهبي
                                                                </option>
                                                                <option
                                                                    value="11" >
                                                                    Gamer Name
                                                                </option>
                                                                <option
                                                                    value="12" >
                                                                    خط ماسي
                                                                </option>
                                                                <option
                                                                    value="13" >
                                                                    VIP 1
                                                                </option>
                                                                <option
                                                                    value="14" >
                                                                    imei
                                                                </option>
                                                                <option
                                                                    value="15" >
                                                                    صوره الايمي
                                                                </option>
                                                                <option
                                                                    value="16" >
                                                                    صوره
                                                                </option>
                                                                <option
                                                                    value="17" >
                                                                    رابط
                                                                </option>
                                                                <option
                                                                    value="18" >
                                                                    اسم المستخدم
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label
                                                            class=" col-form-label px-8">Is Required</label>
                                                        <span class="switch switch-icon">
    												<label>
    													<input type="checkbox"
                                                               name="attributes[1][validation]"
                                                               checked
                                                        >
    													<span></span>
    												</label>
    											</span>

                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-parent-class="new-item"
                                                       data-original-title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="row new-item align-items-center">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Attribute <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control form-control-solid"
                                                                    name="attributes[2][attribute_id]"
                                                                    required>
                                                                <option
                                                                    value="1" >
                                                                    Email
                                                                </option>
                                                                <option
                                                                    value="2" >
                                                                    User Mobile
                                                                </option>
                                                                <option
                                                                    value="3" >
                                                                    barcode
                                                                </option>
                                                                <option
                                                                    value="4" >
                                                                    user game id
                                                                </option>
                                                                <option
                                                                    value="5" >
                                                                    Photo ID
                                                                </option>
                                                                <option
                                                                    value="6" >
                                                                    ملاحظه
                                                                </option>
                                                                <option
                                                                    value="7" selected>
                                                                    صوره الضهر للكملك
                                                                </option>
                                                                <option
                                                                    value="8" >
                                                                    اختر رقم عادي
                                                                </option>
                                                                <option
                                                                    value="9" >
                                                                    اختر رقم فضي
                                                                </option>
                                                                <option
                                                                    value="10" >
                                                                    اختر رقم ذهبي
                                                                </option>
                                                                <option
                                                                    value="11" >
                                                                    Gamer Name
                                                                </option>
                                                                <option
                                                                    value="12" >
                                                                    خط ماسي
                                                                </option>
                                                                <option
                                                                    value="13" >
                                                                    VIP 1
                                                                </option>
                                                                <option
                                                                    value="14" >
                                                                    imei
                                                                </option>
                                                                <option
                                                                    value="15" >
                                                                    صوره الايمي
                                                                </option>
                                                                <option
                                                                    value="16" >
                                                                    صوره
                                                                </option>
                                                                <option
                                                                    value="17" >
                                                                    رابط
                                                                </option>
                                                                <option
                                                                    value="18" >
                                                                    اسم المستخدم
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label
                                                            class=" col-form-label px-8">Is Required</label>
                                                        <span class="switch switch-icon">
    												<label>
    													<input type="checkbox"
                                                               name="attributes[2][validation]"
                                                               checked
                                                        >
    													<span></span>
    												</label>
    											</span>

                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-parent-class="new-item"
                                                       data-original-title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="row new-item align-items-center">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Attribute <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control form-control-solid"
                                                                    name="attributes[3][attribute_id]"
                                                                    required>
                                                                <option
                                                                    value="1" >
                                                                    Email
                                                                </option>
                                                                <option
                                                                    value="2" >
                                                                    User Mobile
                                                                </option>
                                                                <option
                                                                    value="3" >
                                                                    barcode
                                                                </option>
                                                                <option
                                                                    value="4" >
                                                                    user game id
                                                                </option>
                                                                <option
                                                                    value="5" >
                                                                    Photo ID
                                                                </option>
                                                                <option
                                                                    value="6" >
                                                                    ملاحظه
                                                                </option>
                                                                <option
                                                                    value="7" >
                                                                    صوره الضهر للكملك
                                                                </option>
                                                                <option
                                                                    value="8" selected>
                                                                    اختر رقم عادي
                                                                </option>
                                                                <option
                                                                    value="9" >
                                                                    اختر رقم فضي
                                                                </option>
                                                                <option
                                                                    value="10" >
                                                                    اختر رقم ذهبي
                                                                </option>
                                                                <option
                                                                    value="11" >
                                                                    Gamer Name
                                                                </option>
                                                                <option
                                                                    value="12" >
                                                                    خط ماسي
                                                                </option>
                                                                <option
                                                                    value="13" >
                                                                    VIP 1
                                                                </option>
                                                                <option
                                                                    value="14" >
                                                                    imei
                                                                </option>
                                                                <option
                                                                    value="15" >
                                                                    صوره الايمي
                                                                </option>
                                                                <option
                                                                    value="16" >
                                                                    صوره
                                                                </option>
                                                                <option
                                                                    value="17" >
                                                                    رابط
                                                                </option>
                                                                <option
                                                                    value="18" >
                                                                    اسم المستخدم
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label
                                                            class=" col-form-label px-8">Is Required</label>
                                                        <span class="switch switch-icon">
    												<label>
    													<input type="checkbox"
                                                               name="attributes[3][validation]"

                                                        >
    													<span></span>
    												</label>
    											</span>

                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-parent-class="new-item"
                                                       data-original-title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="row new-item align-items-center">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Attribute <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control form-control-solid"
                                                                    name="attributes[4][attribute_id]"
                                                                    required>
                                                                <option
                                                                    value="1" >
                                                                    Email
                                                                </option>
                                                                <option
                                                                    value="2" >
                                                                    User Mobile
                                                                </option>
                                                                <option
                                                                    value="3" >
                                                                    barcode
                                                                </option>
                                                                <option
                                                                    value="4" >
                                                                    user game id
                                                                </option>
                                                                <option
                                                                    value="5" >
                                                                    Photo ID
                                                                </option>
                                                                <option
                                                                    value="6" selected>
                                                                    ملاحظه
                                                                </option>
                                                                <option
                                                                    value="7" >
                                                                    صوره الضهر للكملك
                                                                </option>
                                                                <option
                                                                    value="8" >
                                                                    اختر رقم عادي
                                                                </option>
                                                                <option
                                                                    value="9" >
                                                                    اختر رقم فضي
                                                                </option>
                                                                <option
                                                                    value="10" >
                                                                    اختر رقم ذهبي
                                                                </option>
                                                                <option
                                                                    value="11" >
                                                                    Gamer Name
                                                                </option>
                                                                <option
                                                                    value="12" >
                                                                    خط ماسي
                                                                </option>
                                                                <option
                                                                    value="13" >
                                                                    VIP 1
                                                                </option>
                                                                <option
                                                                    value="14" >
                                                                    imei
                                                                </option>
                                                                <option
                                                                    value="15" >
                                                                    صوره الايمي
                                                                </option>
                                                                <option
                                                                    value="16" >
                                                                    صوره
                                                                </option>
                                                                <option
                                                                    value="17" >
                                                                    رابط
                                                                </option>
                                                                <option
                                                                    value="18" >
                                                                    اسم المستخدم
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label
                                                            class=" col-form-label px-8">Is Required</label>
                                                        <span class="switch switch-icon">
    												<label>
    													<input type="checkbox"
                                                               name="attributes[4][validation]"

                                                        >
    													<span></span>
    												</label>
    											</span>

                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-parent-class="new-item"
                                                       data-original-title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row my-3">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="button" id="add-option"
                                                        class="btn btn-primary">Add New Item</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <button type="submit" id="submitForm" style="display:none"></button>
                            </form>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>


            <!--end::Content-->
            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">2022'&copy; Powered By'</span>
                        <a href="https://hexacit.com/" target="_blank" class="text-dark-75 text-hover-primary">HEXA</a>
                    </div>
                </div>
            </div>
            <!--end::Footer-->
        </div>


        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->


<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <!--<h3 class="font-weight-bold m-0">User Profile-->
        <!--<small class="text-muted font-size-sm ml-2">12 messages</small></h3>-->
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-20">




            <div class="d-flex flex-column">
                <a href="#"
                   class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">admin</a>
                <!--<div class="text-muted mt-1">Admin</div>-->
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path
                                                        d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                        fill="#000000"/>
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
									</span>
									<span
                                        class="navi-text text-muted text-hover-primary">admin@admin.com</span>
								</span>
                    </a>
                    <a href="https://aslan.lol/en/admin/logout"
                       class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Logout </a>

                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="https://aslan.lol/en/admin/editMyProfile" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
										<svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path
                                                    d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                    fill="#000000"/>
												<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
											</g>
										</svg>
                                        <!--end::Svg Icon-->
									</span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Edit My Profile</div>
                        <!--<div class="text-muted">Account settings and more-->
                        <!--<span class="label label-light-danger label-inline font-weight-bold">update</span></div>-->
                    </div>
                </div>

            </a>
            <!--end:Item-->
            <!--begin::Item-->
            <a href="https://aslan.lol/en/admin/changeMyPassword" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            <i class="la la-key"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Change Password</div>
                        <!--<div class="text-muted">Inbox and tasks</div>-->
                    </div>
                </div>
            </a>
        </div>
        <!--end::Nav-->

    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->

<div id="deleteAll" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete all the selected items! </p>
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">Cancel </button>
                <a href="#" class="confirmAll" data-action="delete">
                    <button class="btn btn-danger">Delete</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="activation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Activation </h4>
            </div>
            <div class="modal-body">
                <p>Are you sure to active all the selected items ! </p>
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">Cancel </button>
                <a href="#" class="confirmAll" data-action="active">
                    <button class="btn btn-success">Yes </button>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="cancel_activation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Cancel Activation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure to not-active all the selected items ! </p>
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">Cancel </button>
                <a href="#" class="confirmAll" data-action="not_active">
                    <button class="btn btn-success">Yes </button>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/7.17.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.17.1/firebase.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.17.1/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.17.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.17.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.17.1/firebase-firestore.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "AIzaSyAMvut6ouacPmK_vB6BVSJkiE9hwDPlRNM",
        authDomain: "aslan-4823e.firebaseapp.com",
        databaseURL: "https://aslan-4823e-default-rtdb.firebaseio.com",
        projectId: "aslan-4823e",
        storageBucket: "aslan-4823e.appspot.com",
        messagingSenderId: "451399006070",
        appId: "1:451399006070:web:87566c9b5ed2a70e1d2c57",
        measurementId: "G-BM2TY533QF"
    };
    //   // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>

<script type="text/javascript">

    var statistics = firebase.database().ref("statistics");
    statistics.on('value', function(snapshot) {
        snapshot.forEach(function(childSnapshot) {
            if(childSnapshot.val() == '0'){
                $('.'+childSnapshot.key).hide().text("");
                $( "#header_notification_bar" ).hide

            }else{
                $('.'+childSnapshot.key).show().text(childSnapshot.val());
                $( "#header_notification_bar" ).show
                const audio = new Audio("https://aslan.lol/notify.mp3");
                audio.load();
                audio.play();
                $(".new_notify").show();
                setTimeout(function() {
                    $(".new_notify").hide(300);
                }, 5000);

            }
        });
    });
</script>

<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->

<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="https://aslan.lol/admin_assets/plugins/global/plugins.bundle.js"></script>
<script src="https://aslan.lol/admin_assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="https://aslan.lol/admin_assets/js/scripts.bundle.js"></script>

<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/bootstrap-touchspin.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/ion-range-slider.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/editors/summernote.js"></script>
<script src="https://aslan.lol/admin_assets/js/pages/crud/forms/widgets/select2.js"></script>
<script src="https://aslan.lol/admin_assets/plugins/jquery-validation/js/jquery.validate.js"></script>
<script src="https://aslan.lol/admin_assets/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="https://aslan.lol/admin_assets/plugins/custom/datatables/datatables.bundle.js"></script>


<script>
    var table_btns =  [
        {
            extend: 'copy',
            //   text: '<i class="fa fa-copy"></i>',
            className: 'btn btn-outline-primary',
            exportOptions: {
                columns: ':not(.notExport)'
            }
        },
        {
            extend: 'excel',
            className: 'btn btn-outline-primary',
            exportOptions: {
                columns: ':not(.notExport)'
            }
        },
        {
            extend: 'pdf',
            className: 'btn btn-outline-primary',
            exportOptions: {
                columns: ':not(.notExport)'
            }
        },
        {
            extend: 'print',
            className: 'btn btn-outline-primary',
            exportOptions: {
                columns: ':not(.notExport)'
            }
        },

    ];


</script>
<script>
    $('#edit_image').on('change', function (e) {
        readURL(this, $('#editImage'));
    });
    $('#edit_image1').on('change', function (e) {
        readURL(this, $('#editImage1'));
    });
    $(document).on('click', '#submitButton', function () {
        // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });


    var index = 6
    $('#add-option').on('click', function () {
        $rows = `

  <div class="row new-item align-items-center">

            <div class="col-md-6">
                <div class="form-group">
                <label>Attribute <span
                    class="text-danger">*</span></label>
                <div class="form-group">
                    <select class="form-control form-control-solid"
                            name="attributes[${index}][attribute_id]"
                            required>
                                    <option
                value="1">
                            Email
            </option>
            <option
                value="2">
                            User Mobile
            </option>
            <option
                value="3">
                            barcode
            </option>
            <option
                value="4">
                            user game id
            </option>
            <option
                value="5">
                            Photo ID
            </option>
            <option
                value="6">
                            ملاحظه
            </option>
            <option
                value="7">
                            صوره الضهر للكملك
            </option>
            <option
                value="8">
                            اختر رقم عادي
            </option>
            <option
                value="9">
                            اختر رقم فضي
            </option>
            <option
                value="10">
                            اختر رقم ذهبي
            </option>
            <option
                value="11">
                            Gamer Name
            </option>
            <option
                value="12">
                            خط ماسي
            </option>
            <option
                value="13">
                            VIP 1
            </option>
            <option
                value="14">
                            imei
            </option>
            <option
                value="15">
                            صوره الايمي
            </option>
            <option
                value="16">
                            صوره
            </option>
            <option
                value="17">
                            رابط
            </option>
            <option
                value="18">
                            اسم المستخدم
            </option>
            </select>
        </div>

</div>
</div>


<div class="col-md-4">
<div class="form-group row">
    <label class=" col-form-label px-8">Is Required</label>
            <span class="switch switch-icon">
        <label>
            <input type="checkbox"
                   name="attributes[${index}][validation]">
                    <span></span>
                </label>
            </span>

                </div>
            </div>
            <div class="col-md-1">
                <a class="btn btn-outline-danger btn-icon btn-clean tooltips delete-new-item"
                   data-container="body"
                   data-placement="top"
                   data-parent-class="new-item"
                   data-original-title="Delete"><i
                        class="fa fa-trash"></i></a>
                                                </div>
                                            </div>


            `;
        $('.task-list-item').append($rows);
        ++index;
    });


    $(document).on('click', '.delete-new-item', function () {
        // $(this).parents('.row_item').fadeOut(1000, () => $(this).remove()).remove();
        $(this).parents('.new-item').fadeOut(500, function () {
            $(this).remove();
        });
    });

</script>



<script>
    var FormValidation = function () {

// basic validation
        var handleValidation1 = function () {
            // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error text-danger', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: ".ignore",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected"),
                    },
                },
                rules: {
                    // name: {
                    //     minlength: 2,
                    //     required: true
                    // },
                    // email: {
                    //     required: true,
                    //     email: true
                    // },

                    // mobile: {
                    //     required: true,
                    //     minlength: 8
                    // },

                    password: { required: true },
                    confirm_password: { required: true , equalTo: '[name="password"]'},
                    admin_type: {
                        required: true
                    },


                    // title: {required: true},

                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success1.hide();
                    error1.show();
                    scrollTo(error1, -200);
                    // App.scrollTo(error1, -200);
                },


                //     errorPlacement: function (error, element) { // render error placement for each input typeW
                //     if (element.parent(".input-group").size() > 0)
                //     {
                //         error.insertAfter(element.parent(".input-group"));
                //     }
                //     else if (element.attr("data-error-container"))
                //     {
                //         error.appendTo(element.attr("data-error-container"));
                //     }
                //     else
                //     {
                //         error.insertAfter(element); // for other inputs, just perform default behavior
                //     }
                // },

                highlight: function (element) { // hightlight error inputs

                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide
                    e.submit()
                }
            });


        };


        return {
            //main function to initiate the module
            init: function () {

                handleValidation1();

            }

        };

    }();

    jQuery(document).ready(function () {
        FormValidation.init();
    });


    $r = 'en';
    if ($r == 'ar') {


//overright messsages
        $.extend($.validator, {

            defaults: {
                messages: {},
                groups: {},
                rules: {},
                errorClass: "error",
                validClass: "valid",
                errorElement: "label",
                focusCleanup: false,
                focusInvalid: true,
                errorContainer: $([]),
                errorLabelContainer: $([]),
                onsubmit: true,
                ignore: ":hidden",
                ignoreTitle: false,
                onfocusin: function (element) {
                    this.lastActive = element;

                    // Hide error label and remove error class on focus if enabled
                    if (this.settings.focusCleanup) {
                        if (this.settings.unhighlight) {
                            this.settings.unhighlight.call(this, element, this.settings.errorClass, this.settings.validClass);
                        }
                        this.hideThese(this.errorsFor(element));
                    }
                },
                onfocusout: function (element) {
                    if (!this.checkable(element) && (element.name in this.submitted || !this.optional(element))) {
                        this.element(element);
                    }
                },
                onkeyup: function (element, event) {
                    // Avoid revalidate the field when pressing one of the following keys
                    // Shift       => 16
                    // Ctrl        => 17
                    // Alt         => 18
                    // Caps lock   => 20
                    // End         => 35
                    // Home        => 36
                    // Left arrow  => 37
                    // Up arrow    => 38
                    // Right arrow => 39
                    // Down arrow  => 40
                    // Insert      => 45
                    // Num lock    => 144
                    // AltGr key   => 225
                    var excludedKeys = [
                        16, 17, 18, 20, 35, 36, 37,
                        38, 39, 40, 45, 144, 225
                    ];

                    if (event.which === 9 && this.elementValue(element) === "" || $.inArray(event.keyCode, excludedKeys) !== -1) {

                    } else if (element.name in this.submitted || element === this.lastElement) {
                        this.element(element);
                    }
                },
                onclick: function (element) {
                    // click on selects, radiobuttons and checkboxes
                    if (element.name in this.submitted) {
                        this.element(element);

                        // or option elements, check parent select in that case
                    } else if (element.parentNode.name in this.submitted) {
                        this.element(element.parentNode);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    if (element.type === "radio") {
                        this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                    } else {
                        $(element).addClass(errorClass).removeClass(validClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    if (element.type === "radio") {
                        this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                    } else {
                        $(element).removeClass(errorClass).addClass(validClass);
                    }
                }
            },

            // http://jqueryvalidation.org/jQuery.validator.setDefaults/
            setDefaults: function (settings) {
                $.extend($.validator.defaults, settings);
            },


            messages: {

                required: "هذا الحقل مطلوب",
                remote: "Please fix this field.",
                email: "الرجاء ادخال عنوان بريد الكتروني صحيح .",
                date: "الرجاء ادخال تاريخ صحيح.",
                dateISO: "Please enter a valid date ( ISO ).",
                number: "Please enter a valid number.",
                digits: "Please enter only digits.",
                creditcard: "Please enter a valid credit card number.",
                equalTo: "الرجاء ادخال نفس قيمة الباسوورد.",
                maxlength: $.validator.format("Please enter no more than {0} characters."),
                minlength: $.validator.format("Please enter at least {0} characters."),
                rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
                range: $.validator.format("Please enter a value between {0} and {1}."),
                max: $.validator.format("الرجاء ادخال قيمة اقل او تساوي {0}."),
                min: $.validator.format("الرجاء ادخال قيمة اكبر او تساوي {0}."),
                category_id: "حقل التصنيف مطلوب"
            },

        });
    }
    $('.select2').select2({}).on("change", function (e) {
        $(this).valid()
    });
</script>
<script>

    var IDArray = [];
    $("input:checkbox[name=chkBox]:checked").each(function () {
        IDArray.push($(this).val());
    });
    if (IDArray.length == 0) {
        $('.event').attr('disabled', 'disabled');
    }
    // $('.chkBox').on('change', function () {
    $(document).on("change", ".chkBox", function () {
        var IDArray = [];
        $("input:checkbox[name=chkBox]:checked").each(function () {
            IDArray.push($(this).val());
        });
        if (IDArray.length == 0) {
            $('.event').attr('disabled', 'disabled');
        } else {
            $('.event').removeAttr('disabled');
        }
    });
    $('.confirmAll').on('click', function (e) {
        e.preventDefault();
        var action = $(this).data('action');

        var url = "https://aslan.lol/en/admin/changeStatus/line_operations";
        var csrf_token = 'R5GE3xXexecINH32YfCXcPSKY5DIS9VrxoAQo8Xn';
        var IDsArray = [];
        $("input:checkbox[name=chkBox]:checked").each(function () {
            IDsArray.push($(this).val());
        });

        if (IDsArray.length > 0) {
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {action: action, IDsArray: IDsArray, _token: csrf_token},
                success: function (response) {
                    if (response === 'active') {
                        //alert('fsvf');
                        $.each(IDsArray, function (index, value) {
                            $('#label-' + value).removeClass('badge-danger');
                            $('#label-' + value).addClass('badge-info');
                            $r = 'en';
                            if($r == 'ar'){
                                $('#label-' + value).text('فعال ');
                            }else{
                                $('#label-' + value).text('Active');

                            }
                        });
                        $('#activation').modal('hide');
                    } else if (response === 'not_active') {
                        //alert('fg');
                        $.each(IDsArray, function (index, value) {
                            $('#label-' + value).removeClass('badge-info');
                            $('#label-' + value).addClass('badge-danger');
                            $r = 'en';
                            if($r == 'ar'){
                                $('#label-' + value).text('غير فعال');
                            }else{
                                $('#label-' + value).text('Not Active');

                            }
                        });
                        $('#cancel_activation').modal('hide');
                    } else if (response === 'delete') {
                        $.each(IDsArray, function (index, value) {
                            $('#tr-' + value).hide(2000);
                        });
                        $('#deleteAll').modal('hide');
                    }

                    IDArray = [];
                    $("input:checkbox[name=chkBox]:checked").each(function () {
                        $(this).prop('checked', false);
                    });
                    $('.event').attr('disabled', 'disabled');

                },
                fail: function (e) {
                    alert(e);
                }
            });
        } else {
            alert('you did not choose');
        }
    });

</script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>



<script>

    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.attr('src', e.target.result);
                // add inut val base 64
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLMultiple(input, target) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (var i = 0; i < filesAmount; i++){
                var reader = new FileReader();
                reader.onload = function (event){
                    target.append('<div class="imageBox text-center" style="width:150px;height:190px;margin:5px"><img src="'+event.target.result+'" style="width:150px;height:150px"><button class="btn btn-danger deleteImage" type="button">Remove</button><input class="attachedValues" type="hidden" name="filename[]" value="'+event.target.result+'"></div>');
                };
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    $(document).on("click", ".deleteImage", function () {
        $(this).parent().remove();
    });

    $(function() {

        $('#kt_quick_user_toggle').click(function(e) {
            if ($('.offcanvas-right').hasClass('offcanvas-on')) {
                $('.offcanvas-right').removeClass('offcanvas-on');
            } else {
                $('.offcanvas-right').addClass('offcanvas-on');
            }
// 			event.stopPropagation();
        });
    });

    $(function() {

        $('#kt_quick_user_close').click(function(e) {
            $('.offcanvas-right').removeClass('offcanvas-on');
        });
    });

    $('.select2').select2({
        width: '100%'
    });


    $(document).on('change','.country',function(e){
        var country_id = $(this).val();
        var url = "https://aslan.lol/en/getCities";
        if(country_id){
            $.ajax({
                type: "GET",
                url: url+'/'+country_id,
                success: function (response) {
                    if(response)
                    {
                        $(".city").empty();
                        $(".city").append('<option value="">website.choose_city</option>');
                        $.each(response, function(index, value){
                            $(".city").append('<option value="'+value.id+'">'+ value.name +'</option>');
                            $(".city").append('</optgroup>');
                        });
                    }
                }
            });
        }
        else{
            $(".city").empty();
        }
    });

    $("[name=checkAll]").click(function(){
        $('.event').removeAttr('disabled');
        $('.checkboxes').not(this).prop('checked', this.checked);
    });


    $('.btn--filter').click(function () {
        $('.box-filter-collapse').slideToggle(500);
    });


    $(function(){
        $('.number-only').keypress(function(e) {
            if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
        })
            .on("cut copy paste",function(e){
                e.preventDefault();
            });
    });



    $('#basicModal').on('hidden.bs.modal', function () {
        $(".create_form").find("input, textarea ,select").val("");
    });



    $(document).on('click','input,select,textarea,.select2',function(){
        //   jQuery.noConflict();
        $(this).attr('style',"").next('span.errorSpan').remove();//
    });

    function validatiomForCreate(e) {
        $('.create_form').find( 'select, textarea, input' ).each(function(){
            if($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")){
                $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove(); //
                $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#bd1616" class="errorSpan">This field is required .</span>');
                preventSubmit = true;
                e.preventDefault();
            }
        });
        if(preventSubmit){
            preventSubmit = false;
            return false;

        }
    }


    var table_language =
        {
            "sEmptyTable":     "No data available in table",
            "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
            "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
            "sInfoFiltered":   "(filtered from _MAX_ total entries)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Show _MENU_ entries",
            "sLoadingRecords": "Loading...",
            "sProcessing":     "Processing...",
            "sSearch":         "Search:",
            "sZeroRecords":    "No matching records found",
            "oPaginate": {
                "sFirst":    "First",
                "sLast":     "Last",
                "sNext":     "Next",
                "sPrevious": "Previous"
            },
            "oAria": {
                "sSortAscending":  ": activate to sort column ascending",
                "sSortDescending": ": activate to sort column descending"
            }
        }
</script>

<script>
    $(document).on('click', '#submitButton', function () {
        // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });
</script>

</body>
<!--end::Body-->
</html>

