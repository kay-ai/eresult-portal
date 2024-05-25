<div class="body body-pd" id="body-pd">
    @include('partials.header')
    @include('partials.sidebar')
    <main>
        <h4 class="text-kdis-2 mb-4">{{$activePage}}</h4>
        @include('includes.messages')
        @yield('content')
    </main>
</div>
