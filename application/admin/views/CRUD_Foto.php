<form action="<?= site_url('upload/do_upload'); ?>" enctype="multipart/form-data" method="post">
    <input type="hidden" name="token_fg" value="<?= $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="i_kode" value="<?= $i_kode ?>">
    <div class="form-group">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="images[]" class="custom-file-input" multiple required>
                <label class="custom-file-label" for="inputGroupFile04">Pilih file</label>
            </div>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-sm btn-primary">Unggah</button>
    </div>

</form>