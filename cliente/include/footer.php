<footer class="container">
    <?php if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index'): ?>
    <div class="row">
        <div class="col text-center p-5 mb-5 mb-lg-0 p-lg-0 mt-0 mt-lg-5">
            <a href="#top" class="">
                <button class="btn btn-outline-secondary rounded-0"><i class="fas fa-arrow-up"></i></button></a>
        </div>
    </div>
    <div class="row">
        <div class="col text-center p-lg-3 mt-0 mt-lg-3 mb-lg-0 d-none d-lg-block">
            <span class="font-weight-light">&copy; Fidelize - 2019</span>
        </div>
    </div>
    <?php endif; ?>
</footer>
<script src="../media/js/jquery-3.4.1.min.js"></script>
<script src="../media/js/bootstrap.min.js"></script>
<script src="../media/js/jquery.mask.min.js"></script>
<script src="../media/js/bs-custom-file-input.min.js"></script>
<script src="media/js/jquery.js"></script>
</body>
</html>