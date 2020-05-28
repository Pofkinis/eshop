@extends ('layouts.app')

@section('content')
    <div class="container-fluid" style="background-image: url('../storage/double-bubble-outline.png')">
      <div class="row">
          <div class="col table-padding" style="padding-top: 2%;">
            <h3 style="padding-left: 5%;">Phone specifications</h3>
            <table class="table">
                <tbody>
                  <tr>
                      <td>Brand</td>
                      <td> {{ $phone->brand }} </td>
                  </tr>
                  <tr>
                      <td>Model</td>
                      <td> {{ $phone->model }} </td>
                  </tr>
                  <tr>
                      <td>Screen size</td>
                      <td> {{ $phone->screenSize }} </td>
                  </tr>
                  <tr>
                      <td>RAM size</td>
                      <td> {{ $phone->ramSize }} </td>
                  </tr>
                  <tr>
                      <td>Storage size</td>
                      <td> {{ $phone->storageSize }} </td>
                  </tr>
                  <tr>
                      <td>Color</td>
                      <td> {{ $phone->color }} </td>
                  </tr>
                  <tr>
                      <td>Price</td>
                      <td> {{ $phone->price }} </td>
                  </tr>
                </tbody>
              </table>
          </div>

          <div class="col" style="margin-right: 3%;">



            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

              <ol class="carousel-indicators">
               @foreach( $phone->images as $photo )
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
               @endforeach
              </ol>

              <div class="carousel-inner carouselSize" role="listbox">
                @foreach( $phone->images as $photo )
                   <div class="carousel-item {{ $loop->first ? 'active' : '' }} carouselSize">
                        <img class="d-block img-fluid carouselBorder" src="/storage/phones/{{ $photo->path }}" alt="{{ $photo->title }}" style="width: 100%; height:100%; margin-top: 2%;">

                          <div class="carousel-caption d-none d-md-block">
                          </div>
                   </div>
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>


      </div>
    </div>



@endsection
