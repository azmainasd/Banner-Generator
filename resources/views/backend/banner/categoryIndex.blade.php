@extends("backend.layouts.app")

@section("view")
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <p class="card-title">Banner List</p>
            </div>
            <div class="col-md-6 text-right">
              <a 
                type="button" 
                href={{ route('banner-create') }} 
                class="btn btn-inverse-primary btn-fw"
              >
                New Banner
              </a>
            </div>
          </div>
          @include("backend.layouts.message")
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="banner_list" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Title</th>
                      <th>Impression</th>
                      <th>Clicks</th>
                      <th>CTR</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $category->name ? $category->name : '' }}</td>
                        <td>{{ $category->impressions ? $category->impressions : '0' }}</td>
                        <td>{{ $category->clicks ? $category->clicks : '0' }}</td>
                        <td>{{ $category->clicks ? $category->clicks : '0' }}</td>
                        <td>{{ $category->created_at ? date('d M, Y', strtotime($category->created_at)) : '0' }}</td>
                        <td style="width: 26%;">
                          <a href={{ route('banner_show', $category->id) }} class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-eye" style="margin-right: 5px; font-size:12px;"></i>
                            view
                          </a>
                          <a href={{ route('banner_edit', $category->id) }} class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil" style="margin-right: 5px; font-size:12px;"></i>
                            Edit
                          </a>
                          <button type="button" class="btn btn-outline-danger btn-sm">
                            <i class="fa fa-trash" style="margin-right: 5px; font-size:12px;"></i>
                            Delete
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
@endsection

@section("jscripts")
<script>
  $('#banner_list').DataTable( {
    // "ajax": "js/data.txt",
    // "columns": [
    //   { "data": "Quote" },
    //   { "data": "Product" },
    //   { "data": "Business" },
    //   { "data": "Policy" }, 
    //   { "data": "Premium" }, 
    //   { "data": "Status" }, 
    //   { "data": "Updated" }, 
    //   {
    //     "className":      'details-control',
    //     "orderable":      false,
    //     "data":           null,
    //     "defaultContent": ''
    //   }
    // ],
    "order": [[1, 'asc']],
    "paging":   false,
    "ordering": true,
    "info":     false,
    "filter": false,
    // columnDefs: [{
      orderable: true,
      // className: 'select-checkbox',
      targets: 0
    }],
    // select: {
    //   style: 'os',
    //   selector: 'td:first-child'
    // }
  });


</script>
@endsection