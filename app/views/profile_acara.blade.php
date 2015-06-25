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
		          <li class="has-dropdown"> <a href="">{{Session::get('user_name')}}</a> 
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
		      @else
		      <section class="top-bar-section">
			    <!-- Right Nav Section -->
			    <ul class="tob-bar-right">
			      <li><a href="{{URL::to('/')}}"  class="button">Masuk</a></li>
			    </ul>
				</section>
		      @endif
			</nav> 
		<!-- </div> -->

		@foreach($acara as $dataevent)
		<div class="row">
			<div class="large-12 columns">
				<div class="profile border-grey">
					<div class="row text-center">
						<div class="large-12 columns">
							<h1 class="text-center">{{$dataevent->judul_acara}}</h1>
							<?php 
								$tgl = $dataevent->tanggal;	
								$tanggal = date("d",strtotime($tgl)).' '.date("F",strtotime($tgl)).' '.date("o",strtotime($tgl))."\n";
							?>
							<h6><span><i class="fi-calendar"></i> {{$tanggal}}</span></h6>
							<h6><span><i class="fi-marker"></i> {{$dataevent->tempat}}</span></h6>
							@if(Session::get('level')=='user')
							@if($register == FALSE)
								<a href="{{URL::to('/ikuti/'.$dataevent->id)}}" class="fancy radius button">Datang ke acara</a>
								@elseif($register == TRUE)
								<a href="{{URL::to('/batal/'.$dataevent->id)}}" class="fancy radius button">Batalkan pendaftaran</a>
								@endif
							@elseif(Session::get('level')=='admin')
							<a href="{{URL::to('/update/acara/'.$dataevent->id)}}" class="fancy radius button">edit data</a>
							@else
							<a href="{{URL::to('/')}}" class="fancy radius button">Datang ke Acara</a>
							@endif
						</div>
						<hr>
					</div>
					<div class="row">
						<div class="large-8 columns">
							<div class="bio">
								<label>Tentang :</label>
								<p>{{$dataevent->deskripsi}}</p>
								@if($dataevent->id_komunitas != 0)
								<label>Penyelenggara :</label>
								@foreach ($komunitas as $datakom)
								<p><a href="{{URL::to('/komunitas/'.$datakom->slug)}}">{{$datakom->nama_komunitas}}</a></p>
								@endforeach
								@endif
								@if($dataevent->pendaftaran != NULL)
								<label>Pendaftaran :</label>
								<p>{{$dataevent->pendaftaran}}</p>
								@endif
							</div>
						</div>
						<div class="large-4 columns">
							<div class="komunitas text-center">
								<h5>Akan datang juga :</h5>
								<div class="row">
									@foreach($user as $member)
									<div class="small-3 columns">
										<a href="{{URL::to('/profile/'.$member->id_user)}}">{{HTML::image('assets/img/avatar/'.$member->foto, 'Serentak', array('class'=>'th'))}}</a>
									</div>
									@endforeach
								</div>
							</div>
							<hr>
							<div class="ratings text-center">
								<h5>Poster :</h5>
								{{HTML::image('assets/img/poster/'.$dataevent->poster, 'Serentak', array('class'=>'th'))}}
								@if(Session::get('level')=='admin')
								<p><small><a href="" data-reveal-id="poster-modal">Ganti poster</a></small></p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="poster-modal" class="reveal-modal" data-reveal> 
          <h3>Atur Gambar Poster</h3>
          <div class="row">
          	<fieldset>
          	{{Form::open(array('method'=>'post', 'url'=>'acara/upload/'.$dataevent->slug, 'files'=>'true'))}}
          	<div class="small-6 columns">
          		{{HTML::image('assets/img/poster/'.$dataevent->poster, 'Serentak', array('class'=>'th'))}}
          	</div>
          	<div class="small-6 columns text-center">
          		<button type="button" onclick="$('#input_file').trigger('click')">Pilih foto</button>
          		<input type="file" name="poster" id="input_file" style="display:none;">
          		<input class="button" type="submit" name="unggah" value="Unggah"/>
          	</div>
          	{{Form::close()}}
          	</fieldset>
          </div>
          <a class="close-reveal-modal">&#215;</a> 
        </div>
        @endforeach

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>
@stop