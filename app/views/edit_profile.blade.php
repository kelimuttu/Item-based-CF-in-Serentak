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
		          <li class="has-dropdown"> <a href="#">{{$user->nama_depan}}</a> 
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
				<h1>Hai {{$user->nama_depan}}, mari ceritakan sedikit tentang dirimu..</h1>
				<div class="profile border-grey">
					{{Form::open(array('method'=>'post', 'url'=>'profil/edit/'))}}
					<div class="row">
						<h5><strong>Informasi Umum</strong></h5>
						<div class="row">
							<div class="large-6 columns">
								<label>Nama depan :</label>
								<input type="text" name="first_name" value="{{$user->nama_depan}}">
							</div>
							<div class="large-6 columns">
								<label>Nama belakang :</label>
								<input type="text" name="last_name" value="{{$user->nama_belakang}}">
							</div>
						</div>
						<label>Bio :</label>
						<textarea type="text" name="bio" >{{$user->bio}}</textarea>
						<!-- <input type="text" name="bio" value="{{$user->bio}}"> -->
						<div class="row">
							<div class="large-6 columns">
								<label>Tanggal Lahir :</label>
								<!-- <div data-date="" data-date-format="dd-mm-yyyy">
									{{$cal->generate()}}
								</div> -->
								<input type="date" name="bday" value="{{$user->tanggal_lahir}}">
							</div>
							<div class="large-6 columns">
								<label>Jenis Kelamin :</label>
								<select name="gender">
									<option value="1" @if($user->gender == 1) selected="selected" @endif>Laki-laki</option>
									<option value="2" @if($user->gender == 2) selected="selected" @endif>Perempuan</option>
								</select>
							</div>
						</div>

						<h5><strong>Kontak</strong></h5>
						<div class="row">
							<div class="large-6 columns">
								<label>Alamat :</label>
								<input type="text" name="address" value="{{$user->alamat}}">
							</div>
							<div class="large-6 columns">
								<label>Password :</label>
								<input type="password" name="pass" value="">
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Surel :</label>
								<input type="email" name="email" value="{{$user->surel}}">
							</div>
							<div class="large-6 columns">
								<label>Telepon :</label>
								<input type="tel" name="phone" value="{{$user->telpon}}">
							</div>
						</div>
						<div class="row">
							<div class="large-4 columns">
								<label>Facebook :</label>
								<span data-tooltip aria-haspopup="true" class="has-tip" title="Tempelkan alamat profil facebook Anda">
									<input type="url" name="facebook" value="{{$user->facebook}}"></span>
							</div>
							<div class="large-4 columns">
								<label>Twitter :</label>
								<span data-tooltip aria-haspopup="true" class="has-tip" title="Tempelkan alamat profil twitter Anda">
									<input type="url" name="twitter" value="{{$user->twitter}}"></span>
							</div>
							<div class="large-4 columns">
								<label>Google Plus :</label>
								<span data-tooltip aria-haspopup="true" class="has-tip" title="Tempelkan alamat profil gplus Anda">
									<input type="url" name="gplus" value="{{$user->gplus}}"></span>
							</div>
						</div>
						<h5><strong>Minat</strong></h5>
						<div class="row">
							<div class="small-12  columns">
								@foreach($minat as $item)
		                        <input type="checkbox" name="minat" value="{{$item->id}}"> {{$item->nama_genre}}
		                        @endforeach
							</div>
						</div>
						<button type="submit" class="radius button right">Simpan Perubahan</button>
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>
@stop