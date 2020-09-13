@php
    $session =session('response_msg');
@endphp
@if (!empty($session))
    @if ($session['code'] == 'success')
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-succes alert-dismissable" >
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>Alert!</h4>
                {!! $session['msg']!!}
            </div>
        </div>
    @else 
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger alert-dismissable" >
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>Alert!</h4>
                {!! $session['msg']!!}
            </div>
        </div>
    @endif
    @php
        session()->forget('response_msg');
    @endphp
    
@endif