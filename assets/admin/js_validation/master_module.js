jQuery(document).ready(function() {
	
	jQuery.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
	}, "String must contain only letters, numbers, or dashes.");
	
	jQuery.validator.addMethod("regex",function(value,element,regexp){
		var re= new RegExp(regexp);
		return this.optional(element) || re.test(value);
	},"Remove Special Chars");
	
	jQuery.validator.addMethod('selectcheck', function (value) {
		return (value != '0');
	}, "Select");
	
	jQuery.validator.addMethod('decimal', function(value, element) {
		return this.optional(element) || /^(\d+\.)?\d+$/.test(value); 
	}, "Invalid Number");
	
	jQuery("#form_master_module").validate({
		rules: {			
			field_val: {
				required: true
			}
		}
	});
	
	jQuery("#form_city").validate({
		rules: {			
			country: {
				selectcheck: true
			},
			city_name: {
				required: true
			}
		},
		messages:{
			country:{
				selectcheck: "Select country."
			},
			city_name: {
				required: "Enter city name."
			}
		}
	});
});

$(document.body).on('click', '.btnUpdate', function(){
	jQuery("#form_master_edit").validate({
		rules: {
			field_val: {
				required: true
			}
		}
	});
	
	jQuery("#form_city_edit").validate({
		rules: {			
			country: {
				selectcheck: true
			},
			city_name: {
				required: true
			}
		},
		messages:{
			country:{
				selectcheck: "Select country."
			},
			city_name: {
				required: "Enter city name."
			}
		}
	});
});	