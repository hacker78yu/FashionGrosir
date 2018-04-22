<script>
    var base_url = '<?= base_url(); ?>';
    var hashing = '<?= $this->security->get_csrf_hash(); ?>';
</script>
<br>
<section ng-controller="CrudKategoriController">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="col-sm-10">
                    <h2>KATEGORI</h2>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#buatKategori"
                            ng-click="showCRUD()">Buat
                    </button>
                </div>

            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <!--                                <th>Parent</th>-->
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr ng-repeat="kategori in kategories track by kategori.Kat_ID">
                            <td class="text-uppercase">{{kategori.Kat_Nama | limitTo:limitChar}}</td>
                            <!--                                <td>{{kategori.Kat_Parent_ID}}</td>-->
                            <td>
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#ubahKategori" ng-click="ubahKategori(kategori.Kat_ID)">Ubah
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#hapusKategori" ng-click="konfirmasihapus(kategori.Kat_ID)">Hapus
                                </button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahKategori" tabindex="-1" role="dialog" aria-labelledby="ubahKategori"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="container" ng-submit="updateKategori()">

                        <div class="form-group">
                            <label for="u_kat_nama">Nama</label>
                            <input type="text" class="form-control" id="u_kat_nama"
                                   ng-model="u_kat_nama"
                                   ng-minlength="5"
                                   ng-maxlength="20"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="u_kat_parent_id">Kategori</label>
                            <select class="form-control" id="u_kat_parent_id" name="u_kat_parent_id"
                                    ng-model="u_kat_parent_id" required>
                                <option value="">Pilih kategori</option>
                                <option value="0" selected>Root</option>
                                <option ng-repeat="kategori in kategories" value="{{kategori.Kat_ID}}">
                                    {{kategori.Kat_Nama}}
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" ng-click="updateKategori()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="buatKategori" tabindex="-1" role="dialog" aria-labelledby="buatKategori"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="buatKategoriForm" id="buatKategoriForm" class="container"
                          ng-submit="buatKategori(buatKategoriForm.$valid)">
                        <div class="form-group"
                             ng-class="{'is-invalid' : buatKategoriForm.b_kat_nama.$invalid && !buatKategoriForm.b_kat_nama.$pristine}">
                            <label for="b_kat_nama">Nama</label>
                            <input type="text" class="form-control" id="b_kat_nama"
                                   ng-model="b_kat_nama"
                                   ng-minlength="5"
                                   ng-maxlength="20"
                                   required autofocus>
                        </div>
                        <div class="form-group"
                             ng-class="{'is-invalid' : buatKategoriForm.b_kat_parent_id.$invalid && !buatKategoriForm.b_kat_parent_id.$pristine}">
                            <label for="b_kat_parent_id">Kategori</label>
                            <select class="form-control" id="b_kat_parent_id" ng-model="b_kat_parent_id" required>
                                <option value="">Pilih kategori</option>
                                <option value="0" selected>Root</option>
                                <option ng-repeat="kategori in kategories track by $index" value="{{kategori.Kat_ID}}">
                                    {{kategori.Kat_Nama}}
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary"
                           data-dismiss="modal"
                           aria-label="Buat"
                           ng-disabled="buatKategoriForm.$invalid"
                           ng-click="buatKategori(buatKategoriForm.$valid)" value="Simpan">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hapusKategori" tabindex="-1" role="dialog" aria-labelledby="hapusKategori"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus kategori ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Hapus"
                            ng-click="hapusKategori()">Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>