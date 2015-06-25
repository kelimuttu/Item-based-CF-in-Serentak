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
				<h1 class="text-center">Menambahkan Komunitas Baru</h1>
				<div class="profile border-grey">
					{{Form::open(array('method'=>'post', 'url'=>'/tambah/komunitas/'))}}
					<div class="row">
						<h5><strong>Informasi Umum</strong></h5>
						<div class="row">
							<div class="large-6 columns">
								<label>Nama Komunitas :</label>
								<input type="text" name="name" placeholder="Nama Komunitas">
							</div>
							<div class="large-6 columns">
								<label>Kategori :</label>
								<select name="kategori">
									@foreach($kategori as $item)
									<option value="{{$item->id}}">{{$item->nama_genre}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<label>Deskripsi Komunitas :</label>
						<input type="text" name="description" placeholder="Deskripsi Komunitas">
						<div class="row">
							<div class="large-6 columns">
								<label>Dibentuk Sejak :</label>
								<input type="date" name="since" placeholder="Format : YYYY-MM-DD">
							</div>
							<div class="large-6 columns">
								<label>Base Camp :</label>
								<input type="date" name="basecamp" placeholder="Isi jika ada">
							</div>
						</div>

						<h5><strong>Kontak</strong></h5>
						<div class="row">
							<div class="large-6 columns">
								<label>Telepon :</label>
								<input type="text" name="phone" placeholder="Contoh : 081xxxxxxxxx">
							</div>
							<div class="large-6 columns">
								<label>Surel :</label>
								<input type="email" name="email" placeholder="Contoh : john.doe@serentak.org">
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Situs :</label>
								<input type="text" name="site" placeholder="Contoh : https://serentak.org/">
							</div>
							<div class="large-6 columns">
								<label>Facebook :</label>
								<span data-tooltip aria-haspopup="true" class="has-tip" title="Tempelkan alamat profil facebook Anda">
									<input type="url" name="facebook" placeholder="Contoh : https://www.facebook.com/john.doe"></span>
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Twitter :</label>
								<span data-tooltip aria-haspopup="true" class="has-tip" title="Tempelkan alamat profil twitter Anda">
									<input type="url" name="twitter" placeholder = "Contoh : https://twitter.com/john_doe"></span>
							</div>
							<div class="large-6 columns">
								<label>Google Plus :</label>
								<span data-tooltip aria-haspopup="true" class="has-tip" title="Tempelkan alamat profil gplus Anda">
									<input type="url" name="gplus" placeholder = "Contoh : https://plus.google.com/+JohnDoe"></span>
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