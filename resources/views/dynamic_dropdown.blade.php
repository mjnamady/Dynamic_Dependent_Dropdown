<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jquery Ajax Dynamic Dependent Dropdown In Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </head>
    <style>
        h1 {
            text-align:center;
        }
        .form {
            width: 500px;
            margin: 30px auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }

        .form select{
            margin-top: 20px;
        }
    </style>
  <body>
    <h1>Dynamic Dropdown (Jquery & Ajax)</h1>

    <div class="container">

        <div class="form">

            <select class="form-select dynamic" name="country" id="country" data-dependent="state">
                <option selected>--Select Country--</option>
                @foreach ($countries as $country)
                    <option value="{{$country->country}}">{{$country->country}}</option>
                @endforeach
            </select>

            <select class="form-select dynamic" name="state" id="state" data-dependent="city">
                <option selected>----</option>
            </select>

            <select class="form-select" name="city" id="city">
                <option selected>----</option>
            </select>
        </div>
        {{ csrf_field() }}
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <script>
    
    $(document).ready(function (){
        

        $('.dynamic').on('change', function(){
            if ($(this).val() != '') {
                var select = $(this).attr('id');
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url: "{{route('dependentdropdown.fetch')}}",
                    method: "POST",
                    data: {select:select, value:value, _token:_token, dependent:dependent},
                    success: function (result) {
                        $('#'+dependent).html(result)
                    }
                });
            }
        });


    });
    
    </script>

  </body>
</html>