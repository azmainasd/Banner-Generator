@extends("backend.layouts.app")

@section("view")
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <p class="card-title">Product List</p>
            </div>
          </div>
          @include("backend.layouts.message")
          <div class="row">
            @foreach ($products as $product)
              <div class="col-md-8">
                <div class="card wrapper_card shadow">
                  <div class="product_card">
                    <div class="row">
                      <div class="col-md-4">
                        @if ($product->image_path)
                          <img src="{{ asset($product->image_path) }}" alt="people">
                        @else
                          <img src="{{ $product->url }}" alt="people">
                        @endif
                      </div>
                      <div class="col-md-8">
                        <b>{{ $product->title }}</b>
                        <p class="price_tag">TK {{ $product->price }}</p>
                        <a type="button" class="btn btn-warning btn_order_online btn_order_online">
                          Order Online
                          <i class="fa-solid fa-angle-right"></i>
                        </a>
                        <p class="timestamp">{{ $product->created_at ? $product->created_at->diffForHumans() : '' }}</p>
                      </div>
                    </div>
                    {{-- <div class="weather-info">
                      <div class="d-flex">
                        <div>
                          <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                        </div>
                        <div class="ml-2">
                          <h4 class="location font-weight-normal">Bangalore</h4>
                          <h6 class="font-weight-normal">India</h6>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>
            @endforeach
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
    columnDefs: [{
      orderable: false,
      className: 'select-checkbox',
      targets: 0
    }],
    // select: {
    //   style: 'os',
    //   selector: 'td:first-child'
    // }
  });

  $('#banner_list tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
  } );
</script>
@endsection