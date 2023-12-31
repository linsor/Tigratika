@extends('main.main')

@section('Content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="form-group w-50">
                    <label for="exampleInputFile">Загрузка файла xml</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name = 'PostImage'>
                            <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
