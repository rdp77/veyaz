<form class="modal-part" id="modal-body">
    @csrf
    @if (Request::route()->getName() == 'activity.type.index')
    <div class="form-group">
        <label>{{ __('Nama Tipe') }}</label>
        <input type="text" name="name_type" class="form-control">
    </div>
    @else
    <div class="form-group">
        <label>{{ __('Nama Aktivitas') }}</label>
        <input type="text" name="name_activity" class="form-control">
    </div>
    <div class="form-group">
        <label>{{ __('Tipe Aktivitas') }}</label>
        <select class="form-control select2" name="type">
            @foreach ($type as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    @endif
</form>