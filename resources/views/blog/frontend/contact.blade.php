@extends('blog.frontend.layouts.app')
@section('blog.frontend.layouts.header')
@section('content')
<div class="col-xl-10  ">
    @if(session('success'))
    <div class="alert alert-success text-center">
       {{session('success')}}
    </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card border-0 rounded-3 shadow-lg overflow-hidden mb-5">
      <div class="card-body p-0">
        <div class="row g-0">
          <div class="col-sm-6 d-none d-sm-block bg-image" style="  background-image: url('{{asset('blog/assets/img/about-bg.jpg')}}');
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;"></div>
          <div class="col-sm-6 p-4">
            <div class="text-center">
              <div class="h3 fw-light">İletişim Form</div>
              <p class="mb-4 text-muted">Bilgilerinizi giriniz.</p>
            </div>

            <!-- * * * * * * * * * * * * * *
        // * * SB Forms Contact Form * *
        // * * * * * * * * * * * * * * *

        // This form is pre-integrated with SB Forms.
        // To make this form functional, sign up at
        // https://startbootstrap.com/solution/contact-forms
        // to get an API token!
        -->

            <form action="{{route('contact.post')}}" method="POST">
                @csrf
              <!-- Name Input -->
              <div class="form-floating mb-3">
                <input class="form-control" name="name" type="text" placeholder="Name" data-sb-validations="required" value="{{old('name')}}"/>
                <label for="name">Ad Soyad</label>
                <div class="invalid-feedback" data-sb-feedback="name:required">*İsim alanı zorunludur</div>
              </div>

              <!-- Email Input -->
              <div class="form-floating mb-3">
                <input class="form-control" name="email" type="email" placeholder="Email Address" data-sb-validations="required,email" value="{{old('email')}}" />
                <label for="emailAddress">Email </label>
                <div class="invalid-feedback" data-sb-feedback="emailAddress:required">*Email alanı zorunludur.</div>
                <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email adresi geçersiz.</div>
              </div>

              <!-- Message Input -->
              <div class="form-floating mb-3">
                <textarea class="form-control" name="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required" value="{{old('message')}}"></textarea>
                <label for="message">Mesajınız</label>
                <div class="invalid-feedback" data-sb-feedback="message:required">*Mesaj alanı zorunludur.</div>
              </div>

              
              <!-- Submit button -->
              <div class="d-grid">
                <button class="btn btn-primary btn-lg  " id="submitButton" type="submit">Gönder</button>
              </div>
            </form>
            <!-- End of contact form -->

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
@section('blog.frontend.layouts.footer')