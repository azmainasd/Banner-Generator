@extends("backend.layouts.app")

@section("view")
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create new banner</h4>
          <form method="POST" action={{ route('banner-store') }} enctype="multipart/form-data" class="forms-sample">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Category</label>
              <input 
                type="text" 
                name="category"
                class="form-control @error('category') is-invalid @enderror" 
                id="exampleInputUsername1" 
                placeholder="Username"
              >
              {{-- @error('category') --}}
                <span class="invalid-feedback category d-block" role="alert">
                    <strong></strong>
                </span>
              {{-- @enderror --}}
            </div>

            <div class="DataTableBox shadow">
              <div class="table-abc">
                <table class="table" id="task-table">
                    <thead>
                    <tr>
                        <th>Image Link/upload</th>
                        <th>Content</th>
                        <th>Price</th>
                        <th>Custom Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- <tr id="row_to_copy" style="display:none;">
                          <td>
                            <div class="form-group">
                              <label>File upload</label>
                              <input type="file" name="images[]" class="d-none">
                              <div class="input-group w-380px col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append" onClick="fileUpload($(this))">
                                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div>
                            </div>
                            <textarea name="links[]" class="form-control w-380px pb-1" placeholder="URL" cols="50"></textarea>
                          </td>
                            
                            <td><img class="img-show" src="#" style="display:none; border-radius:0; height:150px; width:150px;"/></td>

                            <td>
                                <input type="text" class="form-control" name="prices[]" style="width:100px;">
                            </td>

                            <td>
                                <input type="text" class="form-control" name="custom_titles[]" style="width:100px;">
                            </td>

                            <td>
                                <button onclick="rowAdd($(this))" style="background-color:green;border:none;height:30px;width:30px;"><i class="fa fa-plus" style="color:white"></i></a>
                                <button onclick="rowRemove($(this))" style="background-color:red;border:none;height:30px;width:30px;display:none;"><i class="fa fa-minus" style="color:white"></i></button>
                            </td>
                        </tr> --}}
                        <tr id="row_to_copy" class="tr0">
                            <td>
                                <div class="form-group">
                                  <label>File upload</label>
                                  <input type="file" name="images[]" class="d-none" id="images">
                                  <div class="input-group w-380px col-xs-12">
                                    <input type="text" class="form-control file-upload-info @error('images') is-invalid @enderror" disabled placeholder="Upload Image">
                                    <span class="input-group-append" onClick="fileUpload($(this))">
                                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                  </div>
                                </div>
                                <textarea name="links[]" class="form-control w-380px pb-1 mb-2" id="links" placeholder="URL" cols="50"></textarea>
                                {{-- @error('images') --}}
                                  <span class="invalid-feedback img d-block" role="alert">
                                      <strong></strong>
                                  </span>
                                {{-- @enderror --}}
                            </td>
                            
                            <td><img class="img-show" src="#" style="display:none; border-radius:0; height:150px; width:150px;" height="100%" width="100%" /></td>

                            <td>
                                <input type="text" class="form-control" name="prices[]" id="prices">
                                <span class="invalid-feedback prices d-block" role="alert">
                                  <strong></strong>
                                </span>
                            </td>

                            <td>
                                <input type="text" class="form-control" name="product_titles[]" id="product_titles">
                                <span class="invalid-feedback product_titles d-block" role="alert">
                                  <strong></strong>
                                </span>
                            </td>

                            <td>
                                <button onclick="rowAdd($(this))" style="background-color:green;border:none;height:30px;width:30px;"><i class="fa fa-plus" style="color:white"></i></a>
                                <button onclick="rowRemove($(this))" style="background-color:red;border:none;height:30px;width:30px;display:none;"><i class="fa fa-minus" style="color:white"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
            <div class="button-group mt-3">
              <button type="submit" class="btn btn-primary mr-2" id="submit_data" onclick="Validator($(this))">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
@endsection

@section("jscripts")
<script>
  var count = 0
  function rowAdd(This){
      event.preventDefault(); // to prevent button's default submit action
      let rCount = ++count
      // console.log($("#row_to_copy").clone())
      let newRow = $("#row_to_copy:last-child").clone().appendTo("tbody").removeClass().addClass(`tr${rCount}`).show();
      newRow.find('.img-show').hide();
      newRow.find('input').val('');
      // console.log("new:", newRow.next().find('.img-show'));
      This.hide();
      This.next().show();
  }
  function rowRemove(This){
      event.preventDefault(); // to prevent button's default submit action
      This.closest('tr').remove();
  }

  function fileUpload(This){
      let imgElement = This.parent().prev()
      imgElement.trigger('click');
      
        imgElement.change(function(){
          let filename = imgElement.val();
          console.log(/^\s*$/.test(filename))

          if (/^\s*$/.test(filename)) {
              This.prev().val("No file chosen...");
          } else {
            console.log(This.prev())
              This.prev().val(filename.replace("C:\\fakepath\\", ""));
          }

          This.next().val('');
          const file = this.files[0];
          if (file){
              let reader = new FileReader();
              reader.onload = function(event){
                  This.closest('td').next().find('.img-show').attr('src', event.target.result);
                  This.closest('td').next().find('.img-show').show();
              }
              reader.readAsDataURL(file);
          }else{
            This.closest('td').next().find('.img-show').hide();
          }
      });
  }
  $('textarea').keyup(function(){
      console.log($(this))
      $(this).closest('td').next().find('.img-show').attr('src',$(this).val());
      $(this).closest('td').next().find('.img-show').show();
  });
  // $('#submit_data').on('click' (e) => {
  //   e.preventDefault();
  // })

  function Validator(e){
    console.log('hello')
   //  ...bla bla bla... the checks
    event.preventDefault();

    let flag = true
    if(!$("#exampleInputUsername1").val()){
      $('.invalid-feedback.category strong').text('The category field is required.')
      console.log('inside check')
      flag = false
    }

   for(let idx = 0; idx <= count; idx++ ){
      console.log()

      $(`.tr${idx} #images`).val() || $(`.tr${idx} #links`).val() ? 
      $(`.tr${idx} .img strong`).text('') : 
      ( $(`.tr${idx} .img strong`).text('Image or link is required.'), flag = false )

      $(`.tr${idx} #prices`).val() ? 
      $(`.tr${idx} .prices strong`).text('') : 
      ($(`.tr${idx} .prices strong`).text('The field is required.'), flag = false)

      $(`.tr${idx} #product_titles`).val() ? 
      $(`.tr${idx} .product_titles strong`).text('') : 
      ($(`.tr${idx} .product_titles strong`).text('The field is required.'), flag = false)

      console.log(flag) 
   }

    console.log(flag) 

    flag ? $('form').submit() : ''

  //  $('form').submit()
  //  if(                              ){
  //     document.getElementById('theFormID').submit();
  //     return(true);
  //  }else{
  //     return(false);
  //  }
}
</script>
@endsection