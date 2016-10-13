@extends('layout.skeleton') @section('content')
	<div class="row" id="avto">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Текст на главной странице</h5>
					<button id="edit" class="btn btn-primary btn-xs m-l-sm" onclick="edit()" type="button">Редактировать</button>
					<button id="save" class="btn btn-primary  btn-xs"  v-on:click="SaveData()" type="button">Сохранить</button>
				</div>
				<div class="ibox-content no-padding">
					<div class="click2edit wrapper p-md" v-model="main_text">
						<?php
						echo \App\Models\Settings::where('name', 'main_text')->first()->value;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('content_scripts')
	<script>
		var edit = function() {
			$('.click2edit').summernote({focus: true});
		};
		$(document).ready(function() {
			Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content')
			new Vue({
				el: '#avto',
				data: {
					edit:{
						main_text:''
					}
				},
				methods: {
					SaveData: function(){
						var aHTML = $('.click2edit').code();
						this.edit.main_text = aHTML;
						this.$http.post('/main_text', this.edit).then(function (response) {
							$('.click2edit').destroy();
						});
					}
				}
			});
		});

	</script>

@endsection
@section('content_styles')
@endsection