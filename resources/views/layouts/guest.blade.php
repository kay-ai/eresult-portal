<div class="row" style="height: 100vh;">
    <div class="col-md-6 position-relative">
        <img src="{{asset('/images/benpoly-logo.png')}}" class="position-absolute login-logo" alt="">
        <div class="row h-100 justify-content-center align-items-center p-5">
            <div class="col-md-9">
               @yield('content')
            </div>
        </div>
    </div>
    <div class="col-md-6 justify-content-end m-0 d-flex overflow-hidden" style="object-fit: cover;">
        <img src="{{asset('/images/bg-img-2.jpg')}}" alt="bg-img" style="object-fit: cover; filter: saturate(0.5);">
    </div>
</div>
