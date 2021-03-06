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

		<div class="row">
			<div class="large-12 columns text-center">
				<h1>Temukan komunitas di sekitarmu!</h1>
				{{HTML::image('assets/img/asd.png', '', array('class'=>'cover'))}}
				<h6>Belum pernah bergabung?</h6>
				<a href="#" class="button" data-reveal-id="signup-modal">Daftar sekarang juga!</a>
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
					<a href="{{URL::to('/tentang')}}">Tentang Serentak</a>
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

					<a href="{{URL::to('/tentang')}}">Tentang Serentak</a>
				</div>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
@stop