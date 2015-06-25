@extends('layouts.main_layout')

@section('content')
		<!-- <div class="fixed">  -->
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						{{HTML::image('assets/img/logo.png', 'Serentak', array('class'=>'logo'))}}
					</li>
				</ul>
				@if(Session::has('logged_in'))
				<section class="top-bar-section"> 
		        <!-- Right Nav Section --> 
		        <ul class="right">
		          <li class="has-dropdown"> <a href="">{{$user->nama_depan}}</a> 
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
		      @endif
			</nav> 
		<!-- </div> -->
@if(Session::has('logged_in'))
		<div class="row">
			<div class="large-12 columns">
				<div class="profile border-grey">
					<div class="row">
						<div class="large-8 columns">
							<div class="row userprofile">
								<div class="large-8 columns">
									<h1>{{$user->nama_depan}} {{$user->nama_belakang}}</h1>
								</div>
								@if($user->id == Session::get('user_id'))
								<div class="large-4 columns">
									<a href="{{URL::to('/profil/edit/')}}" class="fancy radius button right">edit profil</a>
								</div>
								@endif
								<hr>
							</div>
							<div class="bio">
								<label>Bio :</label>
								<h6>{{$user->bio}}</h6>
								<label>Jenis Kelamin :</label>
								
								<h6><?php 
								if ($user->gender == 1) {
									echo "Laki-laki";
									} else if ($user->gender == 2) {
										echo "Perempuan";
									} else {
										echo "";
									};
								?></h6>
								@if($user->tanggal_lahir != '0000-00-00')
								<label>Tanggal lahir :</label>
								<p><?php 
								$tgl = $user->tanggal_lahir;	
								$tanggal = date("d",strtotime($tgl)).' '.date("F",strtotime($tgl)).' '.date("o",strtotime($tgl))."\n";
								echo $tanggal;?></p>
								@endif
								<label>Surel :</label>
								<p>{{$user->surel}}</p>
								<label>Lokasi :</label>
								<p>{{$user->alamat}}</p>
								<label>Kontak :</label>
								<p>{{$user->telpon}}</p>
								<label>Anggota sejak :</label>
								<p><?php 
								$since = $user->created_at;	
								$date = date("d",strtotime($since)).' '.date("F",strtotime($since)).' '.date("o",strtotime($since))."\n";
								echo $date;?></p>
								<label>Sosial Media :</label>
								@if($user->facebook != null)
								<a href="{{URL::to($user->facebook)}}" title="Facebook"><i class="fi-social-facebook"></i></a></li>
								@endif
								@if($user->twitter != null)
								<a href="{{URL::to($user->twitter)}}" title="Twitter"><i class="fi-social-twitter"></i></a></li>
								@endif
								@if($user->gplus != null)
								<a href="{{URL::to($user->gplus)}}" title="Google Plus"><i class="fi-social-google-plus"></i></a></li>
								@endif
							</div>
						</div>
						<div class="large-4 columns">
							<div class="avatar text-center">
								@if(Session::get('fbid')== null)
								<a href="" data-reveal-id="avatar-zoom">{{HTML::image('assets/img/avatar/'.$user->foto, 'Serentak', array('class'=>'th'))}}</a>
								@else
								<a href="" data-reveal-id="avatar-zoom">{{HTML::image('https://graph.facebook.com/'.Session::get('fbid').'/picture', 'Serentak', array('class'=>'th'))}}</a>
								@endif
								@if($user->id == Session::get('user_id'))
								<p><small><a href="" data-reveal-id="avatar-modal">Ganti foto profil</a></small></p>
								@endif
							</div>
							<hr>
							@if($user->level == 'admin')
							<div class="Level text-center">
									<p>Kamu adalah seorang {{$user->level}}!</p>
							</div>
							<hr>
							@endif
							@if(Session::get('level')=='user')
							<div class="komunitas">
								<ul>
									<label>Komunitas yang diikuti:</label>
									@foreach($komunitas as $listkom)
									<li><a href="/komunitas/{{$listkom->slug}}">{{$listkom->nama_komunitas}}</a></li>
									@endforeach
								</ul>
							</div>
							<hr>
							<div class="minat">
								<ul>
									<label>Acara yang diikuti:</label>
									@foreach($event as $listacara)
									<li><a href="/acara/{{$listacara->slug}}">{{$listacara->judul_acara}}</a></li>
									@endforeach
								</ul>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>

		<div id="avatar-zoom" class="reveal-modal" data-reveal> 
          <h3 class="text-center">{{$user->nama_depan}} {{$user->nama_belakang}}</h3>
          <div class="row">
          	<fieldset>
          	<div class="small-12 columns">
          		@if(Session::get('fbid')== null)
          		{{HTML::image('assets/img/avatar/'.$user->foto, 'Serentak', array('class'=>'th'))}}
          		@else
          		{{HTML::image('https://graph.facebook.com/'.Session::get('fbid').'/picture', 'Serentak', array('class'=>'th'))}}
          		@endif
          	</div>
          	</fieldset>
          </div>
          <a class="close-reveal-modal">&#215;</a> 
        </div>

		<div id="avatar-modal" class="reveal-modal" data-reveal> 
          <h3>Atur Foto Profil</h3>
          <div class="row">
          	<fieldset>
          	{{Form::open(array('method'=>'post', 'url'=>'profile/upload/', 'files'=>'true'))}}
          	<div class="small-6 columns">
          		{{HTML::image('assets/img/avatar/'.$user->foto, 'Serentak', array('class'=>'th'))}}
          		<!-- {{HTML::image('assets/img/default.png', 'Serentak', array('class'=>'th'))}} -->
          	</div>
          	<div class="small-6 columns text-center">
          		<button type="button" onclick="$('#input_file').trigger('click')">Pilih foto</button>
          		<input type="file" name="avatar" id="input_file" style="display:none;">
          		<input class="button" type="submit" name="unggah" value="Unggah"/>
          	</div>
          	{{Form::close()}}
          	</fieldset>
          </div>
          	
          </form>
          <a class="close-reveal-modal">&#215;</a> 
        </div>
@endif
@stop