@extends('auth.layout')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--
<div class="container">

    <form action="{{ route('store')}}" method="post">
        @csrf
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
          <input type="text" id="form2Example1" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')}}"/>

          @if($errors->has('name'))
            <span class="tetx-danger">{{ $errors->first('name')}}</span>
          @endif
          <label class="form-label" for="form2Example1">Name</label>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
          <input type="email" id="form2Example2" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email')}}"/>
            @if($errors->has('email'))
                <span class="tetx-danger">{{ $errors->first('email')}}</span>
            @endif
          <label class="form-label" for="form2Example2">Email Address</label>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
          <input type="password" id="form2Example2" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
            @if($errors->has('password'))
            <span class="tetx-danger">{{ $errors->first('password')}}</span>
            @endif
          <label class="form-label" for="form2Example2">Password</label>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
          <input type="password" id="form2Example2" class="form-control" id="password_confirmation" name="password_confirmation"/>
          <label class="form-label" for="form2Example2">Confirm Password</label>
        </div>

        <!-- Submit button -->
        <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Register</button>

      </form>

</div>
 --}}
@endsection
