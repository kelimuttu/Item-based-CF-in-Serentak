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

		@foreach($komunitas as $datakom)
		<div class="row">
			<div class="large-12 columns">
				<div class="profile border-grey">
					<div class="row text-center">
						<div class="large-10 columns">
							<h1 class="text-center">{{$datakom->nama_komunitas}}</h1>
							@if(Session::get('level')=='user')
								@if($ismember == FALSE)
								<a href="{{URL::to('/bergabung/'.$datakom->id)}}" class="fancy radius button">bergabung</a>
								@elseif($ismember == TRUE)
								<a href="{{URL::to('/keluar/'.$datakom->id)}}" class="fancy radius button">batal bergabung</a>
								@endif
							@elseif(Session::get('level')=='admin')
							<a href="{{URL::to('/update/komunitas/'.$datakom->id)}}" class="fancy radius button">edit data</a>
							@else
							<a href="{{URL::to('/')}}" class="fancy radius button">bergabung</a>
							@endif
						</div>
						<div class="large-2 columns">
							<!-- <a href="" data-reveal-id="avatar-zoom"> -->
							{{HTML::image('assets/img/komunitas/'.$datakom->foto, 'Serentak', array('class'=>'th'))}}
							<!-- </a> -->
							@if(Session::get('level')=='admin')
							<p><small><a href="" data-reveal-id="avatar-modal">Ganti foto profil</a></small></p>
							@endif
						</div>
						<hr>
					</div>
					<div class="row">
						<div class="large-8 columns">
							<div class="bio">
								<h5><strong>Informasi Umum</strong></h5>
								<label>Tentang :</label>
								<p>{{$datakom->deskripsi}}</p>
								@if($datakom->tanggal_jadi != '0000-00-00')
								<label>Dibentuk Sejak :</label>
								<p><?php 
								$tgl = $datakom->tanggal_jadi;	
								$tanggal = date("d",strtotime($tgl)).' '.date("F",strtotime($tgl)).' '.date("o",strtotime($tgl))."\n";
								echo $tanggal;?></p>
								@endif
								@if($datakom->basecamp != null)
								<label>Base camp :</label>
								<p>{{$datakom->basecamp}}</p>
								@endif
								<h5><strong>Kontak</strong></h5>
								<label>Telepon :</label>
								<p>{{$datakom->telepon}}</p>
								<label>Surel :</label>
								<p>{{$datakom->surel}}</p>
								<label>Situs :</label>
								<a href="{{URL::to($datakom->situs)}}"><p>{{URL::to($datakom->situs)}}</p></a>
								<!-- <h5><strong>Sosial Media</strong></h5> -->
								<label>Sosial Media :</label>
								@if($datakom->facebook != null)
								<a href="{{URL::to($datakom->facebook)}}" title="Facebook"><i class="fi-social-facebook"></i></a></li>
								@endif
								@if($datakom->twitter != null)
								<a href="{{URL::to($datakom->twitter)}}" title="Twitter"><i class="fi-social-twitter"></i></a></li>
								@endif
								@if($datakom->gplus != null)
								<a href="{{URL::to($datakom->gplus)}}" title="Google Plus"><i class="fi-social-google-plus"></i></a></li>
								@endif
							</div>
						</div>
						<div class="large-4 columns">
							<div class="text-center">
								<label>Rating Komunitas: </label>
								<span>
									<?php $i = 1;
									$rate = $datakom->avg_rate;
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
							</div>
							<hr>
							@if($cek == FALSE)
							<div class="ratings text-center">
								{{Form::open(array('method'=>'post', 'url'=>'/rate/komunitas/'.$datakom->id))}}
								<label>Beri rating: </label>
								<select name="rating">
									<option value="1">1</i></option>
									<option value="2">2</i></option>
									<option value="3">3</i></option>
									<option value="4">4</i></option>
									<option value="5">5</i></option>
								</select>
								<input class="fancy radius button" type="submit" name="rate" value="Beri rating"/>
								<!-- <span><i class="fi-star"></i><i class="fi-star"></i><i class="fi-star"></i><i class="fi-star"></i><i class="fi-star"></i></span> -->
								{{Form::close()}}
							</div>
							<hr>
							@elseif($cek == TRUE)
							<div class="ratings text-center">
								<label>Rating Kamu: </label>
								@foreach($rating as $rate)
								<h4>{{$rate->rating}}/5</h4>
								@endforeach
							</div>
							<hr>
							@endif
							<div class="komunitas text-center">
								<h5><strong>Anggota :</strong></h5>
								<div class="row">
									@foreach($anggota as $member)
									<div class="small-3 columns">
										<a href="{{URL::to('/profile/'.$member->id_user)}}">{{HTML::image('assets/img/avatar/'.$member->foto, 'Serentak', array('class'=>'th'))}}</a>
									</div>
									@endforeach
									<!-- <div class="small-3 columns">
										{{HTML::image('assets/img/people.png', 'Serentak', array('class'=>'th'))}}
									</div>
									<div class="small-3 columns">
										{{HTML::image('assets/img/people.png', 'Serentak', array('class'=>'th'))}}
									</div>
									<div class="small-3 columns">
										{{HTML::image('assets/img/people.png', 'Serentak', array('class'=>'th'))}}
									</div> -->
								</div>
							</div>
							<hr>
							<div class="event">
								<ul>
									<label>Acara :</label>
									@foreach($acara as $listacara)
									<li><a href="{{URL::to('/acara/'.$listacara->slug)}}">{{$listacara->judul_acara}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="avatar-zoom" class="reveal-modal" data-reveal> 
          <h3 class="text-center">{{$datakom->nama_komunitas}}</h3>
          <div class="row">
          	<fieldset>
          	<div class="large-12 columns">
          		{{HTML::image('assets/img/komunitas/'.$datakom->foto, 'Serentak', array('class'=>'th'))}}
          	</div>
          	</fieldset>
          </div>
          <a class="close-reveal-modal">&#215;</a> 
        </div>

        <div id="avatar-modal" class="reveal-modal" data-reveal> 
          <h3>Atur Foto Profil Komunitas</h3>
          <div class="row">
          	<fieldset>
          	{{Form::open(array('method'=>'post', 'url'=>'/komunitas/upload/'.$datakom->slug, 'files'=>'true'))}}
          	<div class="small-6 columns">
          		{{HTML::image('assets/img/komunitas/'.$datakom->foto, 'Serentak', array('class'=>'th'))}}
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
        @endforeach
		<div id="footer">
        	<p>&copy; Serentak. 2015</p>
		</div>
@stop