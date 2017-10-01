jQuery(document).ready(function ($) {
    "use strict";

    $(".stm-s-wrapper label").on("click", function () {
        $(this).closest("ul").find("li.active").removeClass("active");
        $(this).closest("li").addClass("active");
    });

    $(".stm-color-selector").wpColorPicker({
        change: _.throttle(function () {
            $(this).trigger('change');
        })
    });

    $(".stm_iconpicker").fontIconPicker({
        theme: "fip-bootstrap",
        emptyIcon: false,
        source: stm_icons_array
    });

    $(".stm-multiple-checkbox-wrapper input[type='checkbox']").on("change", function () {

        var checkbox_values = jQuery(this).parents(".customize-control").find("input[type='checkbox']:checked").map(function () {
            return this.value;
        }).get().join(",");

        $(this).parents(".stm-multiple-checkbox-wrapper").find("input[type='hidden']").val(checkbox_values).trigger("change");
    });

    $(".stm-socials-wrapper input[type='text']").on("change, keyup", function () {

        var data = $(this).closest("form").serialize();

        $(this).parents('.stm-socials-wrapper').find('input[type="hidden"]').val(data).trigger('change');
    });

    var bg_image = $("#customize-control-bg_image input");
    var site_layout_checked = $("#customize-control-site_boxed input:checked");

    wp.customize('site_boxed', function (value) {
        value.bind(function (to) {
            if (to) {
                $("#customize-control-bg_image").show();
                $("#customize-control-custom_bg_image").show();
            } else {
                $("#customize-control-bg_image").hide();
                $("#customize-control-custom_bg_image").hide();
            }
        });
    });

    if (site_layout_checked.val()) {
        $("#customize-control-bg_image").show();
        $("#customize-control-custom_bg_image").show();
    } else {
        $("#customize-control-bg_image").hide();
        $("#customize-control-custom_bg_image").hide();
    }

    bg_image.on('change', function () {
        $(".theme_bg li.active").removeClass('active');
        $(this).closest('li').addClass('active');
    });

    $("#customize-control-bg_image input[name='bg_image']:checked").closest('li').addClass('active');

    if($('#site_skin').val() != 'skin_custom') {
        $('#customize-control-site_skin_base_color, #customize-control-site_skin_secondary_color, #customize-control-site_skin_third_color').hide();
    }

    $('#site_skin').on('change', function(){
        if($(this).val() == 'skin_custom') {
            $('#customize-control-site_skin_base_color, #customize-control-site_skin_secondary_color, #customize-control-site_skin_third_color').show();
        }else{
            $('#customize-control-site_skin_base_color, #customize-control-site_skin_secondary_color, #customize-control-site_skin_third_color').hide();
        }
    });

    var $topBarContactFields = $("#customize-control-top_bar_contact_separator_1," +
        "#customize-control-top_bar_contact_address," +
        "#customize-control-top_bar_contact_address_icon," +
        "#customize-control-top_bar_contact_separator_2," +
        "#customize-control-top_bar_contact_email," +
        "#customize-control-top_bar_contact_email_icon," +
        "#customize-control-top_bar_contact_separator_3," +
        "#customize-control-top_bar_contact_phone," +
        "#customize-control-top_bar_contact_phone_icon");


    var $toBarMetaFields = $("#customize-control-stm_work_hours_l13," +
        "#customize-control-stm_work_hours_l13_icon," +
        "#customize-control-top_bar_socials_l13," +
        "#customize-control-top_bar_search_l13"
    );

    var topBarInfoField = function( id ) {
        return $("#customize-control-top_bar_info_"+ id +"_office," +
            "#customize-control-top_bar_info_"+ id +"_address," +
            "#customize-control-top_bar_info_"+ id +"_address_icon," +
            "#customize-control-top_bar_info_"+ id +"_hours," +
            "#customize-control-top_bar_info_"+ id +"_hours_icon," +
            "#customize-control-top_bar_info_"+ id +"_phone," +
            "#customize-control-top_bar_info_"+ id +"_phone_icon," +
            "#customize-control-top_bar_info_"+ id +"_separator");
    };

    if( $("#stm-customize-control-header_style #header_style").val() != 'header_style_6' && $("#stm-customize-control-header_style #header_style").val() != 'header_style_8' ) {
        $topBarContactFields.hide();
    } else {
        for(var i = 1; i < 11; i++) {
            topBarInfoField(i).hide();
        }
    }

    $("#stm-customize-control-header_style #header_style").on("change", function() {
       if( $(this).val() == 'header_style_6' || $(this).val() == 'header_style_8') {
           $topBarContactFields.show();

           for(var i = 1; i < 11; i++) {
               topBarInfoField(i).hide();
           }
       } else {
           $topBarContactFields.hide();

           for(var i = 1; i < 11; i++) {
               topBarInfoField(i).show();
           }
       }
    });

    if($('#top_bar_style').length) {
        if($('#top_bar_style').val() == 'style_1') {
            for(var i = 1; i < 11; i++) {
                topBarInfoField(i).hide();
            }
        } else {
            $toBarMetaFields.hide();
        }
        $("#stm-customize-control-header_style #header_style").on("change", function() {
            if( $(this).val() == 'header_style_4' && $('#top_bar_style').val() == 'style_1' ) {
                $toBarMetaFields.show();
                $topBarContactFields.hide();
                for(var i = 1; i < 11; i++) {
                    topBarInfoField(i).hide();
                }
            } else if($(this).val() == 'header_style_4' && $('#top_bar_style').val() == 'style_2') {
                $toBarMetaFields.hide();
                $topBarContactFields.hide();
                for(var i = 1; i < 11; i++) {
                    topBarInfoField(i).show();
                }
            } else {
                $toBarMetaFields.hide();
            }
        });

        $("#stm-customize-control-top_bar_style #top_bar_style").on("change", function() {
            $topBarContactFields.hide();
            if($(this).val() == 'style_1') {
                $toBarMetaFields.show();
                for(var i = 1; i < 11; i++) {
                    topBarInfoField(i).hide();
                }
            } else {
                $toBarMetaFields.hide();
                for(var i = 1; i < 11; i++) {
                    topBarInfoField(i).show();
                }
            }
        })
    }

	// WPML
	$("#wpml_switcher").on("change", function() {
		$("#customize-control-wpml_switcher_style").slideToggle();
	});

	if ($("#wpml_switcher").prop("checked")) {
		$("#customize-control-wpml_switcher_style").show();
	} else {
		$("#customize-control-wpml_switcher_style").hide();
	}

});