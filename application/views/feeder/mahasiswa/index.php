<div class="card">
  <div class="card-header">
    <h3 class="card-title">Mahasiswa <small>(tes sinkronisasi)</small></h3>
    <div class="card-tools">
      <a href="<?php echo site_url('mahasiswa/sync');?>" class="btn btn-sm btn-primary">Sync Mahasiswa</a>
      <a href="<?php echo site_url('mahasiswa/push');?>" class="btn btn-sm btn-success">Push Mahasiswa</a>
    </div>
  </div>
  <div class="card-body">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('msg');?></div>
    <?php endif; ?>

    <table id="mahasiswaTable" class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Program Studi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($items) && is_array($items)): ?>
          <?php foreach ($items as $item): ?>
            <tr>
              <td><?php echo $item->nim; ?></td>
              <td><?php echo $item->nama_mahasiswa; ?></td>
              <td><?php echo $item->nama_program_studi; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- DataTables JS -->

