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
	
	$.validator.addMethod('reCaptchaMethod', function (value, element, param) {
		if (grecaptcha.getResponse() == ''){
			return false;
		} else {
			// I would like also to check server side if the recaptcha response is good
			return true
		}
	}, 'You must complete the antispam verification');
	
	jQuery("#loginform").validate({
		ignore: [],
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$",
				rangelength: [6, 12]
			},
			hiddenRecaptcha: {
				required: function() {
					if(grecaptcha.getResponse() == '') {
						return true;
					} else {
						return false;
					}
				}
			}
		},
		messages:{
			email:{
				required: "Enter email id",
				email: "Enter valid email"
			},
			password: {
				required: "Enter password",
				rangelength: "Password length must be between {0} to {1}"
			},
			hiddenRecaptcha: {
				required: "You must complete the antispam verification"
			}
		}
	});
	
	jQuery("#change_password").validate({
		rules: {
			new_pwd: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$",
				rangelength: [6, 12]
			},
			cnf_pwd: {
				required: true,
				equalTo: "#new_pwd"
			}
		},
		messages:{
			new_pwd: {
				required:"Enter new password.",
				rangelength:"Password length must be between {0} to {1}"
			},
			cnf_pwd: {
				required:"Enter confirm password.",
				equalTo: "Enter same password again."
			}			
		}
	});

	jQuery("#form_newsletter").validate({
		ignore: [],
		debug: false,
		rules: {
			subject: {
				required: true
			},
			contents: {
				required: function() 
				{
					CKEDITOR.instances.contents.updateElement();
				}
			}
		},
		messages:{
			subject: {
				required:"Enter subject."
			},
			contents: {
				required:"Enter contents."
			}			
		},
		errorPlacement: function($error, $element) {
            if ($element.attr("name") === "contents")
                $error.insertAfter("#chkediter");
            else
                $error.insertAfter($element);
        }
	});

	jQuery("#edit_form_slider").validate({
		ignore: [],
		rules: {
			slider_img: {
                /*required: true,*/
				extension: "png|jpg|jpeg|gif|bmp"
            },
			contents: {
				required: function() 
				{
					CKEDITOR.instances.contents.updateElement();
				}
			},
			slider_order: {
				required: true,
				digits: true
			}
		},
		messages:{ 
			slider_img: {
                /*required: "Select category image.",*/
				extension: "Uploaded file should be a png / jpg / jpeg / gif / bmp file."
            },
			contents: {
                required: "Enter Contents"
            },
             slider_order: {
				required: "Enter order.",
				digits: "Enter digits only"
			}
		},
		errorPlacement: function($error, $element) {
            if ($element.attr("name") === "contents")
                $error.insertAfter("#chkediter");
            else
                $error.insertAfter($element);
        }
	});

	
	jQuery("#form_services").validate({
		ignore: [],
		rules: {
			service_name: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			},
			page_url: {
				required: true,
				regex:"^[a-zA-Z0-9\-_]+$"
			},
			editor: {
				required: function() 
				{
					CKEDITOR.instances.editor.updateElement();
				}
			}
		},
		messages:{ 
			service_name: {
                required: "Enter service name."
			},
			page_url: {
				required: "Enter page url"
			},
			editor: {
                required: "Enter description"
            }
		},
		errorPlacement: function($error, $element) {
            if ($element.attr("name") === "editor")
                $error.insertAfter("#editorerrorloc");
            else
                $error.insertAfter($element);
        }
    });

	jQuery("#add_slider").validate({
		ignore: [],
		rules: {
			slider_img: {
                required: true,
				extension: "png|jpg|jpeg|gif|bmp"
            },
			contents: {
				required: function() 
				{
					CKEDITOR.instances.contents.updateElement();
				}
			},
			slider_order: {
				required: true,
				digits: true
			}
		},
		messages:{ 

			slider_img: {
                required: "Select slider image.",
				extension: "Uploaded file should be a png / jpg / jpeg / gif / bmp file."
            },
			contents: {
                required: "Enter Contents"
            },
            slider_order: {
				required: "Enter order.",
				digits: "Enter digits only"
			}
		},
		errorPlacement: function($error, $element) {
            if ($element.attr("name") === "contents")
                $error.insertAfter("#chkediter");
            else
                $error.insertAfter($element);
        }
        });
	

	jQuery("#userform").validate({
		rules: {			
			uname: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			},
			utype: {
				required: true
			},
			contact: {
				required: true,
				regex:"^[0-9 \+-]+$"
			},
			email: {
				required: true,
				email: true
				},			
			password: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$",
				rangelength: [6, 12]
			},
			cpassword: {
				required: true,
				equalTo: "#password"
			},
			'modules[]': {
				required: true
			}
		},
		messages:{
			uname:{
				required:"Enter user name."
			},
			utype: {
				required: "Select user type."
			},
			contact: {
				required:"Enter contact no.",
				regex: "Enter only number."
			},
			email: {
				required:"Enter email id.",
				email: "Enter a valid email id."
			},			
			password: {
				required:"Enter password.",
				rangelength:"Password length must be between {0} to {1}"
			},
			cpassword: {
				required:"Enter confirm password.",
				equalTo: "Enter same password again."
			},
			'modules[]': {
				required: "Select module category"
			}
		},
		errorPlacement: function (error, element)
		{
			if (element.attr("name") === "modules[]" )
				error.appendTo("#modules_errorloc");
			else if (element.attr("name") === "utype" )
				error.appendTo("#utype_errorloc");
			else
				error.insertAfter(element);
		}
	});
	
	jQuery("#form_gallery").validate({
		rules: {
			gallery: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			}
		},
		messages:{
			gallery: {
				required:"Enter gallery name."
			}	
		}
	});
	
	jQuery("#from_seo").validate({
		rules: {
			page_title: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			},
			page_desc: {
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			},
			page_metatags: {
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			}
		},
		messages:{
			page_title: {
				required:"Enter page title."
			}	
		}
	});
	
	jQuery("#from_common_settings").validate({
		rules: {
			par_value: {
				required: true
			}
		},
		messages:{
			par_value: {
				required:"Enter value."
			}	
		}
	});
	
	$(document.body).on('click', '.btnUpdate', function(){	
	jQuery("#form_master_edit").validate({
		rules: {
			gallery_name: {
				required: true,
				regex:"^[a-zA-Z0-9\-_#!`~\/\\*?@}{&$%^();,.+=|:\ \r\n]+$"
			}
		},
		messages:{
			gallery_name: {
				required:"Enter gallery name."
			}	
		}
	});
	});

	
	$('input:radio[name="utype"]').change(function() {
		if ($(this).val() == '1') { // Super Admin
			//Check All Checkbox and Disable
			$('input:checkbox[name="modules[]"]').prop('checked', this.checked).attr("disabled", true);
		} else
		{ // Admin User
			//Uncheck All Checkbox and Enable
			$('input:checkbox[name="modules[]"]').removeAttr('checked disabled');
		}
	});
	
});