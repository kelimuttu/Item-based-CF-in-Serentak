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
		        @endif
		      </section> 
			</nav> 
		<!-- </div> -->

		@if((Session::has('logged_in'))&&(Session::get('level')=='admin'))

		<div class="row">
			<div class="large-12 columns">
				<h1 class="text-center">Data user</h1>
				<table>
					<thead>
						<tr>
							<th width="50">No</th>
							<th width="200">Nama User</th>
							<th width="100">Email</th>
							<th width="150">Facebook Username</th>
							<th width="100">Facebook Email</th>
							<th width="100">Level</th>
							<th width="200">Action</th>
						</tr>
					</thead>

					<tbody>
						<?php $i = 1;?>
						@foreach($users as $pengguna)
						<tr>
							<td>{{$i}}</td>
							<td>{{$pengguna->nama_depan}} {{$pengguna->nama_belakang}}</td>
							<td>{{$pengguna->surel}}</td>
							<td>{{$pengguna->fbname}}</td>
							<td>{{$pengguna->fbemail}}</td>
							<td>{{$pengguna->level}}</td>
							<td>
								<ul class="button-group round">
								  <li><a href="{{URL::to('/profile/'.$pengguna->id)}}" class="button secondary tiny" title="Kunjungi"><i class="fi-link"></i></a></li>
								  <li><div class="button info tiny" title="Hapus"><i class="fi-x-circle" title="Hapus" onclick="hapus_user({{$pengguna->id}})"></i></div></li>
								</ul>
							</td>
						</tr>
						<?php $i++; ?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif

		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>

@stop