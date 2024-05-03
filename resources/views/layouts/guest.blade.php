<div class="row" style="height: 100vh;">
    <div class="col-md-6 position-relative">
        <img src="{{asset('images/kdis-logo.png')}}" class="position-absolute login-logo" style="height: 50px;" alt="">
        <div class="row h-100 justify-content-center align-items-center p-5">
            <div class="col-md-9">
               @yield('content')
            </div>
        </div>
    </div>
    <div class="col-md-6 justify-content-end m-0 d-flex overflow-hidden" style="object-fit: cover;">
        <img src="{{asset('/images/bg-img.jpg')}}" alt="bg-img" style="height: 100vh;">
    </div>
</div>
