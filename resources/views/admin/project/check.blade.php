@if(!empty($result))
    <h2>File: <strong>{{$FileID}}</strong> <span class="badge badge-important"><i class="fa fa-ban"></i></h2>
    <div class="alert alert-error">
        Error Message <strong>{{ $result['error_msg'] }}</strong><br>
        On <strong>{{ $result['error_line'] }}</strong>
    </div>
    @else
    <h2>File: <strong>{{$FileID}}</strong> <span class="badge badge-success"><i class="fa fa-check"></i></h2>
    <div class="alert alert-success">
        PHP source code syntax looks okay !
    </div>
@endif