@foreach($ajax_barang as $d)
    <div class="form-group">
        <label>Harga</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Rp </span>
            </div>
            <input type="number" value="{{ $d->harga }}" class="form-control" id="harga" name="harga" readonly  required>
        </div>
    </div>
@endforeach