<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Dosen</h3>
    <div class="card-tools">
      <a href="<?php echo site_url('dosen/sync');?>" class="btn btn-sm btn-primary">Sync Dosen</a>
    </div>
  </div>
  <div class="card-body">
    <?php if($this->session->flashdata('success')): ?>
      <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
    <?php elseif($this->session->flashdata('error')): ?>
      <div class="alert alert-danger"><?php echo $this->session->flashdata('error');?></div>
    <?php endif; ?>

    <a href="<?= site_url('dosen/create') ?>" class="btn btn-primary mb-3">Tambah Dosen</a>
    
    <table id="mahasiswaTable" class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>NIDN</th>
          <th>NUPTK</th>
          <th>Nama Dosen</th>
          <th>Program Studi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($items) && is_array($items)): ?>
          <?php foreach ($items as $item): ?>
            <tr>
              <td><?php echo $item->nidn; ?></td>
              <td><?php echo $item->nuptk; ?></td>
              <td><?php echo $item->nama_dosen; ?></td>
              <td><?php echo $item->nama_program_studi; ?></td>
              <td>
                <a href="<?php echo site_url('dosen/push/'.$item->nuptk); ?>" class="btn btn-success btn-sm">Push</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">Tidak ada data dosen</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
