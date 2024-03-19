<!doctype html>
<html lang="en">
  <head>
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  </head>
  <body>
    <div class="container">
        
      <div class="card mt-3">
      <div class="bg-dark card-body"><h1 class="text-white text-center p-2">List of Products</h1></div>



      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
          {{ Session::get('success') }}
      </div>
      @endif


      
      <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">      
            <a class="btn btn-success btn-lg" href="{{ route('product.create') }}" role="button">Create</a>
        </div>


      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <table class="table">
            <thead>
              <tr class="table-warning">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Sku</th>
                <th scope="col">Price</th>
                <th scope="col">Added</th>
                <th scope="col">Image</th>
                <th scope="col">Function</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              @if ($products->isNotEmpty())
              @foreach ($products as $p)
              <tr>
                <th scope="row">{{ $p->id }}</th>
                <td>{{ $p->name }}</td>
                <td>{{ $p->sku }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M, Y') }}</td>
                <td>
                  @if ($p->image != '')
                  <img width="100" src="Image/Product/{{ $p->image }}">
                  @else
                  <img width="100" src="Image/none.png">
                  @endif
                  
                </td>
                <td>
                  <a href="{{ route('product.edit',$p->id) }}"><i class="fa-solid fa-pencil" style="color: #22ff05;"></i></a>
                  <a href="javascript:void(0);" onClick="deleteProduct({{ $p->id }});"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>

                  <form id="delete-product-from-{{ $p->id }}" action="{{ route('product.destroy',$p->id) }}" method="post">
                    @csrf
                    @method('delete')
                  </form>
                </td>
              </tr>
              @endforeach
                  
              @else
              <tr>
                <td>No Data Found</td>
              </tr>
              @endif
              
            </tbody>
          </table>
        </div>
        <div class="col-2"></div>

      </div>
      

      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<script>
  function deleteProduct(id){
    if(confirm('Are you sure you want to delete this product?'))
    {
      document.getElementById('delete-product-from-'+id).submit();
    }
  }
</script>