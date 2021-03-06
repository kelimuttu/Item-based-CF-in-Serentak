@extends('layouts.main_layout')

@section('content')
		<!-- <div class="fixed">  -->
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						{{HTML::image('assets/img/logo.png', 'Serentak', array('class'=>'logo'))}}
					</li>
				</ul>
			</nav> 
		<!-- </div> -->

		<div class="row">
			<div class="large-12 columns">
				<h1 class="text-center">Hai John Doe, mari ceritakan sedikit tentang dirimu..</h1>
				<div class="signup-form">
					{{Form::open(array('method'=>'post', 'url'=>'form1', 'class'=>'custom'))}}
						<div class="row collapse">
							<div class="small-2 columns">
								<label>Jenis kelamin : </label>
							</div>
							<div class="small-10  columns">
								<input type="radio" name="jk" value="0" id="male"><label for="male">Laki-laki</label>
								<input type="radio" name="jk" value="1" id="female"><label for="female">Perempuan</label>
							</div>
						</div>
						<div class="row collapse">
							<div class="small-2 columns">
								<label>Tanggal lahir : </label>
							</div>
							<div class="small-10  columns">
								<input class="formInput" type="text" name="birthday" placeholder="Tanggal lahir">
							</div>
						</div>
						<div class="row collapse">
							<div class="small-2 columns">
								<label>Alamat : </label>
							</div>
							<div class="small-10  columns">
								<input class="formInput" type="text" name="alamat" placeholder="Alamat">
							</div>
						</div>
						<div class="row collapse">
							<div class="small-2 columns">
								<label>Kecamatan : </label>
							</div>
							<div class="small-10  columns">
								<select name="kecamatan"> <!-- this should be check point -->
					                <option value="0">Banyumanik</option>
					                <option value="1">Candisari</option>
					                <option value="2">Gajahmungkur</option>
					                <option value="3">Gayamsari</option>
					                <option value="4">Genuk</option>
					                <option value="5">Gunungpati</option>
					                <option value="6">Mijen</option>
					                <option value="7">Ngaliyan</option>
					                <option value="8">Pedurungan</option>
					                <option value="9">Semarang Barat</option>
					                <option value="10">Semarang Selatan</option>
					                <option value="11">Semarang Tengah</option>
					                <option value="12">Semarang Timur</option>
					                <option value="13">Semarang Utara</option>
					                <option value="14">Tembalang</option>
					                <option value="15">Tugu</option>
					            </select>
							</div>
						</div>
						<div class="row collapse">
							<div class="small-2 columns">
								<label>Minat : </label>
							</div>
							<div class="small-10  columns">
								<input id="checkbox1" type="checkbox"><label for="checkbox1">Pendidikan</label>
								<input id="checkbox2" type="checkbox"><label for="checkbox2">Lingkungan</label>
								<input id="checkbox3" type="checkbox"><label for="checkbox3">Kepemudaan</label>
								<input id="checkbox4" type="checkbox"><label for="checkbox4">Teknologi</label>
								<input id="checkbox5" type="checkbox"><label for="checkbox5">Seni dan Budaya</label>
							</div>
						</div>
						<button type="submit" class="fancy radius button right">Lanjutkan</button>
					{{Form::close()}}
				</div>
			</div>
		</div>

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>
@stop