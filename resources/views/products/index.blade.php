@extends('layouts.app')
@section('content')


<!-- Modal -->
<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <form id="addProductForm" enctype="multipart/form-data">
          <div class="modal-body">
          {{ csrf_field() }}

          {{-- <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" name="image" id="image" aria-describedby="imageHelp" placeholder="Enter image">
          </div> --}}

          <div class="form-group">
            <label for="image" class="col-md-4 control-label">Image Upload</label>

            <div class="col-md-6">
                <label for="image">Select a file:</label>
                <input type="file" id="image" name="image">
                <span class="text-danger error-text image_error"></span>
            </div>
        </div>

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            <span class="text-danger error-text name_error"></span>
          </div>

          <div class="form-group">
            <label for="type">Brand</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand">
            <span class="text-danger error-text brand_error"></span>
          </div>

          <div class="form-group">
            <label for="type">Category</label>
            <input type="text" class="form-control" name="category" id="category" placeholder="Category">
            <span class="text-danger error-text category_error"></span>
          </div>

          <div class="form-group">
            <label for="type">Color</label>
            <input type="text" class="form-control" name="color" id="color" placeholder="Color">
            <span class="text-danger error-text color_error"></span>
          </div>

          <div class="form-group">
            <label for="type">Quantity</label>
            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
            <span class="text-danger error-text quantity_error"></span>
          </div>

          <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price">
            <span class="text-danger error-text price_error"></span>
          </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"  >submit</button>
          </div>
        
        </form>
      

      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <form id="deleteFormID">
          <div class="modal-body">
            {{ csrf_field() }}
          {{ method_field('delete') }}
        
        <input type="text" name="id" id="delete_id">
       <p>Are you sure want to delete this item?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"  >Delete</button>
          </div>
        </form>
          
          
      

      
    </div>
  </div>
</div>

<div class="wrapper">
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary addItem" data-toggle="modal" data-target="#productsModal">
  Add item
</button>
    
    <div>
        
        <table id="table_module" class="table table-striped">
            <thead>
                <tr>
                
                    <th>Image</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Color</th>
                    <th>Quantity (Kg.)</th>
                    <th>price (Rs.)</th>
                    <th>Action</th>
                </tr>
                
            </thead>
            @if(count($products) > 0)
        @foreach($products as $product)
            <tbody>
                <tr>
                        <td style="width:20%"><img style="width:100%" src="/storage/images/{{$product->image}}"></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->color }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td> <a href="/products/{{$product->id}}/edit"><i style="padding:0.5em" class="far fa-edit"></i></a> <a href="#"><i style="padding:0.5em" class="fas fa-trash-alt deletebtn"></i></a> </td>
                    </tr>
            </tbody>
            @endforeach
        @endif
        </table>
        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#addProductForm').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            //console.log(formData);
            $.ajax({
                type: "POST",
                url:"/products",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    //console.log(response);
                    $('#productsModal').modal('hide');
                    window.location.reload();
                    
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

<script>
  $('.deletebtn').on('click', function() {

      $('#productsDeleteModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
          return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[1]);
  });

  $('#deleteFormID').on('submit', function(e){
            e.preventDefault();
            var id = $('#delete_id').val();

            $.ajax({
                type: "DELETE",
                url:"/products/"+id,
                data: $('#deleteFormID').serialize(),
                success: function(response) {
                    //console.log(response);
                    $('#productsDeleteModal').modal('hide');
                    window.location.reload();
                    
                    //alert("Data  deleted");
                },
                error: function(error){
                    console.log(error);
                    
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
</script>
@endsection
  