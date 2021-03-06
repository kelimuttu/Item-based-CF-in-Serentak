@extends('layouts.main_layout')

@section('content')
		<!-- <div class="fixed">  -->
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						{{HTML::image('assets/img/logo.png', 'Serentak', array('class'=>'logo'))}}
					</li>
				</ul>
				<section class="top-bar-section"> 
		        <!-- Right Nav Section --> 
		        <ul class="right">
		          <li class="has-dropdown"> <a href="#">{{Session::get('user_name')}}</a> 
		            <ul class="dropdown">
		            	@if(Session::get('level')=='user')
		            	<li><a href="{{URL::to('/beranda')}}">Beranda</a></li>
		            	<li><a href="{{URL::to('/profile')}}">Akun</a></li>
		            	<li><a href="{{URL::to('/logout')}}">Keluar</a></li>
		            	@elseif (Session::get('level')=='admin')
		            	<li><a href="{{URL::to('/beranda')}}">Beranda</a></li>
		            	<li><a href="{{URL::to('/tambah/komunitas')}}">Tambahkan Komunitas</a></li>
		            	<li><a href="{{URL::to('/tambah/acara')}}">Tambahkan Acara</a></li>
		            	<li><a href="{{URL::to('/profile')}}">Akun</a></li>
		            	<li><a href="{{URL::to('/logout')}}">Keluar</a></li>
		            	@endif
		            </ul>
		          </li> 
		        </ul> 
		      </section>
			</nav> 
		<!-- </div> -->

		<div class="row">
			<div class="large-12 columns">
				<h1 class="text-center">Tambahkan Acara Baru</h1>
				<div class="profile border-grey">
					{{Form::open(array('method'=>'post', 'url'=>'/tambah/acara/'))}}
					<div class="row">
						<div class="row">
							<div class="large-6 columns">
								<label>Nama Acara :</label>
								<input type="text" name="event_name" placeholder="Nama Acara">
							</div>
							<div class="large-6 columns">
								<label>Penyelenggara :</label>
								<!-- <input type="text" name="komunitas" value=""> -->
								<select name="komunitas">
									@foreach($komunitas as $item)
									<option value="0">Pemerintahan</option>
									<option value="{{$item->id}}">{{$item->nama_komunitas}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<label>Deskripsi Acara :</label>
						<input type="text" name="description" placeholder="Deskripsi Acara">
						<div class="row">
							<div class="large-6 columns">
								<label>Tempat :</label>
								<input type="text" name="place" placeholder="Lokasi Acara">
							</div>
							<div class="large-6 columns">
								<label>Tanggal :</label>
								<input type="date" name="date" placeholder="Format : YYYY-MM-DD">
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Pendaftaran :</label>
								<input type="text" name="register" placeholder="Informasi Pendaftaran">
							</div>
							<div class="large-6 columns">
								
							</div>
						</div>
						<button type="submit" class="radius button right">Simpan</button>
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>
@stop