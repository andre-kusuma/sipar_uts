<?php
//notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

//form open
echo form_open(base_url('admin/kategori/edit/' .$kategori->id_kategori),' class="form-horizontal"');
?>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Kategori</label>
    <div class="col-md-10">
        <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" value="<?php 
        echo $kategori->nama_kategori ?>" required>
    </div>
</div>



<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
    <div class="col-md-10">
        <button class="btn btn-success btn-lg" name="submit" type="submit">
            <i class="fa fa-save"></i> Simpan
        </button>
        <button class="btn btn-info btn-lg" name="reset" type="reset">
            <i class="fa fa-times"></i> Reset
        </button>
    </div>
</div>


<?php echo form_close(); ?>