ALTER TABLE tran_peminjaman_ruangan RENAME waktu_peminjaman TO waktu_awal_peminjaman;
ALTER TABLE tran_peminjaman_ruangan ADD waktu_akhir_peminjaman VARCHAR(20);
ALTER TABLE tran_peminjaman_ruangan ADD status_id integer;