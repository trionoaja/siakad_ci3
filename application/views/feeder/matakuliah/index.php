<div class="card">
  <div class="card-header">
    <h3 class="card-title">Mata Kuliah</h3>
    <div class="card-tools">
      <a href="<?php echo site_url('matakuliah/sync');?>" class="btn btn-sm btn-primary">Sync Mata Kuliah</a>
    </div>
  </div>
  <div class="card-body">
    <table id="mahasiswaTable" class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>Kode MK</th>
          <th>Nama Mata Kuliah</th>
          <th>SKS</th>
          <th>Program Studi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $mk): ?>
          <tr>
            <td><?php echo $mk->kode_mata_kuliah; ?></td>
            <td><?php echo $mk->nama_mata_kuliah; ?></td>
            <td><?php echo $mk->sks_mata_kuliah; ?></td>
            <td><?php echo $mk->nama_program_studi; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
