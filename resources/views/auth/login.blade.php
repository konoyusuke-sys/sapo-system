@section('title', 'Login')
@section('layout_css')
    <style>
        #box-login-personalize{
            width: 360px;
            margin: 3% auto;
        }
    </style>
@stop

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('layouts.AdminLTE._includes._head')

    </head>
    <body class="hold-transition login-page">
        <div class="hidden-lg hidden-md hidden-sm">
            <br/><br/>
        </div>
        <div id="box-login-personalize">
            <div class="login-logo">
                
                
                <br/>
                <br/>
                {!! \App\Models\Config::find(1)->titulo_login !!}             
            </div>
            <div class="login-box-body">
                
                <form  method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" placeholder="メールアドレス" name="email" value="{{ old('email') }}" autofocus required="" AUTOCOMPLETE='off'>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" class="form-control" placeholder="パスワード" name="password" required="" AUTOCOMPLETE='off'>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <br/>
                            <span class="help-block">
                                <strong><p class="text-red">メールアドレスが正しくありません。</p></strong>
                            </span>
                        @endif
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>パスワードが正しくありません。</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">  
                        
                        <br/>
                        <div class="col-xs-12">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
                        </div>  
                        <br/><br/><br/>
                        
                    </div>                  
                </form> 
            </div>
        </div>

        @include('layouts.AdminLTE._includes._script_footer')
        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%'
            });
          });
        </script>
    </body>
</html>