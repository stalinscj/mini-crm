@if(!$collaborator->trashed())
  <a href="{{ route('collaborators.edit', $collaborator->id) }}" class="btn btn-sm btn-primary"
    title="Editar">
    <i class="fa fa-edit"></i>
  </a>
  <a href="#" class="btn btn-sm btn-danger confirm-delete" form-target="delete-form-{{ $collaborator->id }}"
    title="Eliminar" onclick="event.preventDefault();" >
    <i class="fa fa-times"></i>
  </a>
  <form id="delete-form-{{ $collaborator->id }}" action="{{ route('collaborators.destroy', $collaborator->id) }}"
    method="POST" style="display: none;">
    @csrf
    @method('DELETE')
  </form>
@else
  <a href="#" class="btn btn-sm btn-success" title="Restaurar"
    onclick="event.preventDefault();
    document.getElementById('restore-form-{{ $collaborator->id }}').submit();">
    <i class="fa fa-plus" aria-hidden="true"></i>
  </a>
  <form id="restore-form-{{ $collaborator->id }}" action="{{ route('collaborators.restore', $collaborator->id) }}"
    method="POST" style="display: none;">
    @csrf
  </form>
@endif
