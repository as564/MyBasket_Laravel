@extends('layouts.app')
@section('content')
    <div class="wrapper">
        <div>
            <form id="editForm" enctype="multipart/form-data">
                
                {{ csrf_field() }}
    
                <div class="form-group">
                    <label for="image" class="col-md-4 control-label">Image Upload</label>
    
                    <div class="col-md-6">
                        <label for="image">Select a file:</label>
                        <input type="file" id="image" name="image">
                        <span class="text-danger error-text image_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    
                    <input type="hidden" class="form-control" name="id" id="id" value="{{ $category->id }}">
                    
                </div> 
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                    <span class="text-danger error-text name_error"></span>
                </div>
    
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" name="type" id="type" value="{{ $category->type }}">
                    <span class="text-danger error-text type_error"></span>
                </div>
    
                
    
               
                    
                    <button type="submit" class="btn btn-primary"  >submit</button>
                
                
            </form>
        </div>   
    </div>
            
    <script type="text/javascript">
        $(document).ready(function() {
    
            $('#editForm').on('submit', function(e){
                e.preventDefault();
                var id = $('#id').val();
                console.log(id);
                let formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url:"/categories/"+id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        //$('#categoriesModal').modal('hide');
                        window.location.href = 'http://127.0.0.1:8000/categories';
                        
                        //alert("Data  saved");
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
                       $.each(error.responseJSON.errors,function(prefix,val){
                           $('span.'+prefix+'_error').text(val[0]);
                       });
                    }
                })
            })
        })
    </script>
        @endsection
  