<?php
include "layout/Header.php";
include "layout/Brand.php";
include "layout/Menu.php";
?>
<?php $nomor_order = $this->uri->segment(2); ?>
    <!-- Content -->
    <div class="container">
        <br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb f-hover">
                <li class="breadcrumb-item">
                    <a href="<?= site_url('/'); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= site_url('cart'); ?>">Keranjang</a>
                </li>
            </ol>
        </nav>

    </div>
    <br>
    <div class="container">
        <h5 class="mb-3"><i class="fa fa-money"></i> Konfirmasi Pembayaran</h5>

        <!-- Konten -->
        <div class="row">

            <!-- KOTAK KIRI -->
            <div class="col-lg-12 col-md-12">

                <div class="card r-posisi-kartu mb-3 container">
                    <h5 class="r-judul-kotak4">
                        Detail Pesanan
                        #<?= $nomor_order; ?>
                    </h5>

                    <div class="container">
                        <!-- START KONTEN ATAS -->
                        <div class="row mt-4 mb-1">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 ">
                                        <h6 class="r-judul-kotak4-1">
                                            <i class="fa fa-user mr-2" style="font-size: 20px;"></i> Data Penerima :
                                        </h6>
                                    </div>
                                    <div class="col-12">
                                        <p class="r-konten-kotak4-1">
                                            <?= $nama_nomor(); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="r-judul-kotak4-1">
                                            <i class="fa fa-map-marker" style="font-size: 20px;"></i> Alamat Pengiriman :
                                        </h6>
                                    </div>
                                    <div class="col-12">
                                        <p class="r-konten-kotak4-1">
                                            <?= $pengiriman(); ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col r-posisi-kotak4-1">
                                <h6 class="r-judul-kotak4-1">
                                    <i class="fa fa-truck" style="font-size: 20px;"></i>
                                    Metode Pengiriman :
                                </h6>
                                <p class="r-konten-kotak4-1">
                                    <?= $jasa(); ?>
                                </p>
                            </div>
                            <div class="col r-posisi-kotak4-1">
                                <h6 class="r-judul-kotak4-1">
                                    <i class="fa fa-credit-card" style="font-size: 20px;"></i>
                                    Metode Pembayaran:
                                </h6>
                                <p class="r-konten-kotak4-1">
                                    <?= $metode_pembayaran(); ?>
                                </p>
                            </div>
                        </div>

                        <hr>
                        <!-- END KONTEN ATAS -->

                        <!--  START KONTEN BAWAH -->
                        <h4 class="text-center">
                            <b>Konfirmasi Pembayaran</b>
                        </h4>
                        <h2 class="text-center">Sukses</h2>
                        <br>
                        <div class="row mb-3">
                            <div class="col-3 m-auto">
                                <a href="<?= site_url('pending'); ?>" class="btn btn-primary btn-lg pt-4 pb-4 btn-block f-button-font">
                                    Lihat Status</a>
                            </div>
                        </div>
                        <!--  END KONTEN BAWAH -->
                    </div>
                </div>  <!-- pusing mas ini untuk apa tidak tahu -->
            </div>  <!-- yang penting jalan lah mas -->
            <!-- END KOTAK KIRI -->

            <!-- KOTAK KANAN -->
            <?php $biaya_subtotal = $biaya_subtotal();
            $biaya_pengiriman = $biaya_pengiriman();
            $total = $biaya_subtotal + $biaya_pengiriman;
            ?>

        </div>
    </div>
    <!-- End Content -->

<?php
include "layout/Footer.php";
?>