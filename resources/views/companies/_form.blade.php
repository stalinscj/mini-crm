<form action="{{ route("companies.$action", $company->id) }}" method="POST">
  @csrf
  @method($method)
  <div class="row">
    <div class="col-xl-6">
      <div class="card">

        <div class="card-body">

          <div class="form-group">
            <label for="name">Nombre*</label>

            <input type="text" name="name" class="form-control" id="name" required
              placeholder="Nombre de la Empresa" maxlength="60" autofocus
              value="{{ old('name', $company->name) }}">

            @error('name')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="email">Email*</label>

            <input type="email" name="email" class="form-control" id="email" required
              placeholder="Email de la Empresa" maxlength="100"
              value="{{ old('email', $company->email) }}">

            @error('email')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="website">Sitio Web*</label>

            <input type="url" name="website" class="form-control" id="website" required
              placeholder="Sitio web de la Empresa" maxlength="100"
              value="{{ old('website', $company->website) }}">

            @error('website')
              <span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group float-right">
            <a href="{{ route('companies.index') }}" class="btn btn-sm btn-secondary">Regresar</a>
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
