@extends('dashboard.partials.main')

@section('css')
<link href="{{ url('select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ url('css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('container')

<div class="row mt-4">
    <div class="col-md-8 table-responsive">
        <table class="table table-striped text-nowrap" style="font-size: 12px" id="tabel-barang-masuk">
            <thead>
            <tr>
                <th>No</th>
                <th>Invno</th>
                <th>Nama Barang</th>
                <th>PLU</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
                <th>Info</th>
                <th>Tanggal Masuk</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="col-md-4">
        <form method="POST" id="proses-barang">
            <p>Barang Keluar</p>
            <div class="input-group flex-nowrap mb-1">
                <select name="plu" id="plu" class="form-control"></select>
            </div>

            <div class="input-group flex-nowrap mb-1">
                <input type="text" name="detail_produk" id="detail_produk" class="form-control" placeholder="PLU Barang" @disabled(true)>
                <span class="input-group-text">Stock</span>
                <input type="number" name="stock" id="stock" class="form-control" @disabled(true) value="0">
                <input type="number" id="stock_hidden" hidden>
            </div>

            <div class="input-group flex-nowrap mb-1">
                <input type="text" name="price" id="price" class="form-control" placeholder="Rp. 0" @disabled(true)>
                <input type="text" id="unit" @disabled(true) class="form-control">
                <input type="number" id="price_number" value="0" hidden>
            </div>

            <div class="input-group flex-nowrap mb-1">
                <input type="number" name="jumlah" id="jumlah" autocomplete="off" class="form-control" value="1">
                <input type="text" name="harga_produk" id="harga_produk" autocomplete="off" class="form-control" value="Rp. 0" @disabled(true)>
            </div>

            <button type="submit" class="btn btn-primary">Proses Barang</button>
            <button type="button" onclick="window.location.reload();" class="btn btn-danger">Cancel</button>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('/js/datatables.min.js') }}"></script>
<script src="{{ url('select2/js/select2.full.min.js') }}"></script>
<script>
$(function(){
    let tabel = $('#tabel-barang-masuk').DataTable({
        ajax: {
            url: `{{ route('barang-keluar.get') }}`,
            type: 'GET',
        },
        processing: true,
        autoWidth: false,
        columns: [
            {data: (data) =>{return data['nomor']}},
            {data: (data) =>{return data['invno']}},
            {data: (data) =>{return data['nama_produk']}},
            {data: (data) =>{return data['plu']}},
            {data: (data) =>{return data['jumlah']}},
            {data: (data) =>{
                const harga = Intl.NumberFormat('id', {style: 'currency', currency: "IDR", maximumFractionDigits: 0}).format(data['harga']);
                return harga;
            }},
            {data: (data) =>{
                const harga = Intl.NumberFormat('id', {style: 'currency', currency: "IDR", maximumFractionDigits: 0}).format(data['total']);
                return harga;
            }},
            {data: (data) =>{return data['info']}},
            {data: (data) =>{return data['created_at']}},
        ],
    });

    getProduk();
})

function getProduk(){
    $('#plu').select2({
            placeholder: 'Pilih Barang ...',
            ajax: {
                url: '{{ route('barang-keluar.search') }}',
                data: function (params) {
                    var query = {
                    search: params.term,
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
    })
}

$('#plu').on('change', function(){
    const plu = parseInt($(this).val());
    $.get(`{{ route('produk.get-detail') }}`, {
        'plu': plu
    })
    .done((response) =>{
        const harga = Intl.NumberFormat('id', {style: 'currency', currency: "IDR"}).format(response.data['price']);

        $('#detail_produk').val(response.data['plu']);
        $('#price_number').val(response.data['price']);
        $('#stock').val(response.data['stock']);
        $('#stock_hidden').val(response.data['stock']);
        $('#unit').val(response.data['unit']);
        $('#harga_produk').val(harga);
        $('#price').val(harga);

        checkStock();
    })
    .fail((response) =>{
        console.log(response);
        alert('Gagal ambil data');
    })
});

$('#jumlah').on('change', function(){
    let jumlah = parseInt($(this).val());

    let plu = $('#plu').val();
    if(plu == null){
        $(this).val(1);
        alert('Belum ada barang yang dipilih');
    }

    if(jumlah < 1){
        $(this).val(1);
        alert('Jumlah tidak boleh kurang dari 0');
    }

    let harga = jumlah * $('#price_number').val();
    harga = Intl.NumberFormat('id', {style: 'currency', currency: "IDR"}).format(harga);
    $('#harga_produk').val(harga);
});

$('#proses-barang').submit(function(e){
    e.preventDefault();

    let plu = $('#plu').val();
    if(plu == null){
        $(this).val(0);
        alert('Belum ada barang yang dipilih');
        return;
    }

    if(!checkStock()){
        return;
    } else {

        if(confirm('Lanjut proses barang keluar?')){
            $.ajax({
                url: `{{ route('barang-keluar.create') }}`,
                data: new FormData(this),
                method: 'POST',
                contentType: false,
                processData: false,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .done((response) =>{
                $('#proses-barang')[0].reset();
                $('#plu').empty().trigger('change');
                $('#tabel-barang-masuk').DataTable().ajax.reload();
            })
        }

    }

})

function checkStock(){
    if(parseInt($('#jumlah').val()) > parseInt($('#stock').val())){
        alert('Jumlah stock tidak mencukupi');
        return false;
    }

    return true;
}

</script>
@endpush
