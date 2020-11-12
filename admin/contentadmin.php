      <div class="row">
          <div class="col-lg-4 col-md-6">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-1">
                              <i class="pe-7s-cash"></i>
                          </div>
                          <?php
                            $sql   = "SELECT sum(total_bayar) AS total FROM tb_pemesanan WHERE status_pemesanan > 1 ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($data = mysqli_fetch_array($result)) {
                                    $a = $data['total'];
                                }
                            } else {
                                echo "Belum ada data";
                            }
                            ?>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <div class="stat-text"><?php echo "Rp. " . number_format($a); ?></span></div>
                                  <div class="stat-heading">Pendapatan</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-2">
                              <i class="fa fa-bar-chart"></i>
                          </div>

                          <?php
                            $sql   = "SELECT sum(jumlah_produk) AS produkjual FROM tb_detail_pemesanan a JOIN tb_pemesanan b ON a.id_pemesanan = b.id_pemesanan WHERE b.status_pemesanan = 5";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($data = mysqli_fetch_array($result)) {
                                    $produk = $data['produkjual'];
                                }
                            } else {
                                echo "Belum ada data";
                            }
                            ?>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <div class="stat-text"><span><?php if ($produk < 1) {
                                                                    echo '0';
                                                                } else {
                                                                    echo $produk;
                                                                }
                                                                ?> Pcs</span></div>
                                  <div class="stat-heading">Produk Terjual</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-3">
                              <i class="fa fa-truck"></i>
                          </div>

                          <?php
                            $sql = "SELECT * FROM tb_pemesanan WHERE status_pemesanan = 3";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_num_rows($result);
                            ?>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <a href="datapemesanan.php">
                                      <div class="stat-text"><span><?php if ($data > 0) {
                                                                        echo $data;
                                                                    } else {
                                                                        echo "0";
                                                                    }
                                                                    ?> Transaksi</span></div>
                                      <div class="stat-heading">Perlu Di Kirim</div>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- pemesanan terbaru -->
      <div class="orders">
          <div class="row">
              <div class="col-xl-12 col-md-10">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="box-title">Transaksi Pemesanan Terbaru </h4>
                      </div>
                      <div class="card-body--">
                          <div class="table-stats">
                              <table class="table">
                                  <thead style="background-color: #F2F2F2;">
                                      <tr>
                                          <th>#ID&nbsp;Pemesanan</th>
                                          <th>Tgl&nbsp;Checkout</th>
                                          <th>Nama&nbsp;Pelanggan</th>
                                          <th>Total&nbsp;Bayar </th>
                                          <th>Status&nbsp;Pemesanan</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $query = mysqli_query($conn, "SELECT * FROM tb_pemesanan a JOIN tb_pelanggan b ON a.id_pelanggan = b.id_pelanggan ORDER BY a.id_pemesanan LIMIT 5");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            $tgl = date('d-m-Y', strtotime($data['tanggal_checkout']));
                                            $id =  $data['id_pemesanan'];
                                            $status =  $data['status_pemesanan'];
                                        ?>
                                          <tr>
                                              <td><?= $id; ?></td>
                                              <td><?= $tgl; ?></td>
                                              <td><?php echo $data['nama_pelanggan']; ?></td>
                                              <td><?php echo "Rp. " . number_format($data['total_bayar']); ?></td>
                                              <td>
                                              <?php
                                                        if ($status == 0) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-danger'>Gagal</span></a>";
                                                        } elseif ($status == 1) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-danger'>Menunggu Pembayaran</span></a>";
                                                        } elseif ($status == 2) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-success'>Pembayaran Success</span></a>";
                                                        } elseif ($status == 3) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-primary'>Sedang Dipacking</span></a>";
                                                        } elseif ($status == 4) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-info'>Sudah Dikirim</span></a>";
                                                        } elseif ($status == 5) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-success'><i class='fa fa-check'> </i> Selesai</span></a>";
                                                        }
                                                        ?>
                                              </td>
                                          </tr>
                                      <?php
                                        }
                                        ?>
                                  </tbody>
                              </table>
                          </div> <!-- /.table-stats -->
                      </div>
                  </div> <!-- /.card -->
              </div> <!-- /.col-lg-8 -->

              <!-- <div class="col-xl-4">
                  <div class="row">
                      <div class="col-lg-6 col-xl-12">
                          <div class="card br-0">
                              <div class="card-body">
                                  <div class="chart-container ov-h">
                                      <div id="flotPie1" class="float-chart"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div> -->
          </div>
      </div>


      
      <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center><p><b>STATUS PEMESANAN</b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p></center>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data2"></div>
                    </div>
                </div>
                </div>
            </div>
        </div>


    <!-- /#right-panel -->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
       <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal2').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'modal/statuspemesanan.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data2').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
    