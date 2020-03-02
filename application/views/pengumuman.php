	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Rekrutment PT LTI</title>
	</head>
	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }
		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footerbox {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}
	</style>
	<script>
		$(document).ready(function(){
			$('#submitForm').click(function(){
				$.ajax({
					url: '<?= base_url(); ?>pendaftaran/test_email',
					type: "POST",
					dataType: "json",
					success: function (result) {
						if (result.status == true) {
							//window.location = '<?= base_url(); ?>/pendaftaran/success';
							//$.redirect('<?= base_url(); ?>pendaftaran/success', {'data': result.dataPelamar});
							console.log(result.errorList);
							//messageShow("success", "<li>" + result.errorList + "</li>");
						} else if (result.status == false) {
							messageShow("error", "<li>" + result.errorList + "</li>");
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr);
						messageShow("error","<li>Error</li>");
						if (xhr.status == '401') {
							// window.location = '<?= base_url(); ?>';
						}
					}
				});
			});
		});
	</script>
	<div id="container">
		<h1>Selamat Datang di halaman Rekrutmen PT. Len Telekomunikasi Indonesia</h1>

<h6 style="text-align: center;"><strong>- PKWT (PEKERJA WAKTU TERTENTU) -</strong></h6>
<ol>
    <li><strong>Pemasaran</strong><br>
        Sales executive bertanggung jawab atas end-to-end proses penjualan dari prospek calon pelanggan, closing deal,
        kontrak
        sampai memastikan proses penagihan berjalan dan mendapatkan revenue</li>
</ol>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><strong><u>Deskripsi Pekerjaan:</u></strong><br />
                <ol>
                    <li>Melakukan penjualan sesuai target yang telah di tetapkan</li>
                    <li>Membuat laporan dan presentasi progres penjualan mingguan dan bulanan</li>
                    <li>Membuat hubungan baik dengan pelanggan dan senantiasa memastikan kepuasan pelanggan atas layanan
                    </li>
                    <li>Membuat Laporan Biaya pengeluaran untuk aktifitas sales dan marketing</li>
                    <li>Berkoordinasi dengan tim internal atau eksternal untuk aktivasi layanan baru dengan pelanggan
                    </li>
                    <li>Berperilaku positif dan aktif untuk mencapai target pendapatan</li>
                    <li>Bertanggung jawab atas tagihan ke stakeholders</li>
                    <li>memberikan masukan untuk continous improvement</li>
                </ol>
            </li>
            <li><strong>Kualifikasi :</strong></li>
            <ol>
                <li>Umur Maximal 35 Tahun</li>
                <li>Pendidikan Minimal S1 Manajemen/ Pemasaran/ Ekonomi/ Komunikasi/ Bisnis/ Teknik</li>
                <li>Pengalaman 1-2 tahun dibidang telekomunikasi sebagai Sales</li>
                <li>Berpengalaman di bidang Penjualan, pemasaran dan manajemen</li>
                <li>Bisa berkomunikasi dan negosiasi dengan baik</li>
                <li>Memiliki pengetahuan di bidang telekomunikasi</li>
            </ol>
        </ul>
    </li>
</ul>
<hr />
<br>
<ol start="2">
    <li><strong>Telekomunikasi</strong><br>
        Staf SLA memiliki tanggung jawab atas terdelivernya layanan yang disepakati dengan pelanggan dan menjaga
        hubungan baik dengan pelanggan</li>
</ol>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><span style="text-decoration: underline;"><strong>Deskripsi Pekerjaan</strong></span>
                <ol>
                    <li>Membuat Laporan SLA setiap bulan atau dengan waktu yang telah ditetapkan</li>
                    <li>Melakukan rekonsiliasi dan presentasiprogres pencapaian SLA</li>
                    <li>Bertanggung jawab atas ketepatan BA Rekonsiliasi SLA dengan Pelanggan</li>
                    <li>Memastikan layanan terdeliver sesuai yang telah disepakati dan mengerti business outcome atas
                        pelanggan</li>
                    <li>Berkoordinasi dengan tim internal atas keluhan pelanggan yang disampaikan saat rekonsiliasi dan
                        memastikan keluhan tersebut dapat segera diselesaikan</li>
                    <li>Memastikan tools untuk membuat laporan SLA berjalan sesuai dan dapat dipercaya oleh pelanggan
                    </li>
                    <li>Memastikan ketepatan waktu atas tagihan</li>
                    <li>Memberikan masukan untuk continous improvement</li>
                </ol>
            </li>
        </ul>
    </li>
</ul>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><strong>Kualifikasi :</strong><br />
                <ol>
                    <li>Umur Maximal 35 Tahun</li>
                    <li>Pendidikan S1 Teknik Telekomunikasi / Teknik Industri</li>
                    <li>Pengalaman 1-2 tahun di bidang Telekomunikasi</li>
                    <li>Dapat membuat Laporan dengan baik</li>
                    <li>Dapat mengoperasikan office (word, Excel, Presentasi)</li>
                    <li>Bisa berkomunikasi dengan baik</li>
                </ol>
                <hr />
            </li>
        </ul>
    </li>
</ul>
<br>
<ol start="3">
    <li><strong>Administrasi</strong><br>
        Staf Admin memiliki tanggung jawab untuk support operasional dari divisi Bisnis dan Jaminan Jaringan</li>
</ol>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><span style="text-decoration: underline;"><strong>Deskripsi Pekerjaan</strong></span>
                <ol>
                    <li>Membuat rekapitulasi dan laporan biaya pengeluaran divisi BJJ</li>
                    <li>Melakukan organisasi dan arsip semua Dokumen/Surat/Data divisi BJJ</li>
                    <li>Memastikan proses reimburse dari person il BJJ berjalan sesuai SOP perusahaan</li>
                    <li>Melakukan entri data perusahaan</li>
                    <li>Membuat agenda meeting dan memastikan ruangan meeting tersedia</li>
                    <li>Mengelola anggaran biaya rutin bulanan divisi BJJ</li>
                </ol>
            </li>
        </ul>
    </li>
</ul>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><strong>Kualifikasi :</strong><br />
                <ol>
                    <li>Umur Maximal 28 Tahun</li>
                    <li>Pendidikan Minimum D3 Komunikasi/ Ekonomi/ Manajemen</li>
                    <li>Pengalaman 1-2 tahun di bidang admin perusahaan Telekomunikasi</li>
                    <li>Dapat membuat laporan dengan baik</li>
                    <li>Dapat mengoperasikan office (word, excel)</li>
                    <li>Bisa mengorganisasikan file dan dokumen dengan rapi</li>
                </ol>
                <hr />
            </li>
        </ul>
    </li>
</ul>
<br>
<ol start="4">
    <li><strong>Legal Perusahaan</strong><br>
        Legal Komersial memiliki tanggung jawab memastikan legalitas komersil baik dengan pelanggan dan stakeholder
        telah
        memenuhi aturan yang berlaku</li>
</ol>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><span style="text-decoration: underline;"><strong>Deskripsi Pekerjaan</strong></span>
                <ol>
                    <li>Membuat dan memonitor pelaksanaan perjanjian/kontrak</li>
                    <li>Melakukan review perjanjian kontrak baru dan atau yang sedang berjalan</li>
                    <li>Memastikan semua kontrak terkait komersial telah memenuhi aturan berlaku (compliance)</li>
                    <li>Memberikan saran dan pendapat dari sisi legal atas kegiatan komersial</li>
                </ol>
            </li>
        </ul>
    </li>
</ul>
<ul>
    <li style="list-style-type: none;">
        <ul>
            <li><strong>Kualifikasi :</strong><br />
                <ol>
                    <li>Pendidikan S1 Hukum</li>
                    <li>Pengalaman 2 tahun sebagai Legal Perusahaan</li>
                    <li>Mengerti Kontrak, Regulasi, Perizinan,</li>
                    <li>Bisa berkomunikasi dan mempresentasikan dengan baik</li>
                    <li>Memiliki pengetahuan dibidang Legal di Industri Telekomunikasi lebih diutamakan</li>
                </ol>
                <hr />
            </li>
        </ul>
    </li>
</ul>
<p>Apply Now : <a href="http://karir.len-telko.co.id/" target="_blank"
        rel="noopener noreferrer">http://karir.len-telko.co.id/</a></p>
<p>&nbsp;</p>
<p>
    <!-- /wp:html -->
</p>
		<div id="body" align="center" >
			<!-- jika pdf -->
			<!-- <embed class="embed-responsive embed-responsive-16by9" type="application/pdf" src="<?php echo base_url('assets/hisyambsa-karir_periode_2.pdf') ?>" height="1500" > -->
				<!--<img class="img-fluid" src="<?php echo base_url('assets/daftar_rekrutmen.jpg') ?>" alt="daftar_rekrutmen">-->
				
			</div>
			<p class="footerbox">
				<a class="btn btn-primary" style="margin-top:10px; margin-bottom:10px;" href="auth/periode_4">Apply Now</a>
			</p>

		</div>