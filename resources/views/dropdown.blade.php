<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dependent Dropdown Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .alert-primary {
            background-color: #007bff;
            color: #fff;
        }
        .form-control {
            border-radius: 0.375rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-primary mb-4 text-center">
                <h4>Laravel AJAX Dependent Country State City Dropdown Example</h4>
            </div>
            <form>
                <div class="form-group mb-3">
                    <label for="country-dropdown">Country</label>
                    <select id="country-dropdown" class="form-control">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="state-dropdown">State</label>
                    <select id="state-dropdown" class="form-control">
                        <option value="">-- Select State --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city-dropdown">City</label>
                    <select id="city-dropdown" class="form-control">
                        <option value="">-- Select City --</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#country-dropdown').on('change', function () {
            var country_id = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ url('fetchstate') }}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown').html('<option value="">-- Select State --</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value.state_id + '">' + value.state_name + '</option>');
                    });
                }
            });
        });

        $('#state-dropdown').on('change', function () {
            var state_id = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url: "{{ url('fetchcity') }}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    $.each(result.cities, function (key, value) {
                        $("#city-dropdown").append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                    });
                }
            });
        });
    });
</script>
</body>
</html>
