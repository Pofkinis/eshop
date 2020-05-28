@extends ('layouts.app')
<!-- brand, model, screen size, RAM size, storage size, color, price. -->
@section('content')
<div class="row justify-content-center" style="background-image: url('../storage/double-bubble-outline.png')">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3>Enter your phone info</h3> </div>
              <form method = "post" action = "/phones/{{ $phone->id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center inputPadding form-group" style="padding-top: 1%;">
                  <div class="col-md-2" ><p>Brand</p></div>
                  <div class="col-md-10"><input type="text" class="form-control" id="brand" name="brand" placeholder="Enter phone brand" value="{{ $phone->brand }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>Model</p></div>
                  <div class="col-md-10"><input type="text" class="form-control" id="model" name="model" placeholder="Enter phone model" value="{{ $phone->model }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>Screen size</p></div>
                  <div class="col-md-10"><input type="number" class="form-control" id="screenSize" name="screenSize" placeholder="Enter phone screen size" value="{{ $phone->screenSize }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>RAM size</p></div>
                  <div class="col-md-10"><input type="number" class="form-control" id="ramSize" name="ramSize" placeholder="Enter phone RAM size" value="{{ $phone->ramSize }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>Storage size</p></div>
                  <div class="col-md-10"><input type="number" class="form-control" id="storageSize" name="storageSize" placeholder="Enter phone storage size" value="{{ $phone->storageSize }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>Color</p></div>
                  <div class="col-md-10"><input type="text" class="form-control" id="color" name="color" placeholder="Enter phone color" value="{{ $phone->color }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>Price</p></div>
                  <div class="col-md-10"><input type="number" class="form-control" id="price" name="price" placeholder="Enter phone price" value="{{ $phone->price }}"></div>
                </div>
                <div class="row justify-content-center inputPadding form-group">
                  <div class="col-md-2" ><p>Add images</p></div>
                  <div class="col-md-10"><input multiple="multiple" type="file" accept="image/*" class="form-control" name="paths[]" id="paths"></div>
                </div>
                <div class="inputPadding">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
          </div>
        </div>
    </div>

@endsection
