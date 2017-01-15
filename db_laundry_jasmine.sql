CREATE TABLE IF NOT EXISTS login (
  login_id int(11) PRIMARY KEY AUTO_INCREMENT,
  login_username varchar(31) UNIQUE NOT NULL,
  login_password varchar(51) NOT NULL,
  login_role enum('admin', 'agen') NOT NULL 
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admin (
  admin_id int(11) PRIMARY KEY,
  admin_nama varchar(31) NOT NULL,
  
  CONSTRAINT fk_admin_login FOREIGN KEY (admin_id) REFERENCES login(login_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS agen (
  agen_id int(11) PRIMARY KEY,
  agen_nama varchar(31) NOT NULL,
  agen_deleted enum('true', 'false') NOT NULL DEFAULT 'false',

  CONSTRAINT fk_agen_login FOREIGN KEY (agen_id) REFERENCES login(login_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS jeniscucian (
  jeniscucian_id int(11) PRIMARY KEY AUTO_INCREMENT,
  jeniscucian_nama varchar(31) NOT NULL,
  jeniscucian_harga int(11) NOT NULL,
  jeniscucian_deleted enum('true', 'false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pelanggan (
  pelanggan_id int(11) PRIMARY KEY AUTO_INCREMENT,
  pelanggan_nama varchar(31) NOT NULL,
  pelanggan_alamat varchar(101) NOT NULL,
  pelanggan_notelp varchar(13) NOT NULL,
  pelanggan_deleted enum('true', 'false') DEFAULT 'false',
  agen_id int(11) NOT NULL,

  CONSTRAINT fk_pelanggan_agen FOREIGN KEY (agen_id) REFERENCES agen(agen_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS transaksi (
  nota_id int(11) PRIMARY KEY AUTO_INCREMENT,
  nota_tgl_masuk date NOT NULL,
  nota_tgl_selesai date NOT NULL,
  nota_status enum('Sudah Bayar', 'Belum Bayar') NOT NULL DEFAULT 'Belum Bayar',
  nota_deleted enum('true', 'false') NOT NULL DEFAULT 'false',
  pelanggan_id int(11) NOT NULL,

  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(pelanggan_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS nota_jeniscucian (
  nota_jeniscucian_id int(11) PRIMARY KEY AUTO_INCREMENT,
  nota_jeniscucian_jumlah smallint(6) NOT NULL,
  nota_jeniscucian_subtotal int(11) NOT NULL,
  nota_id int(11) NOT NULL,
  jeniscucian_id int(11) NOT NULL,
  
  CONSTRAINT fk_nota_jeniscucian_nota FOREIGN KEY (nota_id) REFERENCES transaksi(nota_id) ON DELETE CASCADE ON UPDATE CASCADE, 
  CONSTRAINT fk_nota_jeniscucian_jeniscucian FOREIGN KEY (jeniscucian_id) REFERENCES jeniscucian(jeniscucian_id) ON DELETE CASCADE ON UPDATE CASCADE 
) ENGINE=InnoDB;

DELIMITER //
	CREATE TRIGGER check_role_admin BEFORE INSERT ON admin FOR EACH ROW
	BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.admin_id) != 'admin' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END;//
DELIMITER ;

DELIMITER //
	CREATE TRIGGER check_role_agen BEFORE INSERT ON agen FOR EACH ROW
	BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.agen_id) != 'agen' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END;//
DELIMITER ;