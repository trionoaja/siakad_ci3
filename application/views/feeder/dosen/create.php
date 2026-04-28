<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dosen</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
<div class="container mt-4">
    <h3>Tambah Dosen</h3>
    <form method="post" action="<?= site_url('dosen/store') ?>">
        <div class="form-group">
            <label>Nama Dosen</label>
            <input type="text" name="nama_dosen" class="form-control" required>
        </div>
        <div class="form-group">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control" required>
        </div>
        <div class="form-group">
            <label>NUPTK</label>
            <input type="text" name="nuptk" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control">
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control">
        </div>
        <div class="form-group">
            <label>ID Agama</label>
            <input type="text" name="id_agama" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Ibu Kandung</label>
            <input type="text" name="nama_ibu_kandung" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('dosen') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
