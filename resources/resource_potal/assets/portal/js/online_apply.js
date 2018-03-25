// Register form validation
var Register = function () {
			
   var onlineRegistration = function() {

        $("#application_form").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            //focusInvalid: false, // do not focus the last invalid input
            //ignore: "",
            rules: {
                'mohal_name': {
                    required: true,  minlength: 3,
                },
                'bidder_name': {
                    required: true,  minlength: 3,
                },
                'guardian_name': {
                    required: true,  minlength: 3,
                },
                'district': {
                    required: true
                },
                'upazila': {
                    required: true
                },
                'post_office': {
                    required: true
                },
                'village_or_road': {
                    required: true,  minlength: 3,
                },
                'holding_no': {
                    required: true,  minlength: 3,
                },
                'proposed_rate': {
                    required: true,  number: true,
                },
                'proposed_text': {
                    required: true,  minlength: 3,
                },
                'pledge_rate': {
                    required: true,  number: true,
                },
                'pledge_text': {
                    required: true,  minlength: 3,
                },
                'bank_name': {
                    required: true,  minlength: 3,
                },
                'bank_draft': {
                    required: true
                },
                'bank_date': {
                    required: true
                },
            },
            // messages: {
            //     "name": "Please type your name",
            //     "password": "Please put your password",
            // },
            // errorPlacement: function (error, element) {
            //     if(element.attr("name") == "dob") error.appendTo("#error_msg1")
            //     else if (element.attr("name") == "gender") error.appendTo("#error_msg2")
            //     else error.insertAfter($(element))
            // },
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
                    console.log(this);
                    //form.submit();
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
        $("#bank_date").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "c-100:c+0"
        });

        /// commitment text
        $("#bank_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

        $('#bidder_name').blur(function(event) {
            $('.commitment_text').find('.value_text.name').text($(this).val());
        });
        $('#guardian_name').blur(function(event) {
            $('.commitment_text').find('.value_text.guardian_name').text($(this).val());
        });
        $('#holding_no').blur(function(event) {
            $('.commitment_text').find('.value_text.holding_no').text($(this).val());
        });
        $('#village_or_road').blur(function(event) {
            $('.commitment_text').find('.value_text.village_or_road').text($(this).val());
        });
        $('#post_office').blur(function(event) {
            $('.commitment_text').find('.value_text.post').text($('option:selected', $(this)).text());
        });
        $('#upazila').blur(function(event) {
            $('.commitment_text').find('.value_text.upazila').text($('option:selected', $(this)).text());
        });
        $('#district').blur(function(event) {
            $('.commitment_text').find('.value_text.district').text($('option:selected', $(this)).text());
        });
        $('#mohal_name').blur(function(event) {
            $('.commitment_text').find('.value_text.mohal_name').text($(this).val());
        });
        /// commitment text end

        $("#reset_form").click(function(event) {
            $("#application_form")[0].reset();
            $("input:checkbox, input:radio").prop('checked', false);
            $("input:checkbox, input:radio").parent('div').removeClass('checked');
            $('.commitment_text').find('.value_text').text('');
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