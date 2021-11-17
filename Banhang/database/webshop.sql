CREATE TABLE IF NOT EXISTS AccountKH(
 	TK varchar(30) PRIMARY KEY,
    MK varchar(16) not null
)ENGINE=INNODB;
CREATE TABLE IF NOT EXISTS AccountNV(
    TKhoan varchar(16) primary key,
    MKhau varchar(16) not null
)ENGINE=INNODB;
CREATE table if not EXISTS khachhang(
	MSKH varchar(50) PRIMARY KEY,
    TK varchar(30) REFERENCES AcountKH(TK),
    HoTenKH varchar(255) not null,
    DiaChi varchar(255) not null,
    SoDienThoai varchar(11) not null,
    SoFax varchar(30) 
)ENGINE=INNODB;


CREATE TABLE IF NOT EXISTS DiaChiKH
(
 	MaDC varchar(30) PRIMARY KEY,
    DiaChi VARCHAR(255) NOT NULL,
    MSKH varchar(50),
    FOREIGN KEY(mskh) REFERENCES KHACHHANG(MSKH)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS NhanVien(
    MSNV varchar(50) PRIMARY KEY,
    HoTenNV VARCHAR(255) NOT NULL,
    ChucVu VARCHAR(255) NOT NULL,
    DiaChi varchar(255) not null,
    SoDienThoai varchar(11) not null
)ENGINE=INNODB; 



 
CREATE TABLE IF NOT EXISTS HangHoa(
    MSHH varchar(50) PRIMARY KEY,
    TenHH VARCHAR(255) NOT NULL,
    QuyCach text NOT NULL,
    Gia DECIMAL(10,0) not null check(Gia>=1),
    SoLuongHang INT not null check(SoLuongHang>=0),
    MaLoaiHang varchar(10) not null,
    FOREIGN KEY(maloaihang) REFERENCES LoaiHangHoa(MaLoaiHang)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS HINHHANGHOA(
  	MaHinh varchar(30) PRIMARY KEY,
    TenHinh varchar(100) not null,
    MSHH varchar(50) not null,
    FOREIGN KEY(mshh) REFERENCES HangHoa(MSHH)
)ENGINE=INNODB;


CREATE TABLE IF NOT EXISTS Size(
	MaSize int AUTO_INCREMENT PRIMARY KEY,
	TenSize varchar(5) not null,
	Soluong int not null check(SoLuong=0),
	MSHH varchar(50) REFERENCES HangHoa(MSHH)
)ENGINE=INNODB;
CREATE TABLE IF NOT EXISTS Rating(
	Id_rating int AUTO_INCREMENT PRIMARY KEY,
	MSHH varchar(50) REFERENCES HangHoa(MSHH),
	DiemDanhGia int check(DiemDanhGia<=5 and DiemDanhGia >=0)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS FeedBack(
	Id_feedback varchar(50) primary key,
	MSKH varchar(50) REFERENCES KHACHHANG(MSKH) ,
	MSHH varchar(50) REFERENCES HangHoa(MSHH),
	NgayFB date DEFAULT CURRENT_DATE() not null,
	Noidung varchar(500)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS HinhAnhFeedBack(
	Id_mahinh varchar(30) primary key,
	Id_feedback varchar(50) REFERENCES FeedBack(Id_feedback)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS DatHang(
    SoDonDH varchar(50) PRIMARY KEY,
    MSKH varchar(50) not null REFERENCES KhachHang(MSKH),
    MSNV varchar(50) null REFERENCES NhanVien(MSNV),
    NgayDH date default CURRENT_DATE() not null,
    NgayGH Date default CURRENT_DATE() not null CHECK(NgayGH>NgayDH),
    TrangThaiDH boolean not null
)ENGINE=INNODB;
CREATE TABLE IF NOT EXISTS ChiTietDatHang(
    SoDonDH varchar(50) REFERENCES DatHang(SoDonDH),
    MSHH varchar(50) REFERENCES HangHoa(MSHH),
    SoLuong INT not null,
    GiaDatHang DECIMAL(10,0) not null,
    GiamGia int  null,
    PRIMARY KEY(SoDonDH,MSHH)
    
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS GioHang(
	MSKH varchar(50) REFERENCES KhachHang(MSKH),
	MSHH varchar(50) REFERENCES HangHoa(MSHH),
    PRIMARY KEY(MSKH,MSHH)
)ENGINE=INNODB;

alter table nhanvien
add COLUMN TKhoan varchar(16) REFERENCES accountnv(TKhoan);

alter table chitietdathang
add COLUMN SoDienThoai int(11) not null;
alter TABLE chitietdathang
add MaDC varchar(50) not null REFERENCES diachikh(MaDC);

alter table khachhang
add COLUMN TenCongTy varchar(100) null;

alter table khachhang
add COLUMN Avatar varchar(255) null;

INSERT into accountnv VALUES('admin','admin');
insert INTO nhanvien values('NV001','Nguyễn Hoài Tân','Administrator','Can Tho','0379586235','admin');


-- insert into khachhang
insert into AccountKH values('hoaitan0','10102000');
insert into accountkh values('hoaitan4','10102000');
insert into accountkh values('hoaitan1','10102000');
insert into accountkh values('hoaitan2','10102000');
insert into accountkh values('hoaitan3','10102000');

INSERT INTO KHACHHANG(MSKH,TK,HoTenKH,SoDienThoai) VALUES('MSKHTest-123456','hoaitan0','Nguyễn Hoài Tân','0379586235');
INSERT INTO KHACHHANG(MSKH,TK,HoTenKH,SoDienThoai) VALUES('MSKHTest-123457','hoaitan1','Nguyễn Hoài Tân','0379586235');
INSERT INTO KHACHHANG(MSKH,TK,HoTenKH,SoDienThoai) VALUES('MSKHTest-123458','hoaitan2','Trần Thị Cẩm Hương','0379586235');
INSERT INTO KHACHHANG(MSKH,TK,HoTenKH,SoDienThoai) VALUES('MSKHTest-123459','hoaitan3','Nguyễn Văn Hiếu','0379586235');
INSERT INTO KHACHHANG(MSKH,TK,HoTenKH,SoDienThoai) VALUES('MSKHTest-1234510','hoaitan4','Nguyễn Văn A','0379586235');



