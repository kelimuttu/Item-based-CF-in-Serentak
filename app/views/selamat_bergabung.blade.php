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
		            	<li><a href="{{URL::to('/beranda')}}">Beranda</a></li>
		            	<li><a href="{{URL::to('/profile')}}">Akun</a></li>
		            	<li><a href="{{URL::to('/logout')}}">Keluar</a></li>
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
		<!-- </div> -->

		<div class="row">
			<div class="large-12 columns">
				<h1 class="text-center">Halo {{Session::get('user_name')}}..</h1>
				<h4>Selamat datang di Serentak! Mulailah dengan memberikan rating pada beberapa komunitas pilihan di bawah ini</h4>
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
				</div>
				<a href="/beranda" class="button right">Lanjutkan</a>
			</div>
		</div>

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>
@stop