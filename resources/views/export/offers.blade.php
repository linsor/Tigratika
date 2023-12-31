@extends('main.main')

@section('Content')
    

<div class="container">
    <div class="row">
        @foreach ($offers as $offer)
            <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0 md-3">
                        <div class="col-md-4">
                            <img src="{{$offer->picture}}" style="max-width: 150px" class="img-fluid rounded-start mt-2 ml-2" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$offer->offerId }}</h5>
                                <p class="card-text">{{ $offer->url }}</p>
                                <p class="card-text">{{ $offer->price }}
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


<div class="form-group w-50">
    <label for="exampleInputFile">Загрузка изображения</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name = 'PostImage'>
            <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
        </div>
    </div>
</div>