@extends("template_home")

@section('content')
    <div class="image-bg-fluid-height">
        <div class="container">
            <h1 class="home-title-header">DOWNTIME HURTS</br> ARE YOU READY?</h1>
            <p class="center header-button-account">
                <a href="{{ route('register') }}"><button type="button" class="btn btn-primary btn-lg">Get a Free Account</button></a>
            </p>
            <img class="img-responsive img-center img-homepgae" src="{{ asset('../img/image-home-page.png') }}" alt="">
        </div>

    </div>
    @component("teamplate_footer")

    @endcomponent
@endsection

