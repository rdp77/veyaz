<div class="card mb-3">
    <div class="card-body">
        <div class="form-group">
            <label>
                {{ __('Cari Berdasarkan Apapun :') }}
            </label>
            <input type="text" name="name" class="form-control col-sm-4 filter_name" placeholder="Cari Disini">
        </div>
        {{-- <div class="form-group">
            <label>{{ __('Filter Berdasarkan :') }}</label>
        <select data-column="{{ Request::route()->getName() == 'reports-employee.index' ? '4' : '3' }}"
            class="form-control selectric filter_status" placeholder="Filter Berdasarkan Status">
            <option value="">{{ __('Pilih Status') }}</option>
            <option value="Pending">{{ __('Pending') }}</option>
            <option value="Diterima">{{ __('Diterima') }}</option>
            <option value="Ditolak">{{ __('Ditolak') }}</option>
        </select>
    </div>
    <div class="form-group">
        <label>{{ __('Filter Berdasarkan Karyawan :') }}</label>
        <select data-column="1" class="form-control select2 filter_employee"
            placeholder="Filter Berdasarkan Nama Karyawan">
            <option value="">{{ __('Pilih Karyawan') }}</option>
            @foreach ($employee as $e)
            <option value="{{ $e->name }}">{{ $e->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>{{ __('Filter Berdasarkan Periode :') }}</label>
        <select name="filter_period" class="form-control selectric" id="filter_period">
            <option value="">{{ __('Pilih Periode') }}</option>
            <option value="7">{{ __('7 Hari Terakhir') }}</option>
            <option value="14">{{ __('14 Hari Terakhir') }}</option>
            <option value="21">{{ __('21 Hari Terakhir') }}</option>
            <option value="31">{{ __('31 Hari Terakhir') }}</option>
            <option value="365">{{ __('365 Hari Terakhir') }}</option>
        </select>
    </div> --}}
</div>
</div>