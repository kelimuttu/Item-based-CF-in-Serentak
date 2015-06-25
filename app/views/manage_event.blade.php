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
				<h1 class="text-center">Data Acara</h1>
				<table>
					<thead>
						<tr>
							<th width="20">No</th>
							<th width="120">Nama Acara</th>
							<th width="350">Deskripsi Acara</th>
							<th width="100">Tanggal</th>
							<th width="150">Tempat</th>
							<th width="100">Penyelenggara</th>
							<th width="200">Action</th>
						</tr>
					</thead>

					<tbody>
						<?php $i = 1;?>
						@foreach($acara as $event)
						<tr>
							<td>{{$i}}</td>
							<td>{{$event->judul_acara}}</td>
							<td>{{$event->deskripsi}}</td>
							<?php 
								$tgl = $event->tanggal;	
								$tanggal = date("d",strtotime($tgl)).' '.date("F",strtotime($tgl)).' '.date("o",strtotime($tgl))."\n";
							?>
							<td>{{$tanggal}}</td>
							<td>{{$event->tempat}}</td>
							<td>{{$event->nama_komunitas}}</td>
							<td>
								<ul class="button-group round">
								  <li><a href="{{URL::to('/acara/'.$event->slug)}}" class="button secondary tiny" title="Kunjungi"><i class="fi-link"></i></a></li>
								  <li><a href="{{URL::to('/update/acara/'.$event->id)}}" class="button secondary tiny" title="Edit" ><i class="fi-clipboard-pencil"></i></a></li>
								  <li><div class="button info tiny" title="Hapus"><i class="fi-x-circle" onclick="hapus_acara({{$event->id}})"></i></div></li>
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