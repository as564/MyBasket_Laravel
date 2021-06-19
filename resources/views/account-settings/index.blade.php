@extends('layouts.app')
@section('content')

<div class="wrapper">
    <div>
      <form id="accountSettingForm" enctype="multipart/form-data">
        <div class="modal-body">
        {{ csrf_field() }}

        {{-- <div class="form-group">
          <label for="image">Image</label>
          <input type="text" class="form-control" name="image" id="image" aria-describedby="imageHelp" placeholder="Enter image">
        </div> --}}

        <div class="form-group">
          <label for="image" class="col-md-4 control-label">Profile Image</label>

          <div class="col-md-6">
              <label for="image">Select a file:</label>
              <input type="file" id="image" name="image">
              <span class="text-danger error-text image_error"></span>
          </div>
      </div>

        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" >
          <span class="text-danger error-text name_error"></span>
        </div>

        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
          <span class="text-danger error-text brand_error"></span>
        </div>

        <div class="form-group">
          <label for="email">Email Id</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Email Id">
          <span class="text-danger error-text color_error"></span>
        </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      
      </form>
        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#accountSettingForm').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            //console.log(formData);
            $.ajax({
                type: "POST",
                url:"/account-settings",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    
                    //window.location.reload();
                    
                    alert("Data  sent");
                },
                error: function(error){
                    console.log(error);
                    //alert("Data not saved");
                   /* const errors = error.responseJSON.errors;
                   const firstItem = Object.keys(errors)[0]
                   const firstItemDOM = document.getElementById(firstItem);
                   const firstErrorMessage = errors[firstItem][0] */
                   //console.log(firstItem);

                    /* const errorMessages = document.querySelectorAll('.text-danger')
                    errorMessages.forEach((element) => element.textContent = '')

                   firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div`) */
                   /* $.each(error.responseJSON.errors,function(prefix,val){
                       $('span.'+prefix+'_error').text(val[0]);
                   }); */
                }
            })
        })
    })

</script>
@endsection
  