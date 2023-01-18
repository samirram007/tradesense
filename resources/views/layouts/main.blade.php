<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- title logo --}}
    <link rel="icon" href="{{asset('images/logo_gold.png')}}" type="image/x-icon">
    <title>{{env('APP_NAME')}}</title>

    <style>
        body {
            height: 100vh;
        }
    </style>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{--
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">

    <link rel="stylesheet" href="{{asset('css/page_content.css')}}"> --}}
    {{--
    <link rel="stylesheet" href="{{asset('css/footer.css')}}"> --}}

</head>

<body class="home_body">
    @include('layouts.modal')
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", ".load-popup", function() {
              //e.preventDefault();
                var param = $(this).data('param');
                var url = $(this).data('url');
                var size = $(this).data('size');
                 console.log(url);
                //  $(".page-loader").show();
                $.ajax({
                    url: url,
                    type: "get",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: {
                        'param': param,
                        'size': size
                    },
                    success: function(data) {
                        // console.log(data);
                        //console.log(ko.toJSON(response));
                        if (!data.error) {
                            $("#rems-popup").html(data['html']);
                            $("#rems-popup").modal('show');
                        } else {
                            console.log(data);
                        }

                        //  $(".page-loader").hide();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                    }

                });

            });
            $(document).on("click", ".render-popup", function() {
                // e.preventDefault();
                $("#rems-popup").html('');

                var param = $(this).data('param');
                var url = $(this).data('url');
                //  console.log(param);
                //  $(".page-loader").show();
                $.ajax({
                    url: url,
                    type: "get",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: {
                        'param': param
                    },
                    success: function(data) {
                        console.log(data);
                        //console.log(ko.toJSON(response));
                        if (!data.error) {
                            $("#rems-popup").html(data['html']);
                            $("#rems-popup").modal('show');
                        } else {
                            console.log(data);
                        }

                        //  $(".page-loader").hide();
                    },
                    error: function(xhr, status, error) {
                        //console.log(xhr);
                        //$(".page-loader").hide();
                        //console.log(arguments);
                        /*  var msg =
                              '<div id="inner-message" class="alert alert-error shadow"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
                              error + '</div>';
                          $("#message").html(msg);*/
                    }

                })

            });
        });
    </script>
</body>

</html>
