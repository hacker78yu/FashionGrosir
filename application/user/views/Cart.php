<?php
include "layout/Header.php";
include "layout/Brand.php";
include "layout/Menu.php";
?>
    <!-- Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb f-no-background">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Troli Belanja</li>
            </ol>
        </nav>
        <hr class="f-hr">

        <div class="row container f-ukuran-center mb-4 f-ricky-bangsat">
            <div class="col-12 col-sm-12 col-md-3">
                <div class="card f-padding-card r-active-step">
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
                <div class="card f-padding-card">
                    <div class="row f-margin-bangsat">
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

    <div class="container">
        <h5 class="mb-3">Troli Belanja Saya</h5>

        <div class="row container">

            <div class="col-lg-12 col-md-12 container">
                <div class="card mb-3 r-layout-troli">

                    <div class="row f-text-hidden">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-lg-7 col-md-7">
                                    <h6><?= $this->cart->where_p_kode($_SESSION['id'])->count_rows(); ?> Produk</h6>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <h6>QTY</h6>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <h6>Total</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php if (isset($carts) && $carts != NULL): ?>
                        <?php foreach ($carts as $cart): ?>
                            <?php if ($cart->p_kode == $_SESSION['id']): ?>
                                <div class="border f-border-padding">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7">
                                            <div class="media">
                                                <img class="mr-3" src="assets/img/kaos.jpg"
                                                     alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0"><?= $item($cart->ide_kode)->i_nama; ?></h5>
                                                    <?= $item($cart->ide_kode)->i_deskripsi; ?>
                                                    <p><i class="fa fa-check fa-lg f-icon-margin"></i>Stok Tersedia</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-2">
                                            <h5 class="card-title f-font-harga f-margin-media"><?= $cart->ca_qty; ?></h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5 id="rupiah" class="card-title f-font-harga f-margin-media"><?= $cart->ca_tharga; ?></h5>
                                        </div>
                                        <div class="col-md-1 f-delete-troli">
                                            <!-- Optional | Check -->
                                            <a href=""><i class="fa fa-times-circle fa-lg f-delete-troli"></i></a>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 f-font-troli border f-border-padding f-radius ml-3">
                <h5>Perhitungan Harga</h5>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-6">
                        <h6>Subtotal</h6>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-6">
                        <div class="row">
                            <div class="col-lg-1 col-md-5 col-sm-5 col-4">
                                <h5>IDR</h5>
                            </div>
                            <div class="col-lg col-md-6 col-sm-7 col">
                                <h5 class="card-title f-sub-total">1.000.000</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-6">
                        <h6>Biaya Pengiriman</h6>
                    </div>
                    <div class="col-lg-6 col-md col-sm-5 col-6">
                        <div class="row">
                            <div class="col-lg-1 col-md-5 col-sm-5 col-4">
                                <h5>IDR</h5>
                            </div>
                            <div class="col-lg col-md-6 col-sm-7 col">
                                <h5 class="card-title f-sub-total">125.000</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-6">
                        <h6>Biaya Lain-lain</h6>
                    </div>
                    <div class="col-lg-6 col-md col-sm-5 col-6">
                        <div class="row">
                            <div class="col-lg-1 col-md-5 col-sm-5 col-4">
                                <h5>IDR</h5>
                            </div>
                            <div class="col-lg col-md-6 col-sm-7 col">
                                <h5 class="card-title f-sub-total">-</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-6">
                        <p><b>Total</b><br><i>*tidak termasuk PPN</i></p>
                    </div>
                    <div class="col-lg-6 col-md col-sm-5 col-6">
                        <div class="row">
                            <div class="col-lg-1 col-md-5 col-sm-5 col-4">
                                <h5>IDR</h5>
                            </div>
                            <div class="col-lg col-md-6 col-sm-7 col">
                                <h5 class="card-title f-sub-total">1.125.000</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="<?= site_url('cart/checkout'); ?>" class="btn btn-primary btn-lg btn-block f-button-font">Check Out</a>

            </div>
        </div>
    </div>
    <!-- End Content -->

<?php
include "layout/Footer.php";
?>