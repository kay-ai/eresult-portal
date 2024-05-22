@if (session()->has('success'))
    <div class="alert bg-secondary text-white mr-2 alert-kdis" role="alert">
        <i class="fa fa-check-circle"></i>
        <span class="px-2">{{session('success')}}</span>
        <a href="javascript:void(0);" class="text-white ms-4 close-alert" onclick="alertClose();"><i class="fa fa-times"></i></button>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert bg-danger text-white mr-2 alert-kdis" role="alert">
        <i class="fa fa-times-circle"></i>
        @if (is_array(session('error')))
            @foreach (session('error') as $error)
                <span class="px-2">{{ $error[0] }}</span>
            @endforeach
        @else
            <span class="px-2">{{ session('error') }}</span>
        @endif
        <a href="javascript:void(0);" class="text-white ms-4 close-alert" onclick="alertClose();"><i class="fa fa-times"></i></a>
    </div>
@endif

@push('js')
<script>
    $(document).ready(function(){
        $('.alert-kdis').delay(5000).fadeOut(2000);

        $('.close-alert').click(function(){
            $('.alert-kdis').fadeOut(2000);
        });
    });
</script>
@endpush
