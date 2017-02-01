<head>
  <!-- Setting charset -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Setting width and scale -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Title -->
  <title>@yield('title')</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Own css -->
  <link rel="stylesheet" href="{{ asset('css/basic.css') }}">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/site-resources/favicon.png') }}">
  @yield('css')
</head>
