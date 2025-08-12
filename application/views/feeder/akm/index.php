<div class="card">
  <div class="card-header">
    <h3 class="card-title">Akm <small>(tes sinkronisasi)</small></h3>
    <div class="card-tools">
      <a href="<?php echo site_url('akm/sync');?>" class="btn btn-sm btn-primary">Sync Akm</a>
      <a href="<?php echo site_url('akm/push');?>" class="btn btn-sm btn-success">Push Akm</a>
    </div>
  </div>
  <div class="card-body">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('msg');?></div>
    <?php endif; ?>
    <table class="table table-bordered table-sm">
      <thead><tr>
        <th>nim</th><th>ips</th><th>ipk</th>
      </tr></thead>
      <tbody>
        <?php foreach($items as $it): ?>
        <tr>
          <?php echo isset($it['nim'])?htmlspecialchars($it['nim']):''; ?> <?php echo isset($it['ips'])?htmlspecialchars($it['ips']):''; ?> <?php echo isset($it['ipk'])?htmlspecialchars($it['ipk']):''; ?> 
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
