(function($) {
    $(document).ready(function(e) {
        /*
            Modal Controller for Creating
         */
          /*
            Modal Controller for Editing
         */
        $("#da-appsetting-edit-form-div").dialog({
            autoOpen: false,
            title: "Ubah App Setting",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-appsetting-edit-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-appsetting-edit-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				jenjang: {
                    required: true
                },
				status: {
                    required: true
                }
            },
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = 'Atribut yang diberi tanda wajib diisi.';
                    $("#da-appsetting-edit-validate-error").html(message).show();
                } else {
                    $("#da-appsetting-edit-validate-error").hide();
                }
            }
        });

        $(".da-appsetting-edit-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-appsetting-edit-form-div").dialog("option", {modal: true}).dialog("open");
            //$("#appsetting-edit-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            var id = $(this).data("value");
            $.get( "/AppSetting/get_appsetting_by_id/" + id, function(data) {
                $("#appsetting-edit-id").val(id);
                $("#appsetting-edit-pembukaan").val(data.tanggal_pembukaan);
                $("#appsetting-edit-penutupan").val(data.tanggal_penutupan);
                $("#appsetting-edit-status").val(data.status_rekrutmen);
                $("#appsetting-edit-pengumuman").val(data.text_pengumuman);
                
            }, "json" );
        });

    });
}) (jQuery);