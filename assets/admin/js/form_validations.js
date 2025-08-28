$(document).ready(function() {
	$(".select2").select2();
	//Traditional form validation sample
	$('#form_traditional_validation').validate({
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form1Amount: {
                        minlength: 2,
                        required: true
                    },
                    form1CardHolderName: {
						minlength: 2,
                        required: true,
                    },
                    form1CardNumber: {
                        required: true,
                        creditcard: true
                    },
                    cardType:{
                        required: true
                    }
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type   
					$('<span class="error"></span>').insertAfter(element).append(label)
                    var parent = $(element).parent('.input-with-icon');
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					var parent = $(element).parent();
                    parent.removeClass('success-control').addClass('error-control'); 
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
					var parent = $(element).parent('.input-with-icon');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
                
                }
            });	

            $('.select2', "#form_traditional_validation").change(function () {
                $('#form_traditional_validation').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
	//Iconic form validation sample	
	   $('#form_iconic_validation').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form1Name: {
                        minlength: 2,
                        required: true
                    },
                    form1Email: {
                        required: true,
                        email: true
                    },
                    form1Url: {
                        required: true,
                        url: true
                    },
                    gendericonic:{
                        required: true
                    }
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('fa fa-check').addClass('fa fa-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					var parent = $(element).parent();
                    parent.removeClass('success-control').addClass('error-control'); 
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("fa fa-exclamation").addClass('fa fa-check');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
                
                }
           
            });
             $('.select2', "#form_iconic_validation").change(function () {
                $('#form_iconic_validation').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
	//Form Condensed Validation
	$('#form-condensed').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {
                    form3FirstName: {
                        minlength: 3,
                        required: true
                    },
					form3LastName: {
                        minlength: 3,
                        required: true
                    },
                    form3Gender: {
                        required: true,
                    },
					form3DateOfBirth: {
                        required: true,
                    },
					form3Occupation: {
						 minlength: 3,
                        required: true,
                    },
					form3Email: {
                        required: true,
						email: true
                    },
                    form3Address: {
						minlength: 10,
                        required: true,
                    },
					form3City: {
						minlength: 5,
                        required: true,
                    },
					form3State: {
						minlength: 3,
                        required: true,
                    },
					form3Country: {
						minlength: 3,
                        required: true,
                    },
					form3PostalCode: {
						number: true,
						maxlength: 4,
                        required: true,
                    },
					form3TeleCode: {
						minlength: 3,
						maxlength: 4,
                        required: true,
                    },
					form3TeleNo: {
						maxlength: 10,
                        required: true,
                    },
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type   
					$('<span class="error"></span>').insertAfter(element).append(label)
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                  
                },

                submitHandler: function (form) {
                
                }
            });	
	
	//Form Wizard Validations
	var $validator = $("#project_encrypt").validate({
		  rules: {
		    emailfield: {
		      required: true,
		      email: true,
		      minlength: 3
		    },
		    txtFullName: {
		      required: true,
		      minlength: 3
		    },
			txtFirstName: {
		      required: true,
		      minlength: 3
		    },
			txtLastName: {
		      required: true,
		      minlength: 3
		    },
			txtCountry: {
		      required: true,
		      minlength: 3
		    },
			txtPostalCode: {
		      required: true,
		      minlength: 3
		    },
			txtPhoneCode: {
		      required: true,
		      minlength: 3
		    },
			txtPhoneNumber: {
		      required: true,
		      minlength: 3
		    },
		    urlfield: {
		      required: true,
		      minlength: 3,
		      url: true
		    }
		  },
		  errorPlacement: function(label, element) {
				$('<span class="arrow"></span>').insertBefore(element);
				$('<span class="error"></span>').insertAfter(element).append(label)
			}
		});

    $(function (wizardBar) {

        wizardBar('#rootwizard').bootstrapWizard({
	  		'tabClass': 'form-wizard',
            nextSelector: '.wizard-actions .next',
            previousSelector: '.wizard-actions .previous',
            firstSelector: '.wizard-actions .first',
            lastSelector: '.wizard-actions .last',
            onTabClick: function(tab, navigation, index) {

                var $valid = $("#project_encrypt").valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },

            'onNext': function(tab, navigation, index) {
                var $valid = $("#project_encrypt").valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
                else{
                    $('#rootwizard').find('.form-wizard').children('li').eq(index-1).addClass('complete');
                    $('#rootwizard').find('.form-wizard').children('li').eq(index-1).find('.step').html('<i class="fa fa-check"></i>');
                }
	  		},

            onTabShow: function (tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                var $wizard = $('#rootwizard');

                $('#project_encrypt').find('.progress-bar').css({
                    width: $percent + '%'
                });

                $('.row').find('.number-page').text($current + ' of ' + $total);

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $wizard.find('.wizard-actions .next').hide();
                    $wizard.find('.wizard-actions .finish').show();
                    $wizard.find('.wizard-actions .finish').removeClass('disabled');
                }
                else {
                    $wizard.find('.wizard-actions .next').show();
                    $wizard.find('.wizard-actions .finish').hide();
                }

            }
	 });

        wizardBar('#rootwizard .finish').click(function () {

            var form = $("#project_encrypt");
            var action = form.attr('action');
            var datastring = form.serialize();


            $.post(action, datastring).done(function(data) {

                data = $.parseHTML( data );

                $("#tab-4 a[href=#tab4Inspire]").tab('show');

                $("#tab-4 li").addClass('disabled');
                $("#tab-4 li:last").removeClass('disabled');

                $("#tab4Inspire .display_result").html(data);

            }).fail(function() {
                    alert( "error" );

            }).always(function() {

                //$.post('/ncryptd/admin/project', form.serialize());

            });

            e.preventDefault(); //STOP default action
            //e.unbind(); //unbind. to stop multiple form submit.
        });

    });

    $("#tab-4 li").addClass('disabled');
    $("#tab-4 li:first").removeClass('disabled').addClass('active');


    $('#encoding a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#optimization_lock a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#tab-4 a').click(function (e) {

        if($(this).closest("li").hasClass("disabled")){
            e.preventDefault();
            return false;
        }

        e.preventDefault();
        $(this).tab('show');
    })

    /**
    var Switch = require('ios7-switch')
        , checkbox = document.querySelector('.ios')
        , mySwitch = new Switch(checkbox);
    mySwitch.toggle();
    mySwitch.el.addEventListener('click', function(e){
        e.preventDefault();
        mySwitch.toggle();
    }, false);
*/

});	
	 