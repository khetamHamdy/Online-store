<!DOCTYPE html>
<html 
@if(app()->getLocale() == 'ar')
lang="ar" dir="rtl">
@else
lang="en" dir="ltr">
@endif
<head>
 <!-- Global site tag (gtag.js) - Google Analytics --> 
<script async 
src="https://www.googletagmanager.com/gtag/js?id=G-PN4W1TBCSH"></script> 
<script> 
  window.dataLayer = window.dataLayer || []; 
  function gtag(){dataLayer.push(arguments);} 
  gtag('js', new Date()); 
  gtag('config', 'G-PN4W1TBCSH'); 
</script>
<!-- end:: Global site tag (gtag.js) - Google Analytics -->    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title> @yield('title')</title>
    <!-- Stylesheets -->
    <link rel="icon" href="{{@$setting->favicon}}">
    <link href="{{asset('website/css/style.css')}}" rel="stylesheet">
    <!-- Responsive -->
    <link href="{{asset('website/css/responsive.css')}}" rel="stylesheet">
    <script src="{{asset('website/js/jquery-3.2.1.min.js')}}"></script>
    @if(app()->getLocale() == 'ar')
		 <link href="{{asset('website/css/rtl.css')}}" rel="stylesheet" type="text/css" />
	@endif
</head>
@yield('css')
<body>
    <div class="main-wrapper">
        <header id="header">
            <div class="container-fluid">
                <div class="logo-site">
                    <a href="{{route('home')}}">
                        <img class="logo-web" src="{{asset('website/images/logo.svg')}}" alt="" />
                        <img class="logo-mobail" src="{{asset('website/images/logo-mobail.svg')}}" alt="" />
                    </a>
                </div>
                <div class="main_menu">
                    <ul class=" clearfix">
                        <li class="active"><a class="page-scroll" href="{{route('home')}}">{{__('web.Home')}}</a></li>
                        <li><a class="page-scroll" href="{{route('about')}}">{{__('web.AboutUs')}}</a></li>
                        <li><a class="page-scroll" href="{{route('services')}}">{{__('web.OurServices')}}</a></li>
                        <li><a class="page-scroll" href="{{route('projects')}}">{{__('web.OurProjects')}}</a></li>
                        <li><a class="page-scroll" href="{{route('chairman')}}">{{__('web.MessageFromChairman')}}</a></li>
                        <li><a class="page-scroll" href="{{route('team')}}">{{__('web.OurTeam')}}</a></li>
                        <li><a class="page-scroll" href="{{route('partners')}}">{{__('web.OurPartners')}}</a></li>
                        <li><a class="page-scroll" href="{{route('contact')}}">{{__('web.ContactUs')}}</a></li>
                        <li class="lang-site">@if(getLocal() == 'en') <a class="page-scroll" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" >العربية</a>
					@else <a class="page-scroll" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" >English</a> @endIf</li>
                    </ul>
                    <div class="thumb-menu">
                        <img src="{{asset('website/images/thumb-menu.png')}}" alt="" />
                    </div>
                </div>
                <div class="opt-mobail">
                    <div class="contact-quote">
                        <a href="#sectionQuote"><i class="fa-solid fa-quote-left"></i> <span>{{__('web.GetQuote')}}</span></a>
                    </div>
                    <button type="button" class="hamburger">
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </button>
                </div>
            </div>
        </header>
        <!--header-->
        @yield('content')
        @yield('quote')

        <!-- //todo 
        Google  reCAPTCHA -->
        

        <!--section_quote-->
        <footer id="footer">
            <div class="top-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cont-ft wow fadeInUp">
                                <figure class="logo-ft wow fadeInUp">
                                    <img src="{{asset('website/images/logo.svg')}}" alt="Logo" class="img-fluid">
                                </figure>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="txt-copy text-center">
                                <p class="copyRight wow fadeInUp">© <?php echo date('Y'); ?> 88CLICKS {{__('web.AllRightsReserved')}} .</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <ul class="list-social wow fadeInUp">
                            @if($setting->facebook != '')    <li><a href="{{$setting->facebook}}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li> @endIf
                            @if($setting->twitter != '')    <li><a href="{{$setting->twitter}}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>@endIf
                            @if($setting->instagram != '')    <li><a href="{{$setting->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>@endIf
                            @if($setting->linkedin != '')    <li><a href="{{$setting->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>@endIf
                            @if($setting->behance != '')    <li><a href="{{$setting->behance}}" target="_blank"><i class="fa-brands fa-behance"></i></a></li>@endIf
                            @if($setting->vimeo != '')    <li><a href="{{$setting->vimeo}}" target="_blank"><i class="fa-brands fa-vimeo-v"></i></a></li>@endIf
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-ft">
                <div class="container">
                    <div class="cont-bt">
                        <p>{{__('web.PoweredBy')}} <a href="https://linekw.com/" target="_blank">Line</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!--footer-->
        <div class="contact-quote wow fadeInUp">
            <a href="#sectionQuote"><i class="fa-solid fa-quote-left"></i> <span>{{__('web.GetQuote')}}</span></a>
        </div>        
        <div class="contact-chat wow fadeInUp">
            <a href=""><i class="fa-solid fa-comment-dots"></i> <span>{{__('web.ChatWithUs')}}</span></a>
        </div>        
        <!-- Modal -->
        <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="closeModal" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                    <div class="modal-body ms-succ">
                        <strong>{{__('web.Success')}}</strong>
                        <figure class="ico-che"><img src="{{asset('website/images/Success.png')}}" alt="" /></figure>
                        <p>{{__('web.The Quote has been submitted successfully. Our team contact you soon')}}.</p>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <!--main-wrapper-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website/js/all.min.js')}}"></script>
    <script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('website/js/wow.js')}}"></script>
    <script src="{{asset('website/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('website/js/script.js')}}"></script>
    <script>
        new WOW().init();
    </script>
    <script>
        $(document).on('click', 'input,select,textarea,.select2', function () {
            $(this).attr('style', "").next('span.errorSpan').remove();//
        });
        var preventSubmit = false;


        $(document).on('click', '#send', function (e) {
            e.preventDefault();

            $(this).closest("#quoteForm").find('select, textarea, input').each(function () {
                if ($(this).prop('required') && !$(this).val() && !$(this).is(":hidden")) {
                    $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove(); //
                    $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#ffff00" class="errorSpan">{{__("web.requiredField")}}</span>');
                    preventSubmit = true;
                    e.preventDefault();
                }
            });
            if (preventSubmit) {
                preventSubmit = false;
                return false;
            }

            var form = $('#quoteForm');
            $.ajax({
                type: form.attr('method'),
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    if (response.status === true) {
                        $('#modalSuccess').modal('show');
                    } else {
                        $.each(response.errors , function(key, val) {
                            $('#quoteForm').find('input[type=text], input[type=email],input[type=password],input[type=number], input[type=radio], input[type=checkbox],select, textarea').each(function(){
                                if ($(this).attr("name")===key && !$(this).is(":hidden")){
                                    $(this).css("border", "#ff0000 solid 1px").next('span.errorSpan').remove(); //
                                    $(this).css("border", "#bd1616 solid 1px").after('<span style="color:#ffff00 ; class="errorSpan">'+val+'</span>');
                                    preventSubmit = true;
                                    e.preventDefault();
                                }
                            })
                        });
                    }
                },
                error: function (jqXHR, error, errorThrown) {

                }
            });

        });

    </script>


</body>

</html>
