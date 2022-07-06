<?php $id = get_cookie('xau'); ?>
<!doctype html>
<html lang="en">
<head>
	<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>build/images/logo2.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url('build/css/css/bootstraps.css')?>"/>
	<link href="<?php echo base_url('build/css/css/style_view.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('build/css/css/paper.css') ?>" rel="stylesheet" type="text/css" />
	<style>@page {size: A4 portrait}</style>
	<style type="text/css">

				hr.thin {
				height: 1px;
				border: 0;
				color: #333;
				background-color: #333;
				width: 100%;
				}

	</style>
</head>

<body>

	<div id="printableArea">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="testTable">
  <tbody>
    <tr>
      <td width="3%">&nbsp;</td>
      <td width="95%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      <div class="container">
		<table width="30%" border="0" cellspacing="1" cellpadding="1">
		<tbody>

					<tr>
					<td width="6%" rowspan="5"><img src="<?php echo base_url(); ?>build/images/logobesar.png" width="120" height="133" alt=""/></td>
					<td colspan="3"><h2><?= $this->session->userdata('nama_perusahaan'.$id)?></h2></td>
					</tr>
					<tr>
					<td colspan="3"> <?= $this->session->userdata('alamat_perusahaan'.$id)?> </td>
					</tr>

					<tr>
					<td>Telepon</td>
					<td width="1%">:</td>
					<td width="89%"><?= $this->session->userdata('telepon_perusahaan'.$id)?></td>
					</tr>
					<tr>
					<td>Email</td>
					<td>:</td>
					<td><?= $this->session->userdata('email_perusahaan'.$id)?></td>
					</tr>
		</tbody>
		</table>

<hr style="height:0px;border:0.5px solid black;"/>
	    <div align="center">
	        <h3 style="border: 0px solid #333;">REKAP DETAIL FIELD BONUS<br>
	          Periode : <?php echo format_tanggal($xtglawal); ?> s/d <?php echo format_tanggal($xtglakhir); ?> </h3>

	        <table border="0" width="100%" cellspacing="0" cellpadding="0"
						style="border-collapse:collapse; ">

	            <tr>
	              <th colspan="7"><hr style="height:0px;border:0.5px solid black;"/></th>
	              <th>&nbsp;</th>
              </tr>
	            <tr>
	                <th>NO BUKTI</th>
	                <th>PERJADIN</th>
                  <th>NIK</th>
	                <th>NAMA KARYAWAN</th>
	                <th>BONUS</th>
	                <th>HARI</th>
	                <th>TOTAL BONUS</th>
					        <th>&nbsp;</th>
              </tr>

	             <tr>
	              <td colspan="7"><hr style="height:0px;border:0.5px solid black;"/></td>
	              <td align="left">&nbsp;</td>
                </tr>

	            <?php
	            $noxz = 1;
				$grandtotal=0;
				//$total_hari=0;
	            foreach($dt_unit_x_l1 as $dt){
              $tgl_perjadin = $dt['tgl_perjadin'];
	            ?>
                <tr valign="middle" class="td_only" style="font-weight:bold; color:rgb(0,0,0); background:#D3D1D1">
															<td colspan="7" valign="middle" align="left" style="width:100%; font-weight:bold; height:25px">
																<?php echo format_tanggal($dt['tgl_perjadin']); ?>
															</td>
														</tr>

														<?php
														//looping ke 2
														$total_hari=0;
														foreach ($dt['dt_unit_x_l0'] as $dt_l0){
															//declare 2-1
															$no_bukti = $dt_l0['no_fb'];
															$no_bukti_x = $dt_l0['no_fb'];
															$no_bukti_x = substr($no_bukti_x,0,3);
															//echo '<br> no_bukti : '.$no_bukti;

															$total_d = 0;
															$total_k = 0;
															?>

															<?php
															$get_query_l3 = $this->CI->foreach_level3($no_bukti);
															//print_r($get_query_l3);
															?>

															<?php
															//looping ke 3

															foreach ($get_query_l3 as $dt_l3){
																//declare 2-1
																$total_d = $total_d + $dt_l3['total'];
																$total_hari=$total_hari + $dt_l3['total'];
																//$total_k = $total_k + $dt_l3['jml_K'];

																$no_bukti_x = $dt_l3['no_fb'];
																$no_bukti_x = substr($no_bukti_x,0,3);

																?>

																<tr class="td_only">
																	<td>&nbsp;&nbsp;<?php	echo  $dt_l3['no_fb'];?></td>
																	<td><?php	echo  $dt_l3['nama_perjadin'];?></td>
																	<td>&nbsp;&nbsp;<?php	echo  $dt_l3['id_pegawai'];?></td>
																	<td> &nbsp;&nbsp;<?php echo  $dt_l3['nama_pegawai']; ?> </td>
																	<td align="right"><?php echo  number_format($dt_l3['nilai_bonus']); ?> &nbsp;&nbsp;</td>
																	<td align="center"><?php echo number_format($dt_l3['jml_hari']); ?></td>
																	<td align="right"> <?php echo number_format($dt_l3['total']); ?>&nbsp;&nbsp;</td>

																</tr>

																<?php

																		}

																		?>

															<tr class="td_only">
																<td colspan="6" align="right" style="font-weight:bold">Total Per Bukti&nbsp;&nbsp;</td>
																<td align="right" style="font-weight:bold"><?php echo  number_format($total_d); ?>&nbsp;&nbsp;</td>

															</tr>

															<?php
$grandtotal=$grandtotal+$total_d;
														}

														?>
<tr class="td_only">
																<td colspan="6" align="right" style="font-weight:bold">Total Per Hari&nbsp;&nbsp;</td>
																<td align="right" style="font-weight:bold"><?php echo  number_format($total_hari); ?>&nbsp;&nbsp;</td>

															</tr>

	            <?php

				 }

	            ?>
                <br>
                <tr>
                  <td colspan="8"><hr style="height:0px;border:0.5px solid black;"/></td>
                </tr>
                <tr>
	              <td colspan="6" align="right" style="font-weight:bold">Grand Total&nbsp;&nbsp;</td>
                  <td align="right" style="font-weight:bold"> <?php  echo number_format($grandtotal);?> &nbsp;&nbsp;</td>
				  <td align="left">&nbsp;</td>

	              </tr>

	        </table>

	    </div>






	    <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.printPage.js')?>"></script>
	    <script type="text/javascript">
	        $(document).ready(function(){
	            $(".btnPrint").printPage();
	        })
	    </script>

	</div>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</div>

<script>
		function printDiva(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			w = window.open();
			w.document.write('<title><?= $this->session->userdata('nama_perusahaan'.$id)?></title>');
			w.document.write('<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url(); ?>build/images/logo.png" />');
			w.document.write('<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> ');
			w.document.write('<link href="<?=base_url('/')?>build/css/css/bootstraps.css" rel="stylesheet" />');
			w.document.write('<link href="<?=base_url('/')?>build/css/css/style_view.css" rel="stylesheet" type="text/css" />');
			w.document.write('<link href="<?=base_url('/')?>build/css/css/paper.css" rel="stylesheet" type="text/css" />');
			w.document.write('<style>@page { size: A4 portrait }</style>');
			w.document.write('<style>* {color: black;} .td_only td, .td_only th {border: 1px solid black; border-collapse: collapse;}</style>');
			w.document.write(printContents);
			w.document.write('window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
			w.document.close(); //necessary for IE >= 10
			w.focus(); //necessary for IE >= 10

			return true;
		}
		function printDiv(divName) {
				 var printContents = document.getElementById(divName).innerHTML;
				 var originalContents = document.body.innerHTML;
				 document.body.innerHTML = printContents;
				 window.print();
				 document.body.innerHTML = originalContents;
		}
		</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center">
      <div style="float:inherit;">
                  <!-- Print -->
                  <button type="button" class="btn btn-danger"
                    onclick="printDiv('printableArea');">
                    Print
                  </button>

                  <?php
                  $nama_excel_as = 'Rekap Detail FB';
                  ?>

                  <input type="text" value="<?php echo $nama_excel_as; ?>" id="nama_excel_as" hidden />

                  <!-- Export Excel -->
                  <!-- start tambahan untuk excel -->
                  <script data-require="jquery" data-semver="2.2.0" src="<?=base_url('/')?>build/source_ant/js/jquery.min.js"></script>
                  <script type="text/javascript" src="<?=base_url('/')?>build/source_ant/js/export-excel.jquery.min"></script>

									<script type="text/javascript">
										var jq_excel = $.noConflict(true);
										jq_excel(function() {
										  jq_excel('#btnExport').click(function() {
											var table=document.getElementById('testTable').innerHTML;
											var table1="<html><head><style> table, td {border:thin solid black} table {border-collapse:collapse}</style></head><body><table>"+table+"</table></body></html>";
											var myBlob = new Blob([table1], {
											  type: 'application/vnd.ms-excel'
											});
											var url = window.URL.createObjectURL(myBlob);
											var a = document.createElement("a");
											document.body.appendChild(a);
											a.href = url;
											var nama_excel_ex = document.getElementById('nama_excel_as').value;
											a.download = nama_excel_ex + ".xls";
											a.click();
											//adding some delay in removing the dynamically created link solved the problem in FireFox
											setTimeout(function() {
											  window.URL.revokeObjectURL(url);
											}, 0);
										  })
										})
									  </script>

                  <button type="button" id="btnExport">
                    Export to Excel
                  </button>
                </div>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>
