{{-- Shows flash success message--}}
@if (Session::has('successMessage'))
  <div class="alert alert-success" role="alert">
    <strong>Mensaje:</strong> {{ Session::get('successMessage') }}
  </div>
@endif

{{-- Shows flash no privileges message--}}
@if (Session::has('noprivileges'))
  <div class="alert alert-danger" role="alert">
    <strong>Mensaje:</strong> {{ Session::get('noprivileges') }}
  </div>
@endif

{{-- Shows flash error message--}}
@if (Session::has('errorMessage'))
  <div class="alert alert-danger" role="alert">
    <strong>Mensaje:</strong> {{ Session::get('errorMessage') }}
  </div>
@endif

{{-- Shows errors messages --}}
@if (count($errors) > 0)
  <div class="alert alert-danger" role="alert">
    <strong>Errores:</strong>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
