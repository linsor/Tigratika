<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Available</th>
            <th>URL</th>
            <th>Price</th>
            <th>Old Price</th>
            <th>CurrencyId</th>
            <th>CategoryId</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Vendor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($offers as $offer)
            <tr>
                <th>{{$offer->offerId}}</th>
                <th>{{$offer->available}}</th>
                <th>{{$offer->url}}</th>
                <th>{{$offer->price}}</th>
                <th>{{$offer->oldprice}}</th>
                <th>{{$offer->currencyId}}</th>
                <th>{{$offer->categoryId}}</th>
                <th>{{$offer->picture}}</th>
                <th>{{$offer->name}}</th>
                <th>{{$offer->vendor}}</th>
            </tr>
        @endforeach
    </tbody>

</table>
