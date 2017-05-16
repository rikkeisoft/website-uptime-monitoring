@extends("../main")
@section('title')
Register
@endsection

@section('content')
<div class="container">
    <form action="{{asset('register')}}" method="POST"  id="form-register">
        {{ csrf_field() }}
        <legend>Rigister</legend>

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email"  id="email"  class="form-control"  placeholder="Email">
        </div>
        <div class="form-group">
            <label for="">Username</label>
            <input type="text"  name="username" id="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password"  name="password" id="password" class="form-control"  placeholder="Password">
        </div>
        <div class="form-group">
            <label for="">Password Confirmation</label>
            <input type="password"  name="password_confirmation" id="password_confirmation"  class="form-control"  placeholder="Password confirmation">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $("#form-register").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlengh:20,
            },
            password: {
                required: true,
                minlength: 6,
                maxlengh:20,
            },
            password_confirmation: {
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true,
                minlength:3,
                maxlengh:100,
            }
        }
    })
</script>
@endsection