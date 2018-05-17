<?php
include "layout/Header.php";
?>
<?php if (isset($log) && $log != ""): ?>
    <p class="text-danger"><?= $log; ?></p>
<?php endif; ?>
    <!-- Login -->
    <form method="post" action="<?= site_url('login'); ?>" class="form-signin">
        <input type="hidden" name="token_fg" value="<?= $this->security->get_csrf_hash(); ?>">
        <h4 class="h4 mb-3 font-weight-normal text-center f-title-color">Fashion Grosir</h4>
        <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input type="email" id="email" name="email" class="form-control f-input-shadow" placeholder="Email address" required
                   autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control f-input-shadow" placeholder="Password"
                   required>
        </div>

        <button class="btn btn-lg btn-primary btn-block f-button-font" type="submit">Sign in</button>
<!--        <p class="text-center f-margin-forgot f-hover-forgot"><a href="--><?//= site_url('forgot'); ?><!--">Kamu lupa password-->
<!--                ?</a></p>-->
<!--        <hr>-->
<!--        <p class="text-center">Belum punya akun? <a href="--><?//= site_url('register'); ?><!--">Mendaftar disini</a></p>-->
    </form>
    <!-- End Login -->

<?php
?>