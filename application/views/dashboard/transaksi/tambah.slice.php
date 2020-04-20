@extends('layouts.base.app')
@section('title', ' Tambah Transaksi')

@section('sidebar')
    @include('layouts.base.sidebar')
@endsection

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
<div class="col-12 mb-2 mt-2">
    @if($this->session->flashdata('message')) 
        @if($this->session->flashdata('message')['type'] == 'error')
        <div class="alert alert-danger">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @else
        <div class="alert alert-success">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @endif
    @endif
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ base_url('/') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ base_url('TransaksiController/index') }}">Data Transaksi</a>
    <span class="breadcrumb-item active">Tambah Transaksi</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Tambah Transaksi</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-bootstrap px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('TransaksiController/saveTransaksi') }}" aria-label="" id="submit_form">
            <div class="row">
                <div class="col-4">
                    <span>Total Transaksi</span><input type="text" class="form-control" id="fix_total" name="fix_total" required readonly value="0">
                </div>
            </div><br><br>
            <div id="dynamic_field">
                <div class="form-group row">
                    <div class="col-4">Barang</div>
                    <div class="col-1">Jumlah</div>
                    <div class="col-3">Harga Satuan</div>
                    <div class="col-3">Harga Total</div>
                </div>
                <div class="form-group row" id="row0">
                    <div class="col-4">
                        <div class="form-material form-material-primary floating open">
                            <select class="form-control pilih_barang" id="barang0" name="barang[]" required>
                                <option value="">Pilih barang</option>
                                <?php foreach ($barang as $t) { ?>
                                    <option value="<?php echo $t->id ?>"><?php echo $t->nama; ?>-<?php echo $t->harga_jual; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-material form-material-primary floating input-group">
                            <input type="text" class="form-control jumlah_barang" id="jumlah0" name="jumlah[]" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-material form-material-primary floating input-group">
                            <input type="text" class="form-control" id="harga_satuan0" name="harga_satuan[]" required readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-material form-material-primary floating input-group">
                            <input type="text" class="form-control" id="harga_total0" name="harga_total[]" required readonly>
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-material form-material-primary floating input-group">
                            <button type="button" name="remove" id="0" class="btn btn_remove btn-warning" style=""><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <button type="button" name="add" id="add" class="btn btn-success font-putih">Tambah Barang</button>
            </div>
            <hr/>
            <div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('BarangController/index') }}">Cancel</a>&nbsp
                    <button type="submit" onclick="cek_harga()" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
<script>
    var i=0; 
    var harga_satuan = [] 
    var jumlah = []
    $('#add').click(function(){  
        i++;
        $('#dynamic_field').append('<div class="form-group row" id="row'+i+'"><div class="col-4"><div class="form-material form-material-primary floating open"><select class="form-control pilih_barang" id="barang'+i+'" name="barang[]" required><option value="">Pilih barang</option><?php foreach ($barang as $t) { ?><option value="<?php echo $t->id ?>"><?php echo $t->nama; ?>-<?php echo $t->harga_jual; ?></option><?php } ?></select></div></div><div class="col-1"><div class="form-material form-material-primary floating input-group"><input type="text" class="form-control jumlah_barang" id="jumlah'+i+'" name="jumlah[]" required><label for="username'+i+'"></label><div class="input-group-append"></div></div></div><div class="col-3"><div class="form-material form-material-primary floating input-group"><input type="text" class="form-control" id="harga_satuan'+i+'" name="harga_satuan[]" required readonly><label for="username'+i+'"></label><div class="input-group-append"></div></div></div><div class="col-3"><div class="form-material form-material-primary floating input-group"><input type="text" class="form-control" id="harga_total'+i+'" name="harga_total[]" required readonly><div class="input-group-append"></div></div></div><div class="col-1"><div class="form-material form-material-primary floating input-group"><button type="button" name="remove" id="'+i+'" class="btn btn_remove btn-warning" style=""><i class="fa fa-times" aria-hidden="true"></i></button></div></div></div>');
    });  
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id"); 
        kurang = harga_satuan[button_id]*jumlah[button_id]
        total = $('#fix_total').val()
        $('#fix_total').val(parseInt(total) - parseInt(kurang))
        $('#row'+button_id+'').remove();  
    });
    $(document).on('change','.pilih_barang', function(){
        var elt = document.getElementById($(this).attr("id"));
        id_num = $(this).attr("id").split('g')[1]
        text =  elt.options[elt.selectedIndex].text;
        harga_satuan[id_num] = text.split('-')[1]
        $('#harga_satuan'+id_num).val(harga_satuan[id_num]);
        // document.getElementById($(this).attr("id")).disabled = true;
        if (jumlah[id_num]) {
            $('#harga_total'+id_num).val(harga_satuan[id_num]*jumlah[id_num]);
            total = $('#fix_total').val()
            $('#fix_total').val(parseInt(total) + parseInt(harga_satuan[id_num]*jumlah[id_num]))
        }
    });
    $(document).on('change','.jumlah_barang', function(){
        var elt = document.getElementById($(this).attr("id"));
        id_num = $(this).attr("id").split('h')[1]
        jumlah[id_num] =  $(this).val();
        document.getElementById($(this).attr("id")).readOnly = true;
        if (harga_satuan[id_num]) {
            $('#harga_total'+id_num).val(harga_satuan[id_num]*jumlah[id_num]);   
            total = $('#fix_total').val()
            $('#fix_total').val(parseInt(total) + parseInt(harga_satuan[id_num]*jumlah[id_num]))
        }
    });
    function cek_harga() {
        harga_total = 0
        console.log(harga_satuan.length, harga_satuan)
        for (var i = 0; i < harga_satuan.length; i++) {
            harga_total += (harga_satuan[i]*jumlah[i])
            $('#fix_total').val(harga_total);
            console.log(harga_total)
        }
        $('#submit_form').submit(function(){
            alert('Total Belanja: '+harga_total);
            return true;
        });
    }
</script>

@endsection