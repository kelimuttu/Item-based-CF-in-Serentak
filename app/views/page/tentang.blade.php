@extends('layouts.main_layout')

@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=580936555376085&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

		<!-- <div class="fixed">  -->
		@if(Session::has('logged_in'))
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						{{HTML::image('assets/img/logo.png', 'Serentak', array('class'=>'logo'))}}
					</li>
				</ul>
				<section class="top-bar-section">
		        <!-- Right Nav Section --> 
		        <ul class="right">
		          <li class="has-dropdown"> <a href="">{{Session::get('user_name')}}</a> 
		            <ul class="dropdown">
		            	@if(Session::get('level')=='user')
		            	<li><a href="{{URL::to('/beranda')}}">Beranda</a></li>
		            	<li><a href="{{URL::to('/profile')}}">Akun</a></li>
		            	<li><a href="{{URL::to('/logout')}}">Keluar</a></li>
		            	@elseif (Session::get('level')=='admin')
		            	<li><a href="{{URL::to('/beranda')}}">Beranda Admin</a></li>
		            	<li><a href="{{URL::to('/tambah/komunitas')}}">Tambahkan Komunitas</a></li>
		            	<li><a href="{{URL::to('/tambah/acara')}}">Tambahkan Acara</a></li>
		            	<li><a href="{{URL::to('/profile')}}">Akun</a></li>
		            	<li><a href="{{URL::to('/logout')}}">Keluar</a></li>
		            	@endif
		            </ul>
		          </li> 
		        </ul> 

		        <div class="large-3 columns right">
		        	{{Form::open(array('method'=>'post', 'url'=>'/pencarian'))}}
				      <div class="row collapse postfix-round">
				        <div class="small-9 columns">
				          <input type="text" name="key" placeholder="Cari Komunitas">
				        </div>
				        <div class="small-3 columns">
				          <button type="submit" class="button postfix">Cari</button>
				        </div>
				      </div>
				    {{Form::close()}}
				</div>
		      </section> 
			</nav> 

		@else
			<!-- <div class="fixed">  -->
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						{{HTML::image('assets/img/logo.png', 'Serentak', array('class'=>'logo'))}}
					</li>
				</ul> 

				<section class="top-bar-section">
			    <!-- Right Nav Section -->
			    <ul class="tob-bar-right">
			      <li><a href=""  class="button" data-reveal-id="signin-modal">Masuk</a></li>
			    </ul>
			  </section>
			</nav> 
			<!-- </div> -->
		@endif

		<div class="row">
			<div class="large-12 columns text-center">
				<h1 class="">Tentang Serentak</h1>
				{{HTML::image('assets/img/asd.png', '', array('class'=>'cover'))}}<br>
				<h5>Serentak adalah sebuah platform bagi kegiatan komunitas & pemuda di Kota Semarang. Dengan serentak, kamu bisa mendapatkan rekomendasi Komunitas yang cocok untukmu. Kamu juga bisa melihat daftar kegiatan komunitas dan pemuda yang ada di Kota Semarang. </h5>
			</div>
		</div>

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>

		<div id="signin-modal" class="reveal-modal" data-reveal>
			<div class="row text-center">
				<h2>Masuk</h2>
				<p>Belum pernah bergabung? Daftar <a href="#" data-reveal-id="signup-modal">disini</a></p>
				<div class="signin-panel">
					{{Form::open(array('method'=>'post', 'url'=>'login'))}}
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix"><i class="fi-mail"></i></span>
						</div>
						<div class="small-10  columns">
							<input class="formInput" type="text" name="email" placeholder="Alamat Surel">
						</div>
					</div>
					<div class="row collapse">
						<div class="small-2 columns ">
							<span class="prefix"><i class="fi-lock"></i></span>
						</div>
						<div class="small-10 columns ">
							<input id="password" type="password" name="password" placeholder="Kata Sandi">
						</div>
					</div>
					<center><button type="submit" class="button">Masuk</button></center>
					<!-- <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="true" data-auto-logout-link="false"></div> -->

					<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
					</fb:login-button> -->
					<!-- <div id="status">
					</div> -->
					{{Form::close()}}

					<!-- <p>Atau,</p> -->
					{{Form::open(array('method'=>'get', 'url'=>'fblogin'))}}
					<center><button type="submit" class="button">Masuk dengan Facebook</button></center>
					{{Form::close()}}
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>

		<div id="signup-modal" class="reveal-modal" data-reveal>
			<div class="row text-center">
				<h2>Daftar</h2>
				<p>Sudah pernah mendaftar? Masuk <a href="#" data-reveal-id="signin-modal">disini</a></p>
				<div class="signup-panel">
					{{Form::open(array('method'=>'post', 'url'=>'signup', 'id'=>'form_daftar'))}}
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix"><i class="fi-torso"></i></span>
						</div>
						<div class="small-10  columns">
							<div class="row">
								<div class="small-6 columns">
									<input class="formInput" type="text" name="nama_depan" placeholder="Nama Depan">
								</div>
								<div class="small-6 columns">
									<input class="formInput" type="text" name="nama_belakang" placeholder="Nama Belakang">
								</div>
							</div>
						</div>
					</div>
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix"><i class="fi-mail"></i></span>
						</div>
						<div class="small-10  columns">
							<input class="formInput" type="text" name="email" placeholder="Alamat Surel">
						</div>
					</div>
					<!-- <div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix"><i class="fi-mail"></i></span>
						</div>
						<div class="small-10  columns">
							<input class="formInput" type="text" name="email_confirm" placeholder="Konfirmasi Alamat Surel">
						</div>
					</div> -->
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix"><i class="fi-telephone"></i></span>
						</div>
						<div class="small-10  columns">
							<input class="formInput" type="text" name="phone" placeholder="Nomor Telepon">
						</div>
					</div>
					<div class="row collapse">
						<div class="small-2 columns ">
							<span class="prefix"><i class="fi-lock"></i></span>
						</div>
						<div class="small-10 columns ">
							<input class="formInput" type="password" name="pass" placeholder="Kata Sandi">
						</div>
					</div>
					<center><button type="submit" class="button" onclick="daftar()">Daftar</button></center>
					{{Form::close()}}
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
@stop