$(document).ready(function() {

    $('select').select2();

    $("#is_master").click(function() {
        if($(this).is(":checked")) {
            $('#md_1').attr('required', true);
            $('#with_1').attr('required', true);
            $('#year_2').attr('required', true);
            $('#school_2').attr('required', true);
            $('#master_div').show();
        } else {
            $('#md_1').attr('required', false);
            $('#with_1').attr('required', false);
            $('#year_2').attr('required', false);
            $('#school_2').attr('required', false);
            $('#master_div').hide();
        }
    });

    $("#is_doctorate").click(function() {
        if($(this).is(":checked")) {
            $('#doctorate').attr('required', true);
            $('#with_2').attr('required', true);
            $('#year_3').attr('required', true);
            $('#school_3').attr('required', true);
            $('#doctorate_div').show();
        } else {
            $('#doctorate').attr('required', false);
            $('#with_2').attr('required', false);
            $('#year_3').attr('required', false);
            $('#school_3').attr('required', false);
            $('#doctorate_div').hide();
        }
    });

    $("#other_degree").click(function() {
        if($(this).is(":checked")) {
            $('#other').attr('required', true);
            $('#year_4').attr('required', true);
            $('#school_4').attr('required', true);
            $('#other_div').show();
        } else {
            $('#other').attr('required', false);
            $('#year_4').attr('required', false);
            $('#school_4').attr('required', false);
            $('#other_div').hide();
        }
    });


    $('#btn_save').click(function(e){

        form_data = new FormData();

        if( $('#create_form').find(":required:not(:valid)").length > 0 ) {

            $('.tab-pane.active').removeClass('active')
            $($('#create_form').find(":required:not(:valid)")[0]).closest('.tab-pane').addClass('active')
            var tabselected = $($('#add_form').find(":required:not(:valid)")[0]).closest('.tab-pane').attr('id')
            $('.nav-tabs li.active').removeClass('active')
            $('.nav-tabs li[data-tab="'+ tabselected +'"]').addClass('active')
            $($('#create_form').find(":required:not(:valid)")).addClass('invalid-input')
            $($('#create_form').find(":required:not(:valid)")).next('.select2').find('.select2-selection').addClass('invalid-input')
            $($('#create_form').find(":required:not(:valid)")).change(function(e){
                if( $.trim($(this).val()).length > 0 )
                    $(this).removeClass('invalid-input')
                    $(this).next('.select2').find('.select2-selection').removeClass('invalid-input')
            })

            return;
        }  


        //basic information
        var first_name    = $("#first_name").val();
        var middle_name   = $("#middle_name").val();
        var last_name     = $("#last_name").val();
        var sex           = $("#sex").val();
        var email         = $("#email").val();
        var address       = $("#address").val();
        var status        = $("#status").val();
        var mobile       = $("#mobile").val();
        var date_birth        = $("#date_birth").val();
        var place_birth       = $("#place_birth").val();
        var personnel_position        = $("#personnel_position").val();
        var personnel_department       = $("#personnel_department").val();
        var personnel_academic        = $("#personnel_academic").val();
        var type_emp       = $("#type_emp").val();
        var emp_status       = $("#emp_status").val();
        var date_appointment        = $("#date_appointment").val();
        var plantilla        = $("#plantilla").val();
        var eligibility       = $("#eligibility").val();
        var tin_no        = $("#tin_no").val();
        var gsis_no       = $("#gsis_no").val();
        var pagibig_no        = $("#pagibig_no").val();

        //edicational information
        var bs_1         = $("#bs_1").val();
        var year_1    = $("#year_1").val();
        var school_1   = $("#school_1").val();
        var md_1     = $("#md_1").val();
        var with_1           = $("#with_1").val();
        var year_2         = $("#year_2").val();
        var school_2       = $("#school_2").val();
        var doctorate        = $("#doctorate").val();
        var with_2       = $("#with_2").val();
        var year_3        = $("#year_3").val();
        var school_3       = $("#school_3").val();
        var other        = $("#other").val();
        var year_4       = $("#year_4").val();
        var school_4        = $("#school_4").val();

        var is_master      = $("#is_master").is(":checked");
        var is_doctorate    = $("#is_doctorate").is(":checked");
        var other_degree  = $("#other_degree").is(":checked");

        form_data.append("first_name", first_name);
        form_data.append("middle_name", middle_name);
        form_data.append("last_name", last_name);
        form_data.append("sex", sex);
        form_data.append("email", email);
        form_data.append("address", address);
        form_data.append("status", status);
        form_data.append("mobile", mobile);
        // form_data.append("product_image", document.getElementById('product_image').files[0]);
        form_data.append("date_birth", date_birth);
        form_data.append("place_birth", place_birth);
        form_data.append("personnel_position", personnel_position);
        form_data.append("personnel_department", personnel_department);
        form_data.append("personnel_academic", personnel_academic);
        form_data.append("emp_status", type_emp);
        form_data.append("emp_status", emp_status);
        form_data.append("date_appointment", date_appointment);
        form_data.append("plantilla", plantilla);
        form_data.append("eligibility", eligibility);
        form_data.append("tin_no", tin_no);
        form_data.append("gsis_no", gsis_no);
        form_data.append("pagibig_no", pagibig_no);

        form_data.append("is_master", is_master);
        form_data.append("is_doctorate", is_doctorate);
        form_data.append("other_degree", other_degree);

        form_data.append("bs_1", bs_1);
        form_data.append("year_1", year_1);
        form_data.append("school_1", school_1);
        form_data.append("md_1", md_1);
        form_data.append("with_1", with_1);
        form_data.append("year_2", year_2);
        form_data.append("school_2", school_2);
        form_data.append("doctorate", doctorate);
        form_data.append("with_2", with_2);
        form_data.append("year_3", year_3);
        form_data.append("school_3", school_3);
        form_data.append("other", other);
        form_data.append("year_4", year_4);
        form_data.append("school_4", school_4);

        $.ajax({
            url : ('products/physical/ajax/products/create'),
            contentType : false,
            cache     : false,
            processData : false,
            async     : false,
            data    : form_data,
            dataType : 'json',
            method : 'POST',
            success : function(response) {
                if(!response.status) {
                    location.reload();
                }
                else {
                    window.location.href="<?php echo base_url('products/physical/products') ?>";
                }
            }
        })


    });



});