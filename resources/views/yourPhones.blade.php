@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Your phones</div>

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
                              <div class="card borderRadius" style="width: 18rem; margin-left: 10px; margin-right: 10px; margin-right: 10px; margin-bottom:2%; background-color: LightGray;">
                                @foreach( $phone->images as $image)
                                <div class="" style="width: 18rem; height: 14rem;">
                                  <img class="card-img-top borderRadius" src="/storage/phones/{{$image->path}}" alt="Card image cap" style="width: 100%; height: 100%;">
                                </div>
                                <?php break; ?>
                                @endforeach
                                <div class="card-body borderRadius" style="background-color: LightGray;">
                                  <div class="column"><h5 class="card-title" style="margin-left: 1%;">{{ $phone->brand }} {{ $phone->model }}</h5></div>
                                  <p class="card-text" style="margin-left: 1%;">{{ $phone->price }} €</p>
                                  <div class="row">
                                    <div class="col-mid-4" style="padding-right: 25%;"><a href="{{ route('phoneDetails', $phone->id) }}" class="btn btn-primary">Preview</a></div>
                                    <div class="col-mid-4" style="padding-right: 1%;"> <a href="/phones/{{ $phone->id }}/edit"><button name="button" class="btn btn-info float-bottom">Edit</button></a> </div>
                                    <form class="" action="/phones/{{ $phone->id }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <div class="col-mid-4"> <button type="submit" name="button" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</button> </div>
                                    </form>

                                  </div>
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
                        <p>You have no phones added</p>
                @endif
              </div>
          </div>
      </div>
  </div>
        </div>
    </div>
</div>
@endsection
