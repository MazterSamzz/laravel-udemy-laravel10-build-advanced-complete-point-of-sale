<form action="{{ $action }}" method="post">
    @csrf
    @method('delete')
    <button id="delete" class="btn btn-danger sm" title="Delete Data" type="submit" disabled><i class="fas fa-trash-alt"></i></button>
</form>