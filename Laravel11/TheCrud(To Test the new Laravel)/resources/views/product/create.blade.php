<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="card mt-3">
      <div class="bg-dark card-body"><h1 class="text-white text-center p-2">Create a product</h1></div>
      <form enctype="multipart/form-data" action="{{ route('product.store') }}" method="post">
        @csrf
      <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end m-3">      
          <a class="btn btn-info btn-lg" href="{{ route('product.index') }}" role="button">Back</a>
      </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input value="{{ old('name') }}" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" placeholder="Product's name" name="name">
          @error('name')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="sku" class="form-label">Sku</label>
          <input value="{{ old('sku') }}" type="text" class="form-control form-control-lg @error('sku') is-invalid @enderror" id="sku" placeholder="Product's sku" name="sku">
          @error('sku')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input value="{{ old('price') }}" type="text" class="form-control form-control-lg @error('price') is-invalid @enderror" id="price" placeholder="Product's price" name="price">
          @error('price')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control form-control-lg" id="description" placeholder="Product's description" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control form-control-lg" id="image" placeholder="Product's image" name="image">
          @error('image')
          <p class="invalid-feedback">{{ $message }}</p>
          @enderror
          
        </div>
        
        <div class="d-grid">
          <button class="btn btn-lg btn-success" type="submit">Create now</button>
        </div>
      </div>
      
      </form>
             
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>