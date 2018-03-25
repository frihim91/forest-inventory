// Register form validation
var Register = function () {
			
   var onlineRegistration = function() {

        $("#reg_form").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            //focusInvalid: false, // do not focus the last invalid input
            //ignore: "",
            rules: {
                'name': {
                    required: true,  minlength: 3,
                },
                mobile: {
                    required: true, minlength: 11, maxlength: 14,
                },
                email: {
                    required: true, email: true,
                },
                password: {
                    required: true, minlength: 6,
                },
                repassword: {
                    required: true, minlength: 6, equalTo : "#password"
                },
                dob: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                nid: {
                    required: true,
                },
                message: {
                    required: true,
                }
            },
            // messages: {
            //     "name": "Please type your name",
            //     "password": "Please put your password",
            // },
            errorPlacement: function (error, element) {
                if(element.attr("name") == "dob") error.appendTo("#error_msg1")
                else if (element.attr("name") == "gender") error.appendTo("#error_msg2")
                else error.insertAfter($(element))
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('form-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('form-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('form-error'); // set success class to the control group
            },
            submitHandler: function (form, event) {  
                event.preventDefault();
                if (form) {
                    form.submit();
                }
            }
        });

    }

    var icheckCheckbox = function() {
        $('.iech').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });
    }


    var basicOperations = function() {
        $("#dob").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "c-100:c+0"
        });

        $("#dob").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

        $("#reset_form").click(function(event) {
            $("#reg_form")[0].reset();
            $("input:checkbox, input:radio").prop('checked', false);
            $("input:checkbox, input:radio").parent('div').removeClass('checked');
        });


    }

    return {
        //main function to initiate the module
        init: function () {
            onlineRegistration();
            icheckCheckbox();
            basicOperations();
        }

    };

}();