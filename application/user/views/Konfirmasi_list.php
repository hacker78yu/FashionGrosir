<?php
include "layout/Header.php";
include "layout/Brand.php";
include "layout/Menu.php";
?>

    <!-- Konten -->
    <div class="container">

        <div class="row mt-1">
            <div class="col-2">

            </div>
            <div class="col-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb f-no-background f-hover">
                        <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-2">

            <!-- Side bar menu -->
            <div class="col-12 col-sm-12 col-md-2">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action" href="<?= site_url('profil'); ?>">Profil</a>
                    <a class="list-group-item list-group-item-action" href="<?= site_url('profil_alamat'); ?>">Alamat
                    </a>
                    <a class="list-group-item list-group-item-action" href="<?= site_url('profil_password'); ?>">Ubah
                        Password</a>
                    <a class="list-group-item list-group-item-action" href="<?= site_url('riwayat'); ?>">Riwayat
                        Pesanan</a>
                    <a class="list-group-item list-group-item-action" href="<?= site_url('pending'); ?>">Transaksi
                        Pending</a>
                </div>
            </div>

            <!-- END  -->


            <!-- Konten  -->
            <div class="col-12 col-sm-12 col-md-9">

                <div class="card container p-4">

<!--                    <div class="row container">-->
<!--                        <div class="col">-->
<!--                            <h3 class="r-style-title-konten-profile">-->
<!--                                Riwayat Pesanan-->
<!--                            </h3>-->
<!--                            <hr style="width: 30%;">-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>ID Pesanan</th>
<!--                                <th>Tanggal Transaksi</th>-->
                                <th>Total Harga</th>
                                <th>Nama Penerima</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>   </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>1</td>
                                <td>ASD21345</td>
<!--                                <td>12-Mar-2018</td>-->
                                <td>100.000</td>
                                <td>Caesar</td>
                                <td>Jln Cengkareng...</td>
                                <td>Menunggu Konfirmasi</td>
                                <td>
                                    <a href="<?= site_url('konfirmasi'); ?>" class="btn btn-primary btn-sm btn-block f-button-font">Konfirmasi</a>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>1</td>
                                <td>ASD21345</td>
<!--                                <td>12-Mar-2018</td>-->
                                <td>100.000</td>
                                <td>Caesar</td>
                                <td>Jln Cengkareng...</td>
                                <td>Menunggu Konfirmasi</td>
                                <td>
                                    <a href="<?= site_url('konfirmasi'); ?>" class="btn btn-primary btn-sm btn-block f-button-font">Konfirmasi</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>



                    </div>
                    <div class="row pagination-layout">
                        <div class="col ">
                            <div class="pagination">
                                <a href="#">&laquo;</a>
                                <a href="#">1</a>
                                <a href="#" class="active">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <a href="#">&raquo;</a>
                            </div>
                        </div>
                    </div>

                </div>







            </div>





        </div>

    </div>


    <!-- END Konten -->
<?php
include "layout/Footer.php";
?>