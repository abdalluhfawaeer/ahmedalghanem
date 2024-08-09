@include('layout.admin.head')
<br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>أحمد عيال غانم</h5>
                </div>
                <div class="card-body">
                    <form role="form text-left" action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" >
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">تسجيل الدخول</button>
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <br>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>


@include('layout.admin.footer')
