<!-- Content untuk halaman admin berdasarkan user login -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- berdasarkan jabatan  -->
        <?php if ($sesen_jabatan == "Pemilik") {
            include('contentpemilik.php');
        } else if ($sesen_jabatan == "Admin") {
            include('contentadmin.php');
        } else if ($sesen_jabatan == "Bagian-Produksi") {
            include('contentproduksi.php');
        }
        ?>
    </div>
</div>
<!-- /.content -->