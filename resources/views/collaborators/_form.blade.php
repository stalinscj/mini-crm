<form action="{{ route("collaborators.$action", $collaborator->id) }}" method="POST">
  @csrf
  @method($method)
  <div class="row">
    <div class="col-xl-6">
      <div class="card">

        <div class="card-body">

          <div class="form-group">
            <label for="company_id">Empresa*</label>
            <select class="form-control select2" name="company_id" id="company_id" required data-placeholder="Seleccione la Empresa">
              <option></option>
              @foreach ($companies as $company)
                <option {{ old('company_id', $collaborator->company_id)==$company->id ? 'selected':'' }}
                  value={{ $company->id }}
                >{{ $company->name }}</option>
              @endforeach
            </select>

            @error('company_id')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="name">Nombre*</label>

            <input type="text" name="name" class="form-control" id="name" required
              placeholder="Nombre del Colaborador" maxlength="60" autofocus
              value="{{ old('name', $collaborator->name) }}">

            @error('name')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="last_name">Apellido*</label>

            <input type="text" name="last_name" class="form-control" id="last_name" required
              placeholder="Apellido del Colaborador" maxlength="60"
              value="{{ old('last_name', $collaborator->last_name) }}">

            @error('last_name')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="email">Email*</label>

            <input type="email" name="email" class="form-control" id="email" required
              placeholder="Email del Colaborador" maxlength="100"
              value="{{ old('email', $collaborator->email) }}">

            @error('email')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="phone">Teléfono*</label>

            <input type="text" name="phone" class="form-control" id="phone" required
              placeholder="Teléfono del Colaborador (#########)" pattern="[0-9]{9}"
              value="{{ old('phone', $collaborator->phone) }}">

            @error('phone')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group float-right">
            <a href="{{ route('collaborators.index') }}" class="btn btn-sm btn-secondary">Regresar</a>
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

@push('plugins-css')
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>  

<script>
  $(document).ready(function() {

    $('.select2').select2()

  })
</script>
@endpush
