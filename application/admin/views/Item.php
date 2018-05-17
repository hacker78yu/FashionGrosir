<?php include "master/Header.php"; ?>
<body>
<?php include 'master/Menu.php'; ?>
<div class="page">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i
                                    class="icon-bars"> </i></a><a href="<?= base_url('adm.php/dashboard') ?>"
                                                                  class="navbar-brand">
                            <div class="brand-text d-none d-md-inline-block"><strong
                                        class="text-primary">FASHION GROSIR</strong></div>
                        </a></div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <li class="nav-item"><a href="<?= base_url('adm.php/auth/logout') ?>" class="nav-link logout">Logout<i
                                        class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <br>
    <section>
        <?php if (isset($_SESSION['validation']) && $_SESSION['validation'] != ""): ?>
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['validation']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['gagal']) && $_SESSION['gagal'] != ""): ?>
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['gagal']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] != ""): ?>
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['berhasil']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1><i class="fas fa-shopping-cart"></i> <?= $title_page; ?></h1>
                            <a data-toggle="modal" href="#" onclick="tambah()" data-target="#crud">Buat baru</a>
                        </div>
                        <div class="col-sm-2">

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tables" class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Hrg VIP</th>
                                <th scope="col">Hrg Reseller</th>
                                <th scope="col">Warna</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Seri</th>
                                <th scope="col">QTY</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($items != NULL): ?>
                                <?php foreach ($items

                                               as $item): ?>
                                    <?php $counter = isset($item->item_detil) ? count((array)$item->item_detil) : 0 ?>
                                    <tr>
                                        <td <?= $counter <= 1 ? '' : 'rowspan="' . (string)($counter + 1) . '" '; ?>
                                                scope="row"
                                                class="align-middle"><?= $item->i_nama; ?></td>
                                        <td <?= $counter <= 1 ? '' : 'rowspan="' . (string)($counter + 1) . '" '; ?>
                                                class="align-middle"
                                                id="rupiah"><?= $item->i_hrg_vip; ?></td>
                                        <td <?= $counter <= 1 ? '' : 'rowspan="' . (string)($counter + 1) . '" '; ?>
                                                class="align-middle"
                                                id="rupiah"><?= $item->i_hrg_reseller; ?></td>
                                        <?php if (isset($item->item_detil) && count((array)$item->item_detil) == 1): ?>
                                            <?php foreach ($item->item_detil as $detil): ?>
                                                <td class="align-middle">
                                                    <?php if (isset($warna($detil->ide_kode, $detil->w_kode)->w_nama)): ?>
                                                        <?= $warna($detil->ide_kode, $detil->w_kode)->w_nama; ?>
                                                    <?php else: ?>
                                                        <i>(Kosong)</i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if (isset($ukuran($detil->ide_kode, $detil->u_kode)->u_nama)): ?>
                                                        <?= $ukuran($detil->ide_kode, $detil->u_kode)->u_nama; ?>
                                                    <?php else: ?>
                                                        <i>(Kosong)</i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if (isset($seri($detil->ide_kode, $detil->s_kode)->s_nama)): ?>
                                                        <?= $seri($detil->ide_kode, $detil->s_kode)->s_nama; ?>
                                                    <?php else: ?>
                                                        <i>(Kosong)</i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $qty($detil->ide_kode); ?>
                                                </td>

                                                <td class="align-middle">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="opsi" type="button"
                                                                class="btn btn-sm btn-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            Opsi
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="opsi">
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="edit($(this))" data-target="#crud"
                                                               data-id="<?= $detil->i_kode; ?>"><i
                                                                        class="far fa-edit fa-lg"></i> Ubah</a>
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="tambah_qty($(this))" data-target="#crud"
                                                               data-id="<?= $detil->ide_kode; ?>"><i
                                                                        class="fas fa-cart-plus fa-lg"></i> Tambaht QTY</a>
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="tambah_foto($(this))" data-target="#crudfoto"
                                                               data-id="<?= $detil->ide_kode; ?>"><i
                                                                        class="fas fa-images fa-lg"></i> Foto</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="hapus($(this))" data-target="#hapus"
                                                               data-id="<?= $detil->ide_kode; ?>"><i
                                                                        class="far fa-trash-alt fa-lg"></i> Hapus</a>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php endforeach; ?>
                                        <?php elseif (!isset($item->item_detil)): ?>
                                            <td class="align-middle"><i>(Kosong)</i></td>
                                            <td class="align-middle"><i>(Kosong)</i></td>
                                            <td class="align-middle"><i>(Kosong)</i></td>
                                            <td class="align-middle"><i>(Kosong)</i></td>
                                            <td class="align-middle">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button id="opsi" type="button"
                                                            class="btn btn-sm btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        Opsi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="opsi">
                                                        <a class="dropdown-item small" data-toggle="modal" href="#"
                                                           onclick="edit_item($(this))" data-target="#crud"
                                                           data-id="<?= $item->i_kode; ?>">
                                                            Tambah Detil
                                                        </a>
                                                        <a class="dropdown-item small" data-toggle="modal" href="#"
                                                           onclick="hapus_item($(this))" data-target="#hapus"
                                                           data-id="<?= $item->i_kode; ?>">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php if (isset($item->item_detil) && count((array)$item->item_detil) > 1): ?>
                                        <?php foreach ($item->item_detil as $detil): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <?php if (isset($warna($detil->ide_kode, $detil->w_kode)->w_nama)): ?>
                                                        <?= $warna($detil->ide_kode, $detil->w_kode)->w_nama; ?>
                                                    <?php else: ?>
                                                        <i>(Kosong)</i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if (isset($ukuran($detil->ide_kode, $detil->u_kode)->u_nama)): ?>
                                                        <?= $ukuran($detil->ide_kode, $detil->u_kode)->u_nama; ?>
                                                    <?php else: ?>
                                                        <i>(Kosong)</i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if (isset($seri($detil->ide_kode, $detil->s_kode)->s_nama)): ?>
                                                        <?= $seri($detil->ide_kode, $detil->s_kode)->s_nama; ?>
                                                    <?php else: ?>
                                                        <i>(Kosong)</i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $qty($detil->ide_kode); ?>
                                                </td>

                                                <td class="align-middle">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="opsi" type="button"
                                                                class="btn btn-sm btn-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            Opsi
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="opsi">
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="edit($(this))" data-target="#crud"
                                                               data-id="<?= $detil->i_kode; ?>"><i
                                                                        class="far fa-edit fa-lg"></i> Ubah</a>
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="tambah_qty($(this))" data-target="#crud"
                                                               data-id="<?= $detil->ide_kode; ?>"><i
                                                                        class="fas fa-cart-plus fa-lg"></i> Tambaht QTY</a>
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="tambah_foto($(this))" data-target="#crudfoto"
                                                               data-id="<?= $detil->ide_kode; ?>"><i
                                                                        class="fas fa-images fa-lg"></i> Foto</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item small" data-toggle="modal"
                                                               href="#"
                                                               onclick="hapus($(this))" data-target="#hapus"
                                                               data-id="<?= $detil->ide_kode; ?>"><i
                                                                        class="far fa-trash-alt fa-lg"></i> Hapus</a>
                                                        </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        <script>
            // ------------------------------------------------------ //
            // Modal CRUD
            // ------------------------------------------------------ //

            function tambah() {
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('item/tambah'); ?>");
            }

            function detil_item(data) {
                d = data;
                url = d.attr('data-url');

                modal = $('#detil_item');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load(url);
            }

            function deskripsi(data) {
                d = data;
                msg = d.attr('data-msg');

                $('textarea#deskripsi').val(msg);
            }

            function tambah_foto(data) {
                d = data;
                id = d.attr('data-id');

                modal = $('#crudfoto');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('item_img/tambah/'); ?>" + id);
            }

            function edit(data) {
                d = data;
                id = d.attr('data-id');
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('item/ubah/'); ?>" + id);
            }

            function tambah_qty(data) {
                d = data;
                id = d.attr('data-id');
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('item/tambah_qty/'); ?>" + id);
            }

            function detil(data) {
                d = data;
                id = d.attr('data-id');
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('item/detil/'); ?>" + id);
            }

            function hapus(data) {
                d = data;
                id = d.attr('data-id');
                $('a#hapus').attr('href', "<?= site_url('item/hapus/'); ?>" + id);
            }

            function hapus_item(data) {
                d = data;
                id = d.attr('data-id');
                $('a#hapus').attr('href', "<?= site_url('item/hapus_item/'); ?>" + id);
            }

            // ------------------------------------------------------ //
            // Data table Pagination
            // ------------------------------------------------------ //
            // $('#tables').DataTable();
            // $('#click').click(function () {
            //     $(this).closest('tr').nextUntil("tr:has(#child)").show();
            // });

            // ------------------------------------------------------ //
            // Tooltip
            // ------------------------------------------------------ //
            $(document).ready(function () {
                $('[tooltip]').tooltip();
            });

            // ------------------------------------------------------ //
            // Remove after 5 second
            // ------------------------------------------------------ //

            $(document).ready(function () {
                setTimeout(function () {
                    if ($('[role="alert"]').length > 0) {
                        $('[role="alert"]').remove();
                    }
                }, 5000);
            });

            // ------------------------------------------------------ //
            // Format Rupiah
            // ------------------------------------------------------ //
            var moneyFormat = wNumb({
                mark: ',',
                decimals: 2,
                thousand: '.',
                prefix: 'Rp. ',
                suffix: ''
            });

            $(document).ready(function () {
                $('td[id="rupiah"]').each(function (index) {
                    var value = parseInt($(this).html()),
                        hasil = moneyFormat.to(value);

                    $(this).html(hasil);
                })
            });

            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css("overflow", "inherit");
            });

            $('.table-responsive').on('hide.bs.dropdown', function () {
                $('.table-responsive').css("overflow", "auto");
            })

        </script>

    </section>
    <footer class="main-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <p>Fashion Grosir &copy; 2018</p>
                </div>

            </div>
        </div>
    </footer>
</div>
<div class="modal fade" id="crud" tabindex="-1" role="dialog" aria-labelledby="crud" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detil_item" tabindex="-1" role="dialog" aria-labelledby="detil_item" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="crudfoto" tabindex="-1" role="dialog" aria-labelledby="crudfoto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">

            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <a id="hapus" href="#" class="btn btn-sm btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
