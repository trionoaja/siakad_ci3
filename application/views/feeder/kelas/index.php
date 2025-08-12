<div class="card">
  <div class="card-header">
    <h3 class="card-title">Kelas <small>(tes sinkronisasi)</small></h3>
    <div class="card-tools">
      <a href="<?php echo site_url('kelas/sync');?>" class="btn btn-sm btn-primary">Sync Kelas</a>
      <a href="<?php echo site_url('kelas/push');?>" class="btn btn-sm btn-success">Push Kelas</a>
    </div>
  </div>
  <div class="card-body">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('msg');?></div>
    <?php endif; ?>
    <table class="table table-bordered table-sm">
      <thead><tr>
        <th>kode_mata_kuliah</th><th>nama_mata_kuliah</th><th>nama_kelas_kuliah</th>
      </tr></thead>
      <tbody>
        <?php foreach($items as $it): ?>
        <tr>
          <?php echo isset($it['kode_mata_kuliah'])?htmlspecialchars($it['kode_mata_kuliah']):''; ?> <?php echo isset($it['nama_mata_kuliah'])?htmlspecialchars($it['nama_mata_kuliah']):''; ?> <?php echo isset($it['nama_kelas_kuliah'])?htmlspecialchars($it['nama_kelas_kuliah']):''; ?> 
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
