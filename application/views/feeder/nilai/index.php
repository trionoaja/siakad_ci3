<div class="card">
  <div class="card-header">
    <h3 class="card-title">Nilai <small>(tes sinkronisasi)</small></h3>
    <div class="card-tools">
      <a href="<?php echo site_url('nilai/sync');?>" class="btn btn-sm btn-primary">Sync Nilai</a>
      <a href="<?php echo site_url('nilai/push');?>" class="btn btn-sm btn-success">Push Nilai</a>
    </div>
  </div>
  <div class="card-body">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('msg');?></div>
    <?php endif; ?>
    <table class="table table-bordered table-sm">
      <thead><tr>
        <th>nim</th><th>nama_mahasiswa</th><th>nilai_angka</th>
      </tr></thead>
      <tbody>
        <?php foreach($items as $it): ?>
        <tr>
          <?php echo isset($it['nim'])?htmlspecialchars($it['nim']):''; ?> <?php echo isset($it['nama_mahasiswa'])?htmlspecialchars($it['nama_mahasiswa']):''; ?> <?php echo isset($it['nilai_angka'])?htmlspecialchars($it['nilai_angka']):''; ?> 
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
