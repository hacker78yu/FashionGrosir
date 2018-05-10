<?php
$url = site_url('item/simpan');
if ($submit == 'Ubah') {
    $id = $items->i_kode;
    $nama = $items->i_nama;
    $hrg_vip = $items->i_hrg_vip;
    $hrg_reseller = $items->i_hrg_reseller;
    $deskripsi = $items->s_deskripsi;
} else if ($submit == 'Simpan') {
    $id = $kode;
    $nama = '';
    $hrg_vip = '';
    $hrg_reseller = '';
    $deskripsi = '';
}
?>

<form action="<?= $url; ?>" method="post">
    <input type="hidden" name="token_fg" value="<?= $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="form-group">
        <label for="nama">Nama Item</label>
        <input type="text" class="form-control" name="nama" placeholder="Input Nama" value="<?= $nama; ?>" required>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-6">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori[]" id="kategori" class="form-control" multiple required>
                    <?php foreach ($this->kategori->get_all() as $katitem): ?>
                        <option value="<?= $katitem->k_kode; ?>"><?= $katitem->k_nama; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="hrg_vip">Harga VIP</label>
                        <input type="number" class="form-control" name="hrg_vip" placeholder="Input Hrg VIP"
                               value="<?= $hrg_vip; ?>" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="hrg_reseller">Harga Reseller</label>
                        <input type="number" class="form-control" name="hrg_reseller" placeholder="Input Hrg Reseller"
                               value="<?= $hrg_reseller; ?>" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi"><?= $deskripsi; ?></textarea>
    </div>
    <div class="form-group">
        <table class="table table-sm" id="tabel">
            <thead>
            <tr>
                <th scope="col">Warna</th>
                <th scope="col">Ukuran</th>
                <th scope="col">No. Seri</th>
                <th scope="col">QTY</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <select name="warna[]" id="warna" class="form-control small" required>
                        <option value="" disabled>Pilih Warna</option>
                        <?php foreach ($this->warna->get_all() as $katwarna): ?>
                            <option value="<?= $katwarna->w_kode; ?>"><?= $katwarna->w_nama; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select name="ukuran[]" id="ukuran" class="form-control small" required>
                        <option value="" disabled>Pilih Ukuran</option>
                        <?php foreach ($this->ukuran->get_all() as $katukuran): ?>
                            <option value="<?= $katukuran->u_kode; ?>"><?= $katukuran->u_nama; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select name="seri[]" id="seri" class="form-control small">
                        <option value="0">None</option>
                        <?php foreach ($this->seri->get_all() as $katseri): ?>
                            <option value="<?= $katseri->s_kode; ?>"><?= $katseri->s_nama; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input name="qty[]" type="number" class="form-control" value="0"></td>
                <td>
                    <a href="#" class="mt-1" onclick="hapus_detil($(this))"><i class="fa fa-window-close fa-2x"></i></a>
                </td>
            </tr>
            <tfoot>
            <tr>
                <th colspan="4">
                    <a href="#" class="mt-1" id="baru_detil">Tambah Detil</a>
                </th>
            </tr>
            </tfoot>
            </tbody>
        </table>
    </div>

    <div class="form-group">
        <input type="hidden" id="counter" name="counter" value="1">
        <button type="submit" class="btn btn-primary btn-block"><?= $submit; ?></button>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('select#kategori').multiSelect();
    });

    var $table = $('#tabel').find("tbody");

    $('#baru_detil').click(function () {
        var $trLast = $table.find("tr:last"),
            $trNew = $trLast.clone();

        $trLast.after($trNew);

        var counter = parseInt($('#counter').val());
        $('#counter').val(counter + 1);

    });

    function hapus_detil($data) {
        if ($('#tabel > tbody > tr').length > 1) {
            $('#tabel > tbody > tr:last')
                .prev()
                .find('input, select')
                .attr('disabled', false);
            $data.closest('tr').remove();
        }
    }
</script>

