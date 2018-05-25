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
                            <h1><i class="fas fa-file-alt"></i> Order</h1>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tables" class="table table-sm table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">No. Order</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($orders != NULL): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td class="text-danger"><?= $order->o_noorder; ?></td>
                                        <td><?= $order->p_nama; ?></td>
                                        <td id="rupiah"><?= $order->total; ?></td>
                                        <td>
                                            <?php if ($order->o_status == 1): ?>
                                                <a tooltip data-toggle="modal" title="Konfirmasi Pembayaran" href="#"
                                                   onclick="konfirmasi($(this))" data-target="#konfirmasi"
                                                   data-id="<?= $order->o_kode; ?>"><i class="fas fa-check"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($order->o_status == 2): ?>
                                                <a <?= $order->o_status == 2 ? '' : 'disabled'; ?>
                                                        tooltip data-toggle="modal" title="Proses <?= $title_page; ?>"
                                                        href="#"
                                                        onclick="proses($(this))" data-target="#crud" data-backdrop="static" data-keyboard="false"
                                                        data-id="<?= $order->o_kode; ?>"><i
                                                            class="fas fa-exchange-alt"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($order->o_status == 3): ?>
                                                <a tooltip data-toggle="modal"
                                                   title="Konfirmasi Pengiriman" href="#"
                                                   onclick="pengiriman($(this))" data-target="#crud" data-backdrop="static" data-keyboard="false"
                                                   data-id="<?= $order->o_kode; ?>">
                                                    <i class="fas fa-truck-moving"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3"><b>Tanggal Order : </b><br>
                                            <?= $order->created_at; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3"><b>Status Order : </b>
                                            <?php if ($order->o_status == 1): ?>
                                                <div class="text-warning">MENUNGGU KONFIRMASI ADMIN</div>
                                            <?php elseif ($order->o_status == 2): ?>
                                                <div class="text-success">SUDAH DIBAYAR</div>
                                            <?php elseif ($order->o_status == 3): ?>
                                                <div class="text-success">SEDANG DIPROSES</div>
                                            <?php elseif ($order->o_status == 4): ?>
                                                <div class="text-success">SUKSES</div>
                                            <?php elseif ($order->o_status == 5): ?>
                                                <div class="text-danger">BATAL</div>
                                            <?php else: ?>
                                                <div class="text-danger">BELUM DIBAYAR</div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

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

            function konfirmasi(data) {
                d = data;
                id = d.attr('data-id');
                $('a#konfirmasi').attr('href', "<?= site_url('order/konfirmasi/'); ?>" + id + "/proses");
            }

            function tambah() {
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('ukuran/tambah'); ?>");
            }

            function edit(data) {
                d = data;
                id = d.attr('data-id');
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('ukuran/ubah/'); ?>" + id);
            }

            function detil(data) {
                d = data;
                id = d.attr('data-id');
                modal = $('#crud');
                bodymodal = modal.find('div.modal-body');

                bodymodal.load("<?= site_url('ukuran/detil/'); ?>" + id);
            }

            function hapus(data) {
                d = data;
                id = d.attr('data-id');
                $('a#hapus').attr('href', "<?= site_url('ukuran/hapus/'); ?>" + id);
            }

            // ------------------------------------------------------ //
            // Data table users
            // ------------------------------------------------------ //
            // $('#tables').DataTable();

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
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">

            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="konfirmasi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">

            <div class="modal-body">
                <p>Apakah anda yakin?</p>
            </div>
            <div class="modal-footer">
                <a id="konfirmasi" href="#" class="btn btn-primary btn-primary">Proses</a>
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
