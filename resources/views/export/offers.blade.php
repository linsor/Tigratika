@extends('main.main')

@section('Content')
    

<div class="container">
    <div class="row">

        @foreach ($offers as $offer)
            <div class="card mb-3 mr-3" style="max-width: 540px;">
                    <div class="row g-0 md-3">
                        <div class="col-md-4">
                            <img src="{{$offer->picture}}" style="max-width: 150px" class="img-fluid rounded-start mt-2 ml-2" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$offer->offerId }}</h5>
                                <p class="card-text">{{ $offer->url }}</p>
                                <p class="card-text">{{ $offer->price }} {{ $offer->currencyId }}
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
        <div>
            {{$offers->links()}}
        </div>
    </div>
</div>

@endsection
