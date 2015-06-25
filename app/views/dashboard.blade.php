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
		        @endif
		      </section> 
			</nav> 
		<!-- </div> -->

		@if((Session::has('logged_in'))&&(Session::get('level')=='user'))
		<div class="row">
			<div class="large-12 columns">
				@if($rating == 0)
				<h1 class="text-center">Mulailah memberikan rating untuk mendapat rekomendasi</h1>
				<div class="rating">
					@foreach($komunitas as $listkom)
					<div class="border">
						<div class="row collapse">
							<div class="large-8 columns">
								<a href="{{URL::to('/komunitas/'.$listkom->slug)}}"><h3>{{$listkom->nama_komunitas}}</h1></a>
								<p>{{$listkom->ringkasan}}</p>
							</div>
							<div class="large-4 columns text-center">
								<span>
									<?php $i = 1;
									$rate = $listkom->avg_rate;
									if ($rate > 1) {
										do { ?>
											<i class="fi-star"></i>
											<?php $i++; 
											} while ( $i <= $rate);
									}else{
										echo "Belum pernah mendapat rating";
									}
									?>
								</span>
								<!-- <h5>Kategori : </h5> -->
							</div>
						</div>
					</div>
					@endforeach
				@elseif(($rating > 0) && ($cek == TRUE))
				<h1 class="text-center">Di bawah ini rekomendasi komunitas yang mungkin Anda sukai</h1>
				<div class="rating">
					@foreach($rekomen as $rec)
					<div class="border">
						<div class="row collapse">
							<div class="large-8 columns">
								<a href="{{URL::to('/komunitas/'.$rec->slug)}}"><h3>{{$rec->nama_komunitas}}</h1></a>
								<p>{{$rec->ringkasan}}</p>
							</div>
							<div class="large-4 columns text-center">
								<span>
									<?php $i = 1;
									$rate = $rec->avg_rate;
									if ($rate > 1) {
										do { ?>
											<i class="fi-star"></i>
											<?php $i++; 
											} while ( $i <= $rate);
									}else{
										echo "Belum pernah mendapat rating";
									}
									?>
								</span>
								<!-- <h5>Kategori : </h5> -->
							</div>
						</div>
					</div>
					@endforeach
				@else
				<h1 class="text-center">Berikan lebih banyak rating untuk mendapat rekomendasi</h1>
				<div class="rating">
					@foreach($rand as $random)
					<div class="border">
						<div class="row collapse">
							<div class="large-8 columns">
								<a href="{{URL::to('/komunitas/'.$random->slug)}}"><h3>{{$random->nama_komunitas}}</h1></a>
								<p>{{$random->ringkasan}}</p>
							</div>
							<div class="large-4 columns text-center">
								<span>
									<?php $i = 1;
									$rate = $random->avg_rate;
									if ($rate > 1) {
										do { ?>
											<i class="fi-star"></i>
											<?php $i++; 
											} while ( $i <= $rate);
									}else{
										echo "Belum pernah mendapat rating";
									}
									?>
								</span>
								<!-- <h5>Kategori : </h5> -->
							</div>
						</div>
					</div>
					@endforeach
				@endif
					<a href="{{URL::to('/daftar-komunitas/')}}" class="">Lihat lebih banyak Komunitas</a>
				</div>

				<h4>Di bawah ini daftar acara akhir-akhir ini</h4>
				<div class="rating">
					@foreach($acara as $listacara)
					<div class="border">
						<div class="row collapse">
							<div class="large-8 columns">
								<a href="{{URL::to('/acara/'.$listacara->slug)}}"><h3>{{$listacara->judul_acara}}</h1></a>
								<h6><span><i class="fi-marker"></i> {{$listacara->tempat}}</span></h6>
								<?php 
								$tgl = $listacara->tanggal;	
								$tanggal = date("d",strtotime($tgl)).' '.date("F",strtotime($tgl)).' '.date("o",strtotime($tgl))."\n";
								?>
								<h6><span><i class="fi-calendar"></i> {{$tanggal}}</span></h6>
							</div>
							<div class="large-4 columns text-center">
								<a href="{{URL::to('/acara/'.$listacara->slug)}}" class="button">Detail Kegiatan</a></span>
							</div>
						</div>
					</div>
					@endforeach
					<a href="{{URL::to('/daftar-acara/')}}" class="">Lihat lebih banyak kegiatan</a>
				</div>
			</div>
		</div>
		@elseif((Session::has('logged_in'))&&(Session::get('level')=='admin'))

		<div class="row text-center">
			<h1>Beranda Admin</h1>
			<div class="large-4 columns text-center">
				<a href="{{URL::to('/beranda/users')}}"><span><i width="60px" class="fi-male-female"></i></span>
				<h5>Manajemen User</h5></a>
			</div>
			<div class="large-4 columns text-center">
				<a href="{{URL::to('/beranda/komunitas')}}"><span><i class="fi-torsos-all"></i></span>
				<h5>Manajemen Komunitas</h5></a>
			</div>
			<div class="large-4 columns text-center">
				<a href="{{URL::to('/beranda/acara')}}"><span><i class="fi-results-demographics"></i></span>
					<h5>Manajemen Event</h5></a>
			</div>
		</div>
		@endif

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>

@stop