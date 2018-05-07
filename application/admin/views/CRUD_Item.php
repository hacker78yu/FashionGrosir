
<?php
$url = site_url('item/simpan');
if ($submit == 'Ubah')
{
    $id = $items->i_kode;
    $nama = $items->i_nama;
    $hrg_vip = $items->i_hrg_vip;
    $hrg_reseller = $items->i_hrg_reseller;
    $deskripsi = $items->s_deskripsi;
} else if ($submit == 'Simpan')
{
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
        <p>
            <?= form_error('nama'); ?>
        </p>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="hrg_vip">Harga VIP</label>
                <input type="text" class="form-control" name="hrg_vip" placeholder="Input Hrg VIP" value="<?= $hrg_vip; ?>" required>
                <p>
                    <?= form_error('hrg_vip'); ?>
                </p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="hrg_reseller">Harga Reseller</label>
                <input type="text" class="form-control" name="hrg_reseller" placeholder="Input Hrg Reseller" value="<?= $hrg_reseller; ?>" required>
                <p>
                    <?= form_error('hrg_reseller'); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($this->kategori->get_all() as $katitem): ?>
                        <option value="<?= $katitem->k_kode; ?>"><?= $katitem->k_nama; ?></option>
                    <?php endforeach; ?>
                </select>
                <p>
                    <?= form_error('kategori'); ?>
                </p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="seri">Seri</label>
                <select name="seri" id="seri" class="form-control" required>
                    <option value="">Pilih Seri</option>
                    <?php foreach ($this->seri->get_all() as $katseri): ?>
                        <option value="<?= $katseri->s_kode; ?>"><?= $katseri->s_nama; ?></option>
                    <?php endforeach; ?>
                </select>
                <p>
                    <?= form_error('seri'); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="warna">Warna</label>
                <select name="warna" id="warna" class="form-control" required>
                    <option value="">Pilih Warna</option>
                    <?php foreach ($this->warna->get_all() as $katwarna): ?>
                        <option value="<?= $katwarna->w_kode; ?>"><?= $katwarna->w_nama; ?></option>
                    <?php endforeach; ?>
                </select>
                <p>
                    <?= form_error('warna'); ?>
                </p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="ukuran">Ukuran</label>
                <select name="ukuran" id="ukuran" class="form-control" required>
                    <option value="">Pilih Ukuran</option>
                    <?php foreach ($this->ukuran->get_all() as $katukuran): ?>
                        <option value="<?= $katukuran->u_kode; ?>"><?= $katukuran->u_nama; ?></option>
                    <?php endforeach; ?>
                </select>
                <p>
                    <?= form_error('ukuran'); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi">
            <?= $deskripsi; ?>
        </textarea>
        <p>
            <?= form_error('deskripsi'); ?>
        </p>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?= $submit; ?></button>
    </div>
    <?php if (isset($berhasil)): ?>
        <p class="text-success"><?= $berhasil;?></p>
    <?php endif; ?>
    <?php if (isset($gagal)): ?>
        <p class="text-danger"><?= $gagal;?></p>
    <?php endif; ?>
</form>
