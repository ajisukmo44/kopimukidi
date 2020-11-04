<select name="id_penjualan" id="id_penjualan" class="form-control" required>
    <option value="">-- Pilih Transaksi --</option>
    <?php
    $query = "SELECT * FROM tb_penjualan WHERE status_transaksi = 3 ORDER BY id_penjualan";
    $sql = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_array($sql)) {
        echo '<option value="' . $data['id_penjualan'] . '">' . $data['id_penjualan'] . '</option>';
    }
    ?>
</select>