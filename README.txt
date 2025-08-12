
SIAKAD CI3 - Feeder Integration (minimal)
========================================

What is included:
- Minimal CodeIgniter-like structure under application/
- Library FeederApi for communicating with PDDIKTI feeder
- Controllers: Mahasiswa, Akm, Dosen, Kelas, Nilai, Log
- Models for each module and Log_model
- Views using AdminLTE 3 via CDN
- SQL: siakad_with_log.sql (original siakad.sql contents with added log_sinkronisasi table)

How to use:
1. Copy the contents of this project into your XAMPP htdocs (e.g. C:\xampp\htdocs\siakad)
2. Place a real CodeIgniter 3 index.php and system/ folder if you want full CI functionality,
   or adjust index.php to point to your CI installation.
3. Import the SQL file: application/..../siakad_with_log.sql into your MySQL database named `siakad`
4. Update application/config/database.php with your DB credentials (host, username, password).
5. Ensure application/config/feeder.php contains your feeder URL and credentials.
6. Access in browser: http://localhost/siakad/ (or your path) and navigate to modules.

Notes:
- Views reference AdminLTE and Bootstrap via CDN; internet is required to load styling.
- The FeederApi library uses the feeder URL and attempts GetToken on construct.
- This is a minimal scaffolding to speed up integration. You should harden input mapping,
  error handling, pagination, and field transformations according to PDDIKTI expectations.
