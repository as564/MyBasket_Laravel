@extends('layouts.app')
@section('content')


<!-- Modal -->
<div class="modal fade" id="categoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <form id="addForm" enctype="multipart/form-data">
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
            <label for="type">Type</label>
            <input type="text" class="form-control" name="type" id="type" placeholder="Type">
            <span class="text-danger error-text type_error"></span>
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
<div class="modal fade" id="categoriesDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        
        <input type="hidden" name="id" id="delete_id">
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
<button type="button" class="btn btn-primary addItem" data-toggle="modal" data-target="#categoriesModal">
  Add item
</button>
    
    <div>
        
        <table id="table_module" class="table table-striped">
            <thead>
                <tr>
                
                    <th>Image</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                
            </thead>
            @if(count($categories) > 0)
        @foreach($categories as $category)
            <tbody>
                <tr>
                        <td style="width:20%"><img style="width:100%" src="/storage/images/{{$category->image}}"></td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->type }}</td>
                        <td> <a href="/categories/{{$category->id}}/edit"><i style="padding:0.5em" class="far fa-edit"></i></a> <a href="#"><i style="padding:0.5em" class="fas fa-trash-alt deletebtn"></i></a> </td>
                    </tr>
            </tbody>
            @endforeach
        @endif
        </table>
        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#addForm').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            console.log(formData);
            $.ajax({
                type: "POST",
                url:"/categories",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    //console.log(response);
                    $('#categoriesModal').modal('hide');
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

      $('#categoriesDeleteModal').modal('show');

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
                url:"/categories/"+id,
                data: $('#deleteFormID').serialize(),
                success: function(response) {
                    //console.log(response);
                    $('#categoriesDeleteModal').modal('hide');
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
  