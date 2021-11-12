@if(!$company->trashed())
  <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-primary"
    title="Editar">
    <i class="fa fa-edit"></i>
  </a>
  <a href="#" class="btn btn-sm btn-danger confirm-delete" form-target="delete-form-{{ $company->id }}"
    title="Eliminar" onclick="event.preventDefault();" >
    <i class="fa fa-times"></i>
  </a>
  <form id="delete-form-{{ $company->id }}" action="{{ route('companies.destroy', $company->id) }}"
    method="POST" style="display: none;">
    @csrf
    @method('DELETE')
  </form>
@else
  <a href="#" class="btn btn-sm btn-success" title="Restaurar"
    onclick="event.preventDefault();
    document.getElementById('restore-form-{{ $company->id }}').submit();">
    <i class="fa fa-plus" aria-hidden="true"></i>
  </a>
  <form id="restore-form-{{ $company->id }}" action="{{ route('companies.restore', $company->id) }}"
    method="POST" style="display: none;">
    @csrf
  </form>
@endif
