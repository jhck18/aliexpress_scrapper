@include('mainLayout')

<div class="container">
    <div class="row">
        @foreach($data as $key => $value)
            <div class="col-md-3 wrapper">
                <div class="card text-center mt-4">
                    <h5 class="card-id" hidden>{{ $key }}</h5>
                    <h5 class="card-header">{{ $value['storeName'] }}</h5>
                    <div class="card-body">
                        <img src="{{$value['image']}}">
                        <p class="card-text">{{ $value['title'] }}</p>
                        <p class="card-price"><b>{{ $value['price'] }}</b></p>
                        <button type="button" class="btn btn-outline-primary">Save</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    $('document').ready(function(){
        $('button').on('click', function(){
        let this_button = $(this),
            this_card = this_button.closest('.card'),
            this_id = this_card.find('.card-id').text(),
            this_store = this_card.find('.card-header').text(),
            this_title = this_card.find('.card-text').text(),
            this_price = this_card.find('.card-price').text(),
            this_imgUrl = this_card.find('img').attr('src');

        $.ajax({
                type: "POST",
                url: "/saveArticle",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    'id': this_id,
                    'title': this_title,
                    'price': this_price,
                    'store': this_store,
                    'img_url':this_imgUrl
                },
                success: function (data) {
                    $('body').append('<div class="alert alert-success" style="position: fixed;top: 75px; right: 15px;"><strong>Success!</strong> Your article has been saved successfully.</div>');
                    $('.alert-success').fadeOut(3500, function(){
                        $(this).remove();
                    });
                },
                error: function (e) {
                    $('body').append('<div class="alert alert-danger" style="position: fixed;top: 75px; right: 15px;"><strong>Success!</strong> Your article has been not saved successfully.</div>');
                    $('.alert-success').fadeOut(3500, function(){
                        $(this).remove();
                    });
                }
            });
        });

    });

</script>


