
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			pwd2:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_users_validate").validate({
		rules:{
			nama_users:{
				required:true
			},
			
			nik:{
				required:true,
				minlength:5,
				maxlength:5
			},
			
			username:{
				required:true,
				minlength:5,
				maxlength:10
			},
			
			level:{
				required:true
			},
			
			pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			pwd2:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	
	$("#add_data_validate").validate({
		rules:{
			id_users:{
				required:true
			},
			tanggal:{
				required:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#add_kamar_validate").validate({
		rules:{
			kode_kamar:{
			required:true
			},
			
			nama_kamar:{
			required:true,
			maxlength:20
			},
			
			harga_kamar:{
			required:true,
			number:false,
			maxlength:10
			},

			carabayar:{
			required:true	
			}

		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_pengeluaran_validate").validate({
		rules:{
		id_pengeluaran:{
				required:true
			},
			
			nama_pengeluaran:{
				required:true,
				maxlength:100
			},
			
			jumlah:{
				required:true,
				// number:true,
				maxlength:10
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#add_konsumen_validate").validate({
		rules:{
			id_konsumen:{
				required:true
			},
			
			nama_konsumen:{
				required:true,
				maxlength:50
			},

			nik:{
				required:true,
				maxlength:50
			},

			tempatlahir:{
				required:true,
				maxlength:50
			},

			tanggal_lahir:{
				required:true,
				maxlength:50
			},

			jekel:{
				required:true,
				maxlength:50
			},

			agama:{
				required:true,
				maxlength:50
			},

			pekerjaan:{
				required:true,
				maxlength:50
			},


			statusperkawinan:{
				required:false,
				maxlength:50
			},

			nama_istri:{
				required:false,
				maxlength:50
			},

			anak1:{
				required:false,
				maxlength:50
			},


			anak2:{
				required:false,
				maxlength:50
			},

			anak3:{
				required:false,
				maxlength:50
			},

			anak4:{
				required:false,
				maxlength:50
			},
			
			tanggal_masuk:{
				required:false,
				maxlength:100
			},

			alamat_konsumen:{
				required:true,
				maxlength:100
			},
			
			hp:{
				required:true,
				number:true,
				maxlength:16
			},
			tanggal_keluar:{
				required:false,
				maxlength:100
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#add_transaksi_validate").validate({
		rules:{
		id_transaksi:{
				required:true
			},
			
			nama_konsumen:{
				required:true,
				maxlength:50
			},
			
			joss:{
				required:true,
				minlength:3
			},
			
			harga:{
				required:true,
				// number:true,
				maxlength:10
			},
			
			// berat:{
			// 	required:true,
			// 	number:true,
			// 	maxlength:3
			// },
			subtotaltxt:{
				required:true
				// number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
});
