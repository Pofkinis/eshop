@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div style="margin-right: 2%; margin-bottom: 2%;"> <a href="/home"><button type="button" class="btn btn-primary btn-lg">All</button></a> </div>
    <div style="margin-right: 2%; margin-bottom: 2%;"> <a href="{{ route('cheapests') }}"><button type="button" class="btn btn-primary btn-lg">Cheapests</button></a> </div>
    <div style="margin-right: 2%; margin-bottom: 2%;"> <a href="{{ route('forGaming') }}"><button type="button" class="btn btn-primary btn-lg">Gaming</button></a> </div>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Phones</h3></div>

                <div class="card-body"  style="margin: auto; padding-right: 3rem;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($phones))
                        <table class="table table-striped">
                              <div class="row" style="margin: auto;">


                              @foreach ($phones as $phone)
                                <div class="card borderRadius" style="width: 18rem; margin-left: 10px; margin-right: 10px; margin-bottom:2%; background-color: LightGray;">
                                  @foreach( $phone->images as $image)
                                  <div class="" style="width: 18rem; height: 14rem;">
                                    <img class="card-img-top borderRadius " src="/storage/phones/{{$image->path}}" alt="Card image cap" style="width: 100%; height: 100%;">
                                  </div>
                                  <?php break; ?>
                                  @endforeach
                                  <div class="card-body borderRadius" style="background-color: LightGray;">
                                    <div class="column"><h5 class="card-title" style="margin-left: 1%;">{{ $phone->brand }} {{ $phone->model }}</h5></div>
                                    <p class="card-text" style="margin-left: 1%;">{{ $phone->price }} €</p>
                                    <a href="{{ route('phoneDetails', $phone->id) }}" class="btn btn-primary">Preview</a>
                                  </div>
                                </div>
                              @endforeach






                              </div>
                              <div class="row">
                                  <div class="col-12 text-center">
                                      {{ $phones->links() }}
                                  </div>
                              </div>
                        </table>
                        @else
                          <p>No phones found</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
