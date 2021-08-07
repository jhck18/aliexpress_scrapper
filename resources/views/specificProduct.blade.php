@include('mainLayout')


<div class="row mt-4">
    <div class="col-lg-6">
        <div class="container">
            <div class="row">
                @foreach($data as $key => $value)
                    <div class="col-md-12 wrapper">
                        <div class="card text-center mt-4">
                            <h5 class="card-header">{{ $value['store'] }}</h5>
                            <h5 class="card-id" hidden>{{ $value['product_id'] }}</h5>
                            <div class="card-body">
                                <p class="card-text">{{ $value['title'] }}</p>
                                <p class="card-price"><b>US ${{ $value['price'] }}</b></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
         </div>
         <div class="container">
            <div class="row">
                @foreach($data as $key => $value)
                    <div class="col-md-12 wrapper">
                        <div class="card text-center mt-4">
                            <h5 class="card-header">Description</h5>
                            <div class="card-body">
                                <p class="card-text">{!! $value['description'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
         </div>
    </div>
    <div id="carouselExampleControls" class="carousel slide col-lg-4" data-ride="carousel">
    <div class="carousel-inner">
    @foreach($data as $key => $value)
            @foreach($value['image'][0] as $key => $val)
                <div class="carousel-item">
                <img class="d-block w-100" src="{{$val}}" alt="First slide">
                </div>
            @endforeach
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
<script>
     $('document').ready(function(){
        $('.carousel-inner div:first-child').addClass( "active" );
     });
</script>