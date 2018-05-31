<?php
include "layout/Header.php";
include "layout/Brand.php";
include "layout/Menu.php";
?>
    <!-- Content -->
    <div class="container">
        <br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb f-hover">
                <li class="breadcrumb-item">
                    <a href="<?= site_url('/'); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= site_url('cart'); ?>">Keranjang</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= site_url('checkout/alamat_pengiriman'); ?>">Alamat Pengiriman</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= site_url('checkout/kirim_bayar'); ?>">Metode Pengiriman & Pembayaran</a>
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-3">
                <div class="card f-padding-card">
                    <div class="row f-margin-bangsat">
                        <div class="col-1">
                            <span class="badge badge-pill badge-dark f-color-pink">1</span>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-shopping-cart f-troli-text"></i>
                        </div>
                        <div class="col-6 f-font-ricky">
                            Troli Belanja
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-3">
                <div class="card f-padding-card">
                    <div class="row f-margin-bangsat">
                        <div class="col-1">
                            <span class="badge badge-pill badge-dark f-color-pink">2</span>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-truck f-troli-text"></i>
                        </div>
                        <div class="col-6 f-font-ricky">
                            Alamat Pengiriman
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-3">
                <div class="card f-padding-card r-active-step">
                    <div class="row f-margin-bangsat ">
                        <div class="col-1">
                            <span class="badge badge-pill badge-dark f-color-pink">3</span>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-handshake-o f-troli-text"></i>
                        </div>
                        <div class="col-6 f-font-ricky" style="font-size: 13px">
                            Metode Pengiriman & Pembayaran
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-3">
                <div class="card f-padding-card">
                    <div class="row f-margin-bangsat">
                        <div class="col-1">
                            <span class="badge badge-pill badge-dark f-color-pink">4</span>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-money f-troli-text"></i>
                        </div>
                        <div class="col-6 f-font-ricky">
                            Konfirmasi Pembayaran
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <h5 class="mb-3"><i class="fa fa-handshake"></i> Metode Pengiriman & Pembayaran</h5>
        <!-- Konten -->
        <div class="row">
            <!-- KOTAK KIRI -->
            <div class="col-lg-12 col-md-12">
                <h6>Pilih Metode Pengiriman</h6>
                <?php foreach ($pengiriman as $k1): ?>
                    <?php $nama = $k1->name; ?>
                    <?php foreach ($k1->costs as $k2): ?>
                        <?php $deskripsi = $k2->description; ?>
                        <?php foreach ($k2->cost as $k3): ?>
                            <?php $biaya = $k3->value; ?>
                            <?php $estimasi = $k3->etd; ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pengiriman" id="pengiriman"
                                       value="1">
                                <label class="form-check-label" for="pengiriman">
                                    <?= $nama . ' - ' . $deskripsi . ' (' . $estimasi . ' hari) ('; ?> <span
                                            id="rupiah"><?= $biaya; ?></span>)
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <br>
                <form action="ongkir_transfer/simpan" method="post">

                    <h6>BANK TRNASFER</h6>
                    <div class="alert alert-danger" role="alert">
                        BCA a/n FashionGrosir - 41751082
                    </div>
                    <button type="submit" class="btn f-button-color">Lanjutkan</button>
                </form>
            </div>
        </div>


        <!-- END KOTAK KIRI -->
    </div>
    <!-- END KONTEN -->

<?php
include "layout/Footer.php";
?>