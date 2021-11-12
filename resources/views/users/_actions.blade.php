@if(!$user->trashed())
  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"
    title="Editar">
    <i class="fa fa-edit"></i>
  </a>
  @if ($user->isNot(Auth::user()))
    <a href="#" class="btn btn-sm btn-danger confirm-delete" form-target="delete-form-{{ $user->id }}"
      title="Eliminar" onclick="event.preventDefault();" >
        <i class="fa fa-times"></i>
    </a>
    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
      method="POST" style="display: none;">
      @csrf
      @method('DELETE')
    </form>
  @endif
@else
  <a href="#" class="btn btn-sm btn-success" title="Restaurar"
    onclick="event.preventDefault();
    document.getElementById('restore-form-{{ $user->id }}').submit();">
    <i class="fa fa-plus" aria-hidden="true"></i>
  </a>
  <form id="restore-form-{{ $user->id }}" action="{{ route('users.restore', $user->id) }}"
    method="POST" style="display: none;">
    @csrf
  </form>
@endif