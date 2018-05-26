<?php
include "layout/Header.php";
include "layout/Brand.php";
include "layout/Menu.php";
?>

    <!-- Konten -->
    <div class="container-fluid">
        <div class="row mt-1">
            <div class="col-2">

            </div>
            <div class="col-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb f-no-background f-hover">
                        <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="row mt-2">

            <!-- Side bar menu -->
            <div class="col-12 col-sm-12 col-md-2">

                    <ul class="list-group">
                        <li class="list-group-item active">
                            <a href="<?= site_url('profil'); ?>">Profil Saya</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= site_url('profil_alamat'); ?>">Alamat Saya</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= site_url('profil_password'); ?>" >Ubah Password</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= site_url('riwayat'); ?>">Riwayat Pesanan</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?= site_url('pending'); ?>">Transaksi Pending</a>
                        </li>
                    </ul>

            </div>

            <!-- END  -->


            <!-- Konten  -->
            <div class="col-12 col-sm-12 col-md-9">

                <div class="card container-fluid">

                    <div class="row container">
                        <div class="col">
                            <h3 class="r-style-title-konten-profile">
                                PROFIL SAYA
                            </h3>
                            <hr style="width: 30%;">
                        </div>
                    </div>

                    <div class="row container r-layout-konten-profile">

                        <div class="col-12 col-sm-12 col-md-2">

                        </div>
                        <div class="col-12 col-sm-12 col-md-8">
                            <form>

                                <div class="form-group">
                                    <label class="r-font-konten-profile">Alamat Email : </label>
                                    <input type="email" class="form-control" disabled="" placeholder="lucintaluna@bukanlaki.com">
                                </div>

                                <div class="form-group">
                                    <label class="r-font-konten-profile">Nama Lengkap : </label>
                                    <input type="password" class="form-control" disabled="" placeholder="Ricky Meong">

                                </div>

                                <div class="form-group">
                                    <label class="r-font-konten-profile">Nomor Telepon : </label>
                                    <input type="password" class="form-control" disabled="" placeholder="0823 1056 9056">

                                </div>

                                <br>



                            </form>


                        </div>


                        <div class="col-12 col-sm-12 col-md-2">

                        </div>


                    </div>


                    <div class="row container">
                        <div class="col-12 col-sm-12 col-md-2 ">

                        </div>
                        <div class="col-12 col-sm-12 col-md-8 text-center">
                            <button type="submit" class="btn r-btn-konten-profile "><i class="fa fa-pencil"></i> Ubah</button>
                            <button type="submit" class="btn r-btn-konten-profile " disabled=""><i class="fa fa-times"></i> Batal</button>
                            <button type="submit" class="btn r-btn-konten-profile " disabled=""><i class="fa fa-save"></i> Simpan</button>
                        </div>

                        <div class="col-12 col-sm-12 col-md-2">

                        </div>

                    </div>

                    <br>


                </div>

            </div>

        </div>
    </div>

    <!-- END Konten -->
<?php
include "layout/Footer.php";
?>