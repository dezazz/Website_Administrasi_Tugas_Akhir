-- buat view v_jadwal_uji_kelayakans yang berisi data dari tabel jadwal_uji_kelayakans join mahasiswas join skripsis
-- ambil nim, nama, judul skripsi, tanggal, waktu, tempat
CREATE VIEW v_jadwal_uji_kelayakan AS SELECT m.nim, m.nama, s.judul_skripsi, j.tanggal, j.waktu, j.tempat FROM jadwal_uji_kelayakans j JOIN mahasiswas m ON j.nim = m.nim JOIN skripsis s ON j.nim = s.nim;

-- create table jadwal_uji_kelayakans (nim, tanggal, waktu, tempat)
CREATE TABLE jadwal_uji_kelayakans (nim VARCHAR(10), tanggal DATE, waktu TIME, tempat VARCHAR(50));

-- insert data ke tabel jadwal_uji_kelayakans
INSERT INTO jadwal_uji_kelayakans VALUES ('171402001', '2019-01-01', '08:00:00', 'Ruang 1');

-- create table uji_kelayakans (nim, nip, tanggal, waktu
-- 1	Judul Skripsi enum(terima, perbaiki, ganti)
--  catatan_judul_skripsi text
-- 2	Latar Belakang enum(terima, perbaiki, ganti)
--  catatan_latar_belakang text
-- 3	Rumusan Masalah enum(terima, perbaiki, ganti)
-- catatan_rumusan_masalah text
-- 4	Landasan Teori enum(terima, perbaiki, ganti)
-- catatan_landasan_teoris text
-- 5	Penelitian Terdahulu enum(terima, perbaiki, ganti)
-- catatan_penelitian_terdahulu text
-- 6	Data yang Digunakan enum(terima, perbaiki, ganti)
-- catatan_data_yang_digunakan text
-- 7	Metodologi (Arsitektur Umum) enum(terima, perbaiki, ganti)
-- catatan_metodologi text
-- 8	Daftar Pustaka ) enum(terima, perbaiki, ganti)
-- catatan_daftar_pustaka text

CREATE OR REPLACE TABLE uji_kelayakans (nim VARCHAR(10), nip VARCHAR(10), tanggal DATE, waktu TIME, judul_skripsi ENUM('terima', 'perbaiki', 'ganti'), catatan_judul_skripsi TEXT, latar_belakang ENUM('terima', 'perbaiki', 'ganti'), catatan_latar_belakang TEXT, rumusan_masalah ENUM('terima', 'perbaiki', 'ganti'), catatan_rumusan_masalah TEXT, landasan_teoris ENUM('terima', 'perbaiki', 'ganti'), catatan_landasan_teoris TEXT, penelitian_terdahulu ENUM('terima', 'perbaiki', 'ganti'), catatan_penelitian_terdahulu TEXT, data_yang_digunakan ENUM('terima', 'perbaiki', 'ganti'), catatan_data_yang_digunakan TEXT, metodologi ENUM('terima', 'perbaiki', 'ganti'), catatan_metodologi TEXT, daftar_pustaka ENUM('terima', 'perbaiki', 'ganti'), catatan_daftar_pustaka TEXT);


-- CREATE TABLE pegawai_prodis (
--       nip VARCHAR(18)  NOT NULL,
--       nama VARCHAR(64)  NOT NULL,
--       jenis_kelamin ENUM('laki-laki', 'perempuan')  NOT NULL,
--       id_user INT(9) UNSIGNED NOT NULL,
--       created_at TIMESTAMP NULL DEFAULT NULL,
--       updated_at TIMESTAMP NULL DEFAULT NULL,
--      PRIMARY KEY(nip),
--      KEY dosens_id_user_foreign(id_use`),
--      CONSTRAINT pegawais_id_user_foreign FOREIGN KEY(id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
-- ) 

CREATE OR REPLACE TABLE pegawai_prodis (
    nip VARCHAR(18)  NOT NULL,
    nama VARCHAR(64)  NOT NULL,
    jenis_kelamin ENUM('laki-laki', 'perempuan')  NOT NULL,
    id_user INT(9) UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(nip),
    KEY pegawai_prodis_id_user_foreign(id_user),
    CONSTRAINT pegawai_prodis_id_user_foreign FOREIGN KEY(id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)

CREATE OR REPLACE TABLE kepala_laboratoriums (
    nip VARCHAR(18)  NOT NULL,
    id_user INT(9)  NOT NULL,
    id_bidang_ilmu INT(9) UNSIGNED NOT NULL,
    PRIMARY KEY(nip),
    KEY kepala_laboratorium_id_user_foreign(id_user),
    KEY kepala_laboratorium_id_bidang_ilmu_foreign(id_bidang_ilmu), 
    CONSTRAINT kepala_laboratorium_id_user_foreign FOREIGN KEY(id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT kepala_laboratorium_id_bidang_ilmu_foreign FOREIGN KEY(id_bidang_ilmu) REFERENCES bidang_ilums(id) ON DELETE CASCADE ON UPDATE CASCADE
)



-- nama
-- nim
-- pengaju enum(dosen, mahasiswa)
-- Judul / Topik Skripsi 	
-- Latar Belakang dan Penelitian Terdahulu 	
-- Rumusan Masalah 	
-- Metodologi 	
-- Referensi 
CREATE OR REPLACE TABLE pengajuan_judul (nama VARCHAR(64), nim CHAR(9), pengaju ENUM('dosen', 'mahasiswa'), judul_skripsi TEXT, latar_belakang TEXT, rumusan_masalah TEXT, metodologi TEXT, referensi TEXT);

CREATE OR REPLACE VIEW daftar_nilai_uji_kelayakan AS SELECT m.nim, m.nama AS nama_mhs, d.nip, d.nama as nama_dosen, p.judul_skripsi, p.latar_belakang, p.rumusan_masalah, p.landasan_teori, p.penelitian_terdahulu, p.data_yang_digunakan, p.metodologi, p.daftar_pustaka, f_hitung_total_nilai_kelayakan(m.nim) AS hasil FROM mahasiswas m JOIN nilai_uji_kelayakans p ON m.nim = p.nim JOIN dosens d ON p.nip = d.nip; 

-- trigger log penambahan nilai uji program 
DELIMITER $$
CREATE OR REPLACE TRIGGER log_penambahan_nilai_uji_program AFTER INSERT ON nilai_uji_programs FOR EACH ROW 
BEGIN 
DECLARE total FLOAT(5,2);
SELECT NEW.nilai_kemampuan_dasar_program + NEW.nilai_kecocokan_algoritma + NEW.nilai_penguasaan_program + NEW.nilai_penguasaan_ui + NEW.nilai_validasi_output INTO total;
INSERT INTO log_penambahan_nilai_uji_programs (nim, nip, nilai_kemampuan_dasar_program, nilai_kecocokan_algoritma, nilai_penguasaan_program, nilai_penguasaan_ui, nilai_validasi_output, total_nilai) VALUES (NEW.nim, NEW.nip, NEW.nilai_kemampuan_dasar_program, NEW.nilai_kecocokan_algoritma, NEW.nilai_penguasaan_program, NEW.nilai_penguasaan_ui, NEW.nilai_validasi_output, total);
END $$
DELIMITER ;

-- trigger log pengubahan nilai uji program
DELIMITER $$
CREATE OR REPLACE TRIGGER log_pengubahan_nilai_uji_program AFTER UPDATE ON nilai_uji_programs FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.nilai_kemampuan_dasar_program + NEW.nilai_kecocokan_algoritma + NEW.nilai_penguasaan_program + NEW.nilai_penguasaan_ui + NEW.nilai_validasi_output INTO total;
INSERT INTO log_pengubahan_nilai_uji_programs (nim, nip, nilai_kemampuan_dasar_program, nilai_kecocokan_algoritma, nilai_penguasaan_program, nilai_penguasaan_ui, nilai_validasi_output, total_nilai) VALUES (NEW.nim, NEW.nip, NEW.nilai_kemampuan_dasar_program, NEW.nilai_kecocokan_algoritma, NEW.nilai_penguasaan_program, NEW.nilai_penguasaan_ui, NEW.nilai_validasi_output, total);
END $$
DELIMITER ;

-- trigger log penambahan nilai seminar hasil
-- nim, nip, abstrak, pendahuluan, rumusan_masalah, landasan_teori, metodologi, implementasi, kesimpulan, kemampuan_mengemukakan_substansi
DELIMITER $$
CREATE OR REPLACE TRIGGER log_penambahan_nilai_seminar_hasil AFTER INSERT ON nilai_seminar_hasils FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.abstrak + NEW.pendahuluan + NEW.landasan_teori + NEW.metodologi + NEW.implementasi + NEW.kesimpulan + NEW.kemampuan_mengemukakan_substansi INTO total;
INSERT INTO log_penambahan_nilai_seminar_hasils (nim, nip, abstrak, pendahuluan, landasan_teori, metodologi, implementasi, kesimpulan, kemampuan_mengemukakan_substansi, total_nilai) VALUES (NEW.nim, NEW.nip, NEW.abstrak, NEW.pendahuluan, NEW.landasan_teori, NEW.metodologi, NEW.implementasi, NEW.kesimpulan, NEW.kemampuan_mengemukakan_substansi, total);
END $$
DELIMITER ;

-- trigger log pengubahan nilai seminar hasil
-- nim, nip, abstrak, pendahuluan, rumusan_masalah, landasan_teori, metodologi, implementasi, kesimpulan, kemampuan_mengemukakan_substansi
DELIMITER $$
CREATE OR REPLACE TRIGGER log_pengubahan_nilai_seminar_hasil AFTER UPDATE ON nilai_seminar_hasils FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.abstrak + NEW.pendahuluan + NEW.landasan_teori + NEW.metodologi + NEW.implementasi + NEW.kesimpulan + NEW.kemampuan_mengemukakan_substansi INTO total;
INSERT INTO log_pengubahan_nilai_seminar_hasils (nim, nip, abstrak, pendahuluan, landasan_teori, metodologi, implementasi, kesimpulan, kemampuan_mengemukakan_substansi, total_nilai) VALUES (NEW.nim, NEW.nip, NEW.abstrak, NEW.pendahuluan, NEW.landasan_teori, NEW.metodologi, NEW.implementasi, NEW.kesimpulan, NEW.kemampuan_mengemukakan_substansi, total);
END $$
DELIMITER ;

-- trigger log penambahan nilai sidang 
-- nim, nip, sistematika_penulisan, substansi, kemampuan menguasai substansi, kemampuan mengemukakan pendapat,total
DELIMITER $$
CREATE OR REPLACE TRIGGER log_penambahan_nilai_sidang AFTER INSERT ON nilai_sidang_meja_hijaus FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.sistematika_penulisan + NEW.substansi + NEW.kemampuan_menguasai_substansi + NEW.kemampuan_mengemukakan_pendapat INTO total;
INSERT INTO log_penambahan_nilai_sidangs (nim, nip, sistematika_penulisan, substansi, kemampuan_menguasai_substansi, kemampuan_mengemukakan_pendapat, total_nilai) VALUES (NEW.nim, NEW.nip, NEW.sistematika_penulisan, NEW.substansi, NEW.kemampuan_menguasai_substansi, NEW.kemampuan_mengemukakan_pendapat, total);
END $$
DELIMITER ;

-- trigger log pengubahan nilai sidang
-- nim, nip, sistematika_penulisan, substansi, kemampuan mengemukakan substansi, kemampuan mengemukakan pendapat,total
DELIMITER $$
CREATE OR REPLACE TRIGGER log_pengubahan_nilai_sidang AFTER UPDATE ON nilai_sidang_meja_hijaus FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.sistematika_penulisan + NEW.substansi + NEW.kemampuan_menguasai_substansi + NEW.kemampuan_mengemukakan_pendapat INTO total;
INSERT INTO log_pengubahan_nilai_sidangs (nim, nip, sistematika_penulisan, substansi, kemampuan_menguasai_substansi, kemampuan_mengemukakan_pendapat, total_nilai) VALUES (NEW.nim, NEW.nip, NEW.sistematika_penulisan, NEW.substansi, NEW.kemampuan_menguasai_substansi, NEW.kemampuan_mengemukakan_pendapat, total);
END $$
DELIMITER ;


CREATE TABLE log_dosen_pembimbing (
    id int(11) NOT NULL AUTO_INCREMENT,
    log TEXT NOT NULL,
    status VARCHAR(50)
);

CREATE TABLE log_nilai (
    id int(11) NOT NULL AUTO_INCREMENT,
    log TEXT NOT NULL
);

-- buat trigger log dalam bentuk catatan/ kalimat
-- nim, nip, abstrak, pendahuluan, rumusan_masalah, landasan_teori, metodologi, implementasi, kesimpulan, kemampuan_mengemukakan_substansi
DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_seminar_proposal AFTER INSERT ON nilai_seminar_proposals FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.abstrak + NEW.pendahuluan + NEW.rumusan_masalah + NEW.landasan_teori + NEW.metodologi + NEW.implementasi + NEW.kesimpulan + NEW.kemampuan_mengemukakan_substansi INTO total;
INSERT INTO log_nilai (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Seminar Proposal Abstrak ', NEW.abstrak, ' Pendahuluan ', NEW.pendahuluan, ' Rumusan Masalah ', NEW.rumusan_masalah, ' Landasan Teori ', NEW.landasan_teori, ' Metodologi ', NEW.metodologi, ' Implementasi ', NEW.implementasi, ' Kesimpulan ', NEW.kesimpulan, ' Kemampuan Mengemukakan Substansi ', NEW.kemampuan_mengemukakan_substansi, ' Total Nilai ', total), 'insert');
END $$
DELIMITER ;

-- trigger log nilai seminar hasil
CREATE TABLE log_nilai_seminar_hasil (
    id int(11) NOT NULL AUTO_INCREMENT,
    log TEXT NOT NULL,
    status VARCHAR(50),
    PRIMARY KEY (id)
);
-- nim, nip, abstrak, pendahuluan, rumusan_masalah, landasan_teori, metodologi, implementasi, kesimpulan, kemampuan_mengemukakan_substansi
DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_seminar_hasil_insert AFTER INSERT ON nilai_seminar_hasils FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.abstrak + NEW.pendahuluan + NEW.landasan_teori + NEW.metodologi + NEW.implementasi + NEW.kesimpulan + NEW.kemampuan_mengemukakan_substansi INTO total;
INSERT INTO log_nilai_seminar_hasil (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Seminar Hasil Abstrak ', NEW.abstrak, ' Pendahuluan ', NEW.pendahuluan, ' Landasan Teori ', NEW.landasan_teori, ' Metodologi ', NEW.metodologi, ' Implementasi ', NEW.implementasi, ' Kesimpulan ', NEW.kesimpulan, ' Kemampuan Mengemukakan Substansi ', NEW.kemampuan_mengemukakan_substansi, ' Total Nilai ', total), 'insert');
END $$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_seminar_hasil_update AFTER UPDATE ON nilai_seminar_hasils FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.abstrak + NEW.pendahuluan + NEW.landasan_teori + NEW.metodologi + NEW.implementasi + NEW.kesimpulan + NEW.kemampuan_mengemukakan_substansi INTO total;
INSERT INTO log_nilai_seminar_hasil (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Seminar Hasil Abstrak ', NEW.abstrak, ' Pendahuluan ', NEW.pendahuluan, ' Landasan Teori ', NEW.landasan_teori, ' Metodologi ', NEW.metodologi, ' Implementasi ', NEW.implementasi, ' Kesimpulan ', NEW.kesimpulan, ' Kemampuan Mengemukakan Substansi ', NEW.kemampuan_mengemukakan_substansi, ' Total Nilai ', total), 'update');
END $$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_seminar_hasil_delete AFTER DELETE ON nilai_seminar_hasils FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT OLD.abstrak + OLD.pendahuluan + OLD.landasan_teori + OLD.metodologi + OLD.implementasi + OLD.kesimpulan + OLD.kemampuan_mengemukakan_substansi INTO total;
INSERT INTO log_nilai_seminar_hasil (log, status) VALUES (CONCAT('NIM ', OLD.nim, ' NIP ', OLD.nip, ' Nilai Seminar Hasil Abstrak ', OLD.abstrak, ' Pendahuluan ', OLD.pendahuluan, ' Landasan Teori ', OLD.landasan_teori, ' Metodologi ', OLD.metodologi, ' Implementasi ', OLD.implementasi, ' Kesimpulan ', OLD.kesimpulan, ' Kemampuan Mengemukakan Substansi ', OLD.kemampuan_mengemukakan_substansi, ' Total Nilai ', total), 'delete');
END $$
DELIMITER ;

-- trigger log nilai sidang
CREATE TABLE log_nilai_sidang (
    id int(11) NOT NULL AUTO_INCREMENT,
    log TEXT NOT NULL,
    status VARCHAR(50),
    PRIMARY KEY (id)
);
-- nim, nip, sistematika_penulisan, substansi, kemampuan mengemukakan substansi, kemampuan mengemukakan pendapat,total
DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_sidang_insert AFTER INSERT ON nilai_sidang_meja_hijaus FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.sistematika_penulisan + NEW.substansi + NEW.kemampuan_menguasai_substansi + NEW.kemampuan_mengemukakan_pendapat INTO total;
INSERT INTO log_nilai_sidang (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Sidang Sistematika Penulis ', NEW.sistematika_penulisan, ' Substansi ', NEW.substansi, ' Kemampuan Menguasai Substansi ', NEW.kemampuan_menguasai_substansi, ' Kemampuan Mengemukakan Pendapat ', NEW.kemampuan_mengemukakan_pendapat, ' Total Nilai ', total), 'insert');
END $$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_sidang_update AFTER UPDATE ON nilai_sidang_meja_hijaus FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.sistematika_penulisan + NEW.substansi + NEW.kemampuan_menguasai_substansi + NEW.kemampuan_mengemukakan_pendapat INTO total;
INSERT INTO log_nilai_sidang (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Sidang Sistematika Penulis ', NEW.sistematika_penulisan, ' Substansi ', NEW.substansi, ' Kemampuan Menguasai Substansi ', NEW.kemampuan_menguasai_substansi, ' Kemampuan Mengemukakan Pendapat ', NEW.kemampuan_mengemukakan_pendapat, ' Total Nilai ', total), 'update');
END $$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_sidang_delete AFTER DELETE ON nilai_sidang_meja_hijaus FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT OLD.sistematika_penulisan + OLD.substansi + OLD.kemampuan_menguasai_substansi + OLD.kemampuan_mengemukakan_pendapat INTO total;
INSERT INTO log_nilai_sidang (log, status) VALUES (CONCAT('NIM ', OLD.nim, ' NIP ', OLD.nip, ' Nilai Sidang Sistematika Penulis ', OLD.sistematika_penulisan, ' Substansi ', OLD.substansi, ' Kempuan Menguasai Substansi ', OLD.kemampuan_menguasai_substansi, ' Kemampuan Mengemukakan Pendapat ', OLD.kemampuan_mengemukakan_pendapat, ' Total Nilai ', total), 'delete');
END $$
DELIMITER ;


--log nilai uji program
CREATE TABLE log_nilai_uji_program (
    id int(11) NOT NULL AUTO_INCREMENT,
    log TEXT NOT NULL,
    status VARCHAR(50),
    PRIMARY KEY (id)
);

--nim, nip, nilai_kemampuan_dasar_program, nilai_kecocokan_algoritma, nilai_penguasaan_program, nilai_penguasaan_ui, nilai_validasi_output
DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_uji_program_insert AFTER INSERT ON nilai_uji_programs FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.nilai_kemampuan_dasar_program + NEW.nilai_kecocokan_algoritma + NEW.nilai_penguasaan_program + NEW.nilai_penguasaan_ui + NEW.nilai_validasi_output INTO total;
INSERT INTO log_nilai_uji_program (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Uji Program Kemampuan Dasar Program ', NEW.nilai_kemampuan_dasar_program, ' Kecocokan Algoritma ', NEW.nilai_kecocokan_algoritma, ' Penguasaan Program ', NEW.nilai_penguasaan_program, ' Penguasaan UI ', NEW.nilai_penguasaan_ui, ' Validasi Output ', NEW.nilai_validasi_output, ' Total Nilai ', total), 'insert');
END $$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_uji_program_update AFTER UPDATE ON nilai_uji_programs FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT NEW.nilai_kemampuan_dasar_program + NEW.nilai_kecocokan_algoritma + NEW.nilai_penguasaan_program + NEW.nilai_penguasaan_ui + NEW.nilai_validasi_output INTO total;
INSERT INTO log_nilai_uji_program (log, status) VALUES (CONCAT('NIM ', NEW.nim, ' NIP ', NEW.nip, ' Nilai Uji Program Kemampuan Dasar Program ', NEW.nilai_kemampuan_dasar_program, ' Kecocokan Algoritma ', NEW.nilai_kecocokan_algoritma, ' Penguasaan Program ', NEW.nilai_penguasaan_program, ' Penguasaan UI ', NEW.nilai_penguasaan_ui, ' Validasi Output ', NEW.nilai_validasi_output, ' Total Nilai ', total), 'update');
END $$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER log_nilai_uji_program_delete AFTER DELETE ON nilai_uji_programs FOR EACH ROW
BEGIN
DECLARE total FLOAT(5,2);
SELECT OLD.nilai_kemampuan_dasar_program + OLD.nilai_kecocokan_algoritma + OLD.nilai_penguasaan_program + OLD.nilai_penguasaan_ui + OLD.nilai_validasi_output INTO total;
INSERT INTO log_nilai_uji_program (log, status) VALUES (CONCAT('NIM ', OLD.nim, ' NIP ', OLD.nip, ' Nilai Uji Program Kemampuan Dasar Program ', OLD.nilai_kemampuan_dasar_program, ' Kecocokan Algoritma ', OLD.nilai_kecocokan_algoritma, ' Penguasaan Program ', OLD.nilai_penguasaan_program, ' Penguasaan UI ', OLD.nilai_penguasaan_ui, ' Validasi Output ', OLD.nilai_validasi_output, ' Total Nilai ', total), 'delete');
END $$
DELIMITER ;

-- log skripsi
CREATE TABLE log_skripsi (
    id int(11) NOT NULL AUTO_INCREMENT,
    log TEXT NOT NULL,
    status VARCHAR(50),
    PRIMARY KEY (id)
);

--nim, nip, judul, tanggal_sidang, nilai_sidang, nilai_uji_program, nilai_akhir


