<div class="card">
  <div class="card-header">
    <h3 class="card-title">Log Sinkronisasi</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-sm">
      <thead><tr><th>Waktu</th><th>Modul</th><th>Aksi</th><th>Status</th><th>Keterangan</th></tr></thead>
      <tbody>
        <?php foreach($logs as $l): ?>
        <tr>
          <td><?php echo $l['waktu'];?></td>
          <td><?php echo $l['modul'];?></td>
          <td><?php echo $l['jenis_aksi'];?></td>
          <td><?php echo $l['status'];?></td>
          <td><?php echo $l['keterangan'];?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
