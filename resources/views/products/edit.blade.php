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
                    
                    <input type="hidden" class="form-control" name="id" id="id" value="{{ $product->id }}">
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                    <span class="text-danger error-text name_error"></span>
                </div>

                <div class="form-group">
                    <label for="type">Brand</label>
                    <input type="text" class="form-control" name="brand" id="brand" value="{{ $product->brand }}">
                    <span class="text-danger error-text brand_error"></span>
                </div>

                <div class="form-group">
                    <label for="type">Category</label>
                    <input type="text" class="form-control" name="category" id="category" value="{{ $product->category }}" placeholder="Category">
                    <span class="text-danger error-text category_error"></span>
                  </div>

                <div class="form-group">
                    <label for="type">Color</label>
                    <input type="text" class="form-control" name="color" id="color" value="{{ $product->color }}">
                    <span class="text-danger error-text color_error"></span>
                </div>

                <div class="form-group">
                    <label for="type">Quantity</label>
                    <input type="text" class="form-control" name="quantity" id="quantity" value="{{ $product->quantity }}">
                    <span class="text-danger error-text quantity_error"></span>
                </div>

                <div class="form-group">
                    <label for="type">Price</label>
                    <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
                    <span class="text-danger error-text price_error"></span>
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
                //console.log(id);
                let formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url:"/products/"+id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        //$('#categoriesModal').modal('hide');
                        window.location.href = 'http://127.0.0.1:8000/products';
                        
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
  