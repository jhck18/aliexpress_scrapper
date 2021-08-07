@include('mainLayout')

    <div class="container">
    <div class="row">
        @foreach($res as $key => $value)
            <div class="col-md-3 wrapper">
                <div class="card text-center mt-4">
                    <h5 class="card-header">{{ $value['store'] }}</h5>
                    <h5 class="card-id" hidden>{{ $value['product_id'] }}</h5>
                    <div class="card-body">
                        <img src="{{$value['img_url']}}">
                        <p class="card-text">{{ $value['title'] }}</p>
                        <p class="card-price"><b>US ${{ $value['price'] }}</b></p>
                        <a href="/specificProdDetails/{{ $value['product_id'] }}" class="btn btn-primary">See details</a>
                        <a href="/delete/{{ $value['product_id'] }}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>