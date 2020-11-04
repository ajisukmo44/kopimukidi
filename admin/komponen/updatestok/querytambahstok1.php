<select name="id_produk" id="id_produk" class="form-control" readonly>
    <?php
    $query = "SELECT * FROM tb_produk WHERE id_produk = $id ORDER BY id_produk ";
    $sql = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_array($sql)) {
        echo '<option value="' . $data['id_produk'] . '">' . $data['nama_produk'] . '</option>';
    }
    ?>
</select>