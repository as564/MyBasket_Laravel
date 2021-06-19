@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/register" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Firstname</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control noHover" name="first_name" value="{{ old('name') }}" autofocus>
                                <span class="text-danger error-text name_error"></span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Lastname</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control noHover" name="last_name" value="{{ old('lastname') }}" autofocus>
                                <span class="text-danger error-text lastname_error"></span>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       {{--  <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="m" >
                                    <label class="form-check-label" for="male">
                                      Male
                                    </label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="f">
                                    <label class="form-check-label" for="female">
                                      Female
                                    </label>
                                  </div>
                                  <span class="text-danger error-text gender_error"></span>
                                  @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div> --}}
                        
                          

                        {{-- <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control noHover" name="phone" value="{{ old('phone') }}" autofocus>
                                <span class="text-danger error-text phone_error"></span>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control noHover" name="email" value="{{ old('email') }}" >
                                <span class="text-danger error-text email_error"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control noHover" name="username" value="{{ old('username') }}" autofocus>
                                <span class="text-danger error-text username_error"></span>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control noHover" name="password" >
                                <span class="text-danger error-text password_error"></span>
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div id="message">
                            <p>Password must contain the following:</p>
                            <p id="letter" class="invalid">A lowercase letter</p>
                            <p id="capital" class="invalid">A capital (uppercase)< letter</p>
                            <p id="number" class="invalid">A number</p>
                            <p id="length" class="invalid">Minimum 6 characters</p>
                          </div> --}}

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control noHover" name="password_confirmation" >
                            </div>
                            @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>
                        

                        {{-- <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <select class="form-control" id="city" name="city" aria-label="Default select example">
                                    <option selected value="">select your city</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Bengaluru">Bengaluru</option>
                                    <option value="Delhi">Delhi</option>
                                  </select>
                                  <span class="text-danger error-text city_error"></span>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        
                        {{-- <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image Upload</label>

                            <div class="col-md-6">
                                <label for="image">Select a file:</label>
                                <input type="file" id="image" name="image">
                                <span class="text-danger error-text image_error"></span>
                                
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script >
    $(document).ready(function() {

        $('#addForm').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            //console.log(formData);
            $.ajax({
                type: "POST",
                url:"/register",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    window.location.href = 'http://127.0.0.1:8000/users';
                    
                },
                error: function(error){
                    //console.log(error.responseJSON.errors);
                   // alert("Data not saved");
                   /* const errors = error.responseJSON.errors;
                   const firstItem = Object.keys(errors)[0]
                   const firstItemDOM = document.getElementById(firstItem);
                   const firstErrorMessage = errors[firstItem][0] */
                   //console.log(firstItem);

                    /* const errorMessages = document.querySelectorAll('.text-danger')
                    errorMessages.forEach((element) => element.textContent = '')

                   firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div`) */
                   $.each(error.responseJSON.errors,function(prefix,val){
                       $('span.'+prefix+'_error').text(val[0]);
                   });
                }
            })
        })
    })



</script>

@endsection

