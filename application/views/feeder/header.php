<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo isset($title)?$title:'Feeder'; ?></title>
  <!-- AdminLTE 3 & Bootstrap from CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.3.16/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('mahasiswa');?>">Mahasiswa</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('akm');?>">AKM</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('dosen');?>">Dosen</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('kelas');?>">Kelas</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('nilai');?>">Nilai</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('matakuliah');?>">Matakuliah</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo site_url('log');?>">Log Sinkronisasi</a></li>
    </ul>
  </nav>
  <div class="content-wrapper" style="padding:20px;">
    <div class="container-fluid">
