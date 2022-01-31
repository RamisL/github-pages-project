<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <section style="padding-top: 60px;">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Contact Us
                    </div>
                    <div class="card-body">
                        <!-- We send a success message if the form has been send
                             Else we send an error -->
                        @if(session()->has('message_sent'))
                            <div class="alert alert-success" role="alert">
                                {{session()->get('message_sent')}}
                            </div>
                        @endif

                        <form method="POST"  action="{{route('contact.send')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"/>
                                @error('name')
                                <div class="alert-danger"> {{ $message }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" />
                                @error('email')
                                <div class="alert-danger"> {{ $message }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <input type="text" name="phone" class="form-control" />
                                @error('phone')
                                <div class="alert-danger"> {{ $message }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="msg">Message</label>
                                <textarea name="msg" class="form-control" cols="30" rows="10" ></textarea>
                                @error('msg')
                                <div class="alert-danger"> {{ $message }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                @if($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" style="display:block">
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
