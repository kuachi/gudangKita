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
            <p>Konversi PLU</p>
            <div class="input-group flex-nowrap mb-1">
                <select name="plu_akhir" id="plu_akhir" class="form-control"></select>
            </div>

            <div class="input-group flex-nowrap mb-1">
                <select name="plu" id="plu" class="form-control"></select>
            </div>

            <div class="input-group flex-nowrap mb-2">
                <span class="input-group-text">Stock Konversi</span>
                <input type="number" name="stock_awal" id="stock_awal" class="form-control" value="0" @disabled(true)>
                <input type="number" name="stock_konversi" id="stock_konversi" class="form-control" value="0">
            </div>

            <div class="input-group flex-nowrap mb-2">
                <span class="input-group-text">Stock Hasil</span>
                <input type="number" name="stock_hasil" id="stock_hasil" class="form-control" value="0" @disabled(true)>
                <input type="number" name="stock_hasil_konversi" id="stock_hasil_konversi" class="form-control" value="0" @disabled(true)>
            </div>

            <button type="submit" class="btn btn-warning">Proses Konversi</button>
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
            url: `{{ route('barang-masuk.get') }}?jenis=konv`,
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

    getPluKonversi();
    getPluAsal();
})

function getPluKonversi(){
    $('#plu').select2({
            placeholder: 'Pilih PLU awal...',
            ajax: {
                url: '{{ route('produk-konversi-asal.get') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                        plu_akhir: $('#plu_akhir').val(),
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


function getPluAsal(){
    $('#plu_akhir').select2({
            placeholder: 'Pilih PLU akhir...',
            ajax: {
                url: '{{ route('produk-konversi.get') }}',
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
    let plu_asal = $(this).val();
    let plu_akhir =$('#plu_akhir').val();

    $.get('{{ route('produk-konversi.data') }}', {
        plu_asal, plu_akhir
    })
    .done((response) =>{
        $('#stock_hasil').val(response.data['qty_hasil']);
    })

    $.get('{{ route('produk.get-detail') }}', {
        "plu": plu_asal
    })
    .done((response) =>{
        $('#stock_awal').val(response.data['stock']);
    })
});

$('#jumlah').on('change', function(){
    let jumlah = $(this).val();

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

    if(!checkStock()){
        return;
    } else {
        if($('#plu').val() == null){
            alert('Belum ada PLU asal yang dipilih');
            return;
        }

        if($('#plu_akhir').val() == null){
            alert('Belum ada PLU akhir yang dipilih');
            return;
        }

        if($('#stock_konversi').val() < 1){
            alert('Stock yang dikonversi tidak boleh kurang dari 1');
            return;
        }

        if(confirm('Lanjut proses konversi PLU?')){
            $.ajax({
                url: `{{ route('produk-konversi.create') }}`,
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
                $('#plu_akhir').empty().trigger('change');
                $('#tabel-barang-masuk').DataTable().ajax.reload();
            })
        }

    }

})

function checkStock(){
    if($('#jumlah').val() > $('#stock').val()){
        alert('Jumlah stock tidak mencukupi');
        return false;
    }

    return true;
}

$('#stock_konversi').on('change', function(){
    if( $(this).val() > $('#stock_awal').val() ){
        alert('Stock awal tidak cukup!');
        $(this).val( $('#stock_awal').val() );
    }

    let hasil_konversi = $(this).val() * $('#stock_hasil').val();
    $('#stock_hasil_konversi').val(hasil_konversi);
})

</script>
@endpush
