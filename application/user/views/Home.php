<?php
include "layout/Header.php";
include "layout/Brand.php";
include "layout/Menu.php";
include "layout/Slide.php";
?>
    <br>
    <!-- Title Content -->

    <!-- Title Content -->

    <!-- Content -->
    <div class="container">
        <div class="row">
            <?php if (isset($_SESSION['gagal']) && $_SESSION['gagal'] != ""): ?>
                <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show"
                         role="alert">
                        <?php echo $_SESSION['gagal']; ?>
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] != ""): ?>
                <div class="col">
                    <div class="alert alert-success alert-dismissible fade show"
                         role="alert">
                        <?php echo $_SESSION['berhasil']; ?>
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                <h6 class="card-title mb-2 text-left r-title-kat pt-2 pb-2">Kategori</h6>
                <?php if ($menu_kategori != NULL): ?>
                    <ul class="nav flex-column c-ul-footer">
                        <?php foreach ($menu_kategori as $menukat): ?>
                                <a class="r-item-kat mb-1" href="<?= site_url('kategori/' . $menukat->k_url); ?>">

                                          <?= $menukat->k_nama; ?>
                                </a>

                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Tidak ada kategori</p>
                <?php endif; ?>
            </div>

            <div class="col-12 col-sm-12 col-md-10 col-lg-10">

                <div class="row">
                    <div class="container ">
                        <h6 class="mb-3 r-title-kat pt-2 pb-2">Produk Terbaru</h6>
                        <hr>
                    </div>
                    <?php if ($terbaru_items() != NULL): ?>
                        <?php foreach ($terbaru_items() as $terbaru): ?>
                            <?php $stok = $qty($terbaru->i_kode); ?>
                            <?php if ($stok >= 1): ?>
                                <div class="col-12 col-sm-3 col-md-3 col-lg-3 mb-3">
                                    <div class="thumbnail"
                                         data-url="<?= site_url('produk-terbaru/' . $terbaru->i_url . '/detil'); ?>">
                                        <div class="image mx-auto d-block">

                                            <?php if ($item_img($terbaru->i_kode) != NULL): ?>
                                                <img class="img-fluid"
                                                     src="data:<?= $item_img($terbaru->i_kode)->ii_type . ';base64,' . (base64_encode($item_img($terbaru->i_kode)->ii_data)); ?>"
                                                     alt="<?= $item_img($terbaru->i_kode)->ii_kode; ?>">
                                            <?php else: ?>
                                                <img class="img-fluid"
                                                     src="<?= base_url('assets/img/noimage.jpg'); ?>"
                                                     alt="No Image">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12 col-md-12 col-sm-12 text-center">
                                            <h6 id="title" class="mt-2"><?= $terbaru->i_nama; ?></h6>
                                        </div>

                                        <div class="ratings">
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        </div>
                                        <hr class="mb-2 mt-0">
                                        <div class="col-12 col-md-12 col-sm-12 text-center">
                                            <?php if (isset($_SESSION['tipe']) && $_SESSION['tipe'] == '1'): ?>
                                                <p id="rupiah" class="mt-1 price"><?= $terbaru->i_hrg_vip; ?></p>
                                            <?php else: ?>
                                                <p id="rupiah"
                                                   class="mt-1 align-middle price"><?= $terbaru->i_hrg_reseller; ?></p>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="col">Tidak ada item yang ditampilkan</p>
                    <?php endif; ?>
                    <br>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->
    <script>
        $('[id="rating"]').emojiRating()
    </script>
<?php
include "layout/Footer.php";
?>