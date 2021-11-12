<form action="{{ route("users.$action", $user->id) }}" method="POST">
  @csrf
  @method($method)
  <div class="row">
    <div class="col-xl-6">
      <div class="card">

        <div class="card-body">

          <div class="form-group">
            <label for="name">Nombre*</label>

            <input type="text" name="name" class="form-control" id="name" required
              placeholder="Nombre del Usuario" maxlength="60" autofocus
              value="{{ old('name', $user->name) }}">

            @error('name')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="email">Email*</label>

            <input type="email" name="email" class="form-control" id="email" required
              placeholder="Email del Usuario" maxlength="100"
              value="{{ old('email', $user->email) }}">

            @error('email')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          @if ($action=='update')
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="update_password" class="custom-control-input" id="update_password" 
                  value="true"
                  {{ old('update_password') ? 'checked' : '' }}>

                <label for="update_password" class="custom-control-label">Actualizar Password</label>
              </div>
            </div>
          @endif

          <div class="form-group" {{ $action=='update' && !old('update_password') ? 'hidden' : '' }}>
            <label for="password">Password*</label>

            <input type="password" name="password" class="form-control" id="password" 
              {{ $action=='update' && !old('update_password') ? 'disabled' : 'required' }}
              placeholder="Password del Usuario">

            @error('password')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group" {{ $action=='update' && !old('update_password') ? 'hidden disabled' : '' }}>
            <label for="password_confirmation">Confirme Password*</label>

            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
              {{ $action=='update' && !old('update_password') ? 'disabled' : 'required' }}
              placeholder="Confirme Password del Usuario">
          </div>

          <div class="form-group float-right">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Regresar</a>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
          </div>

        </div>

        <div class="card-footer">
          * Campo obligatorio
        </div>

      </div>
    </div>
  </div>
</form>

@push('js')
  <script>
    $(document).ready(function() {
      $('#update_password').change(function() {
        if (this.checked) {
          $('input[type="password"]')
            .attr('required', true)
            .removeAttr('disabled')
            .parent()
            .removeAttr('hidden')
        } else {
         $('input[type="password"]')
          .removeAttr('required')
          .attr('disabled', true)
          .parent()
          .attr('hidden', true)
        }
      });
    });
  </script>
@endpush
