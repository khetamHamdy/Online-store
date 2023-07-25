@extends('layout.siteLayout')
@section('css')

@endsection

@section('content')

    <section class="section_page_site">
        <div class="container">
            <div class="cont-not-found">
                <div class="thumb-not-found wow fadeInUp">
                    <figure><img src="{{asset('website/images/logo-color.png')}}" alt="Images 404" /></figure>
                </div>
                <div class="txt-not-found wow fadeInUp">
                    <h5>PAGE NOT FOUND</h5>
                    <p>Ut Porta Ultricies Mauris Varius Congue. Sed At Orci Tempor, Molestie Nisl Sed, Efficitur Massa. Etiam Eros Nisl, Finibus At Molestie Et, Sodales Nec Lorem. Aliquam Maximus, Sem Laoreet Porttitor Pellentesque, Eros Ipsum Aliquam Odio, Non Blandit Diam Metus Id Tellus. Proin Vestibulum Nunc Erat, A Ultrices Velit Vehicula Et. Mauris Tristique Arcu Turpis, At Posuere Massa </p>
                    <a href="" class="btn-site-other"><span>Go Back</span></a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </section>
    <!--section_page_site-->
@endsection

@section('script')
<script>
    $("#backLink").click(function(event) {
        event.preventDefault();
        history.back(1);
    });
</script>
@endsection

