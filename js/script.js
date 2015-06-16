var uniqueIdIndex = 0;

function generateUniqueId (prefix){
    if (prefix == undefined || prefix == null || prefix == '') {
        prefix = "auto-generate-"
    }

    var uniqueId;
    // check id is exists
    do {
        uniqueIdIndex++;
        uniqueId = prefix + uniqueIdIndex;
    } while (jQuery('#' + uniqueId).length > 0);

    return uniqueId;
}

//region custom chosen
// see more: http://harvesthq.github.io/chosen/options.html
var $customChosen = jQuery('.custom-select-chosen-js').chosen({
    //disable_search_threshold: 10,
    width: '100%'
});

var $customMultiChosen = jQuery('.custom-multi-select-chosen-js').chosen({
    width: '100%'
});

$customChosen.next().addClass('chosen--consapp');
$customMultiChosen.next().addClass('chosen--consapp');
//endregion custom chosen

//region Calendar Norm
if ($(".norm-end-date-calendar-js").val() != '') {
    var maxDate = new Date($(".end-date-calendar-js").val());
    maxDate.setDate(maxDate.getDate() - 1);
    $(".norm-start-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        maxDate: maxDate,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $(".norm-end-date-calendar-js").datepicker("option", "minDate", dt);
        }
    });
} else {
    $(".norm-start-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $(".norm-end-date-calendar-js").datepicker("option", "minDate", dt);
        }
    });
}

if ($(".norm-start-date-calendar-js").val() != '') {
    var minDate = new Date($(".start-date-calendar-js").val());
    minDate.setDate(minDate.getDate() - 1);
    $(".norm-end-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        minDate: minDate,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $(".norm-start-date-calendar-js").datepicker("option", "maxDate", dt);
        }
    });
} else {
    $(".norm-end-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $(".norm-start-date-calendar-js").datepicker("option", "maxDate", dt);
        }
    });
}
// endregion Calendar pop-up

//region Calendar pop-up
if ($(".end-date-calendar-js").val() != '') {
    var maxDate = new Date($(".end-date-calendar-js").val());
    maxDate.setDate(maxDate.getDate());
    $(".start-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        maxDate: maxDate,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $(".end-date-calendar-js").datepicker("option", "minDate", dt);
        }
    });
} else {
    $(".start-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $(".end-date-calendar-js").datepicker("option", "minDate", dt);
        }
    });
}

if ($(".start-date-calendar-js").val() != '') {
    var minDate = new Date($(".start-date-calendar-js").val());
    minDate.setDate(minDate.getDate());
    $(".end-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        minDate: minDate,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $(".start-date-calendar-js").datepicker("option", "maxDate", dt);
        }
    });
} else {
    $(".end-date-calendar-js").datepicker({
        dateFormat: 'yy/mm/dd',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $(".start-date-calendar-js").datepicker("option", "maxDate", dt);
        }
    });
}
// endregion Calendar pop-up

//region text counter
jQuery('.text-counter-js').each(function () {
    var maxLength = jQuery(this).attr('maxlength');
    if (jQuery.isNumeric(maxLength) && maxLength > 0) {
        jQuery(this).textareaCount({
            'maxCharacterSize': maxLength,
            'originalStyle': 'text-right',
            'warningStyle': 'text-warning custom-error-message',
            'warningNumber': 10,
            'displayFormat': '#input/#max | #words words'
        });
    }
});

if (typeof (company_list) != 'undefined') {
    $('.company-name-report-filter-js').autocomplete({
        source: company_list
    });
}
//endregion text counter

//region Error message
function generate_error_handle(data) {
    if (data.length > 4) {
        var message = JSON.parse(data);
        for (var k = 0; k < message.length; k++) {
            var name, content;
            if (Array.isArray(message[k])) {
                name = message[k][0].id;
                content = message[k][0].content;
            } else {
                name = message[k].id;
                content = message[k].content;
            }

            var $currentInput = jQuery('.well form [name="' + name + '"], .error-js [name="' + name + '"]').last();
            var $selector = $currentInput;
            if ($selector.length > 0) {
                if ($selector.is('[type="radio"]')) {
                    $selector = $selector.closest('.radio');
                } else if ($selector.is('[type="checkbox"]')) {
                    $selector = $selector.closest('.checkbox');
                } else if ($selector.closest('.input-group').length > 0) {
                    $selector = $selector.closest('.input-group');
                }
            } else {
                $currentInput = jQuery('.well form [name="' + name + '[]"]').first();
                if ($currentInput.length > 0) {
                    if ($currentInput.next().hasClass('chosen-container')) {
                        $selector = $currentInput.next();
                    } else {
                        $selector = $currentInput;
                    }
                }
            }

            if ($selector.length > 0) {
                $selector.after(content);
            }
        }
    }
}

function generate_error_participant(id, data) {
    if (data != '') {
        var message = data;
        for (var k = 0; k < message.length; k++) {
            var name, content;
            if (Array.isArray(message[k])) {
                name = message[k][0].id;
                content = message[k][0].content;
            } else {
                name = message[k].id;
                content = message[k].content;
            }

            if (name == 'NM_PARTICIPANT') {
                $('#NM_PARTICIPANT_span_' + id).after(content);
            } else if(name == 'NM_EMAIL'){
                $('#NM_EMAIL_span_' + id).after(content);
            }

        }
    }
}
//endregion Error message

//region GAP

function saveGap(e) {
    var gapObj = {};
    var parentElement = e.parents('tr');
    gapObj['survey_id'] = parentElement.attr('data-survey-id');
    gapObj['question_id'] = parentElement.attr('data-question-id');
    gapObj['text'] = e.val();
    gapObj['type'] = e.attr('text_type');
    $('.gap-submit-js').attr('disabled', 'disabled');
    $.ajax({
        type: "POST",
        url: configs.site_url + "/survey/save_new_gap_recommendation",
        data: {gap_info: gapObj},
        dataType: "json",
        success: function (data) {
            $('.gap-submit-js').removeAttr('disabled');
        }
    });
}

$('.reset-gap-js').click(function () {
    var $textRecommend = $(this).closest('tr').find('.recommendation');
    $textRecommend.val($textRecommend.attr('data-default-value'));
    saveGap($textRecommend);
    $textRecommend.first().focus();

    return false;
});

$('.delete-profile-view-report-js').click(function () {
    var redirect_link = $(this).attr('href');
    var deleteConfirm = confirm('Are you sure to delete this survey?');
    if (deleteConfirm) {
        window.location.href = redirect_link;
    }

    return false;
});

$('.text-input-gap-js').on('change paste', function () {
    saveGap($(this));
});

//*endregion GAP

jQuery('#add-officer').click(function(){
    var htmlString = $( "#div-add-officer" ).html();
    var $group = jQuery('<div class="form-group officer-active-js"></div>');
    $group.html(htmlString);
    jQuery(".officer-active-js:last").after($group);

    var $select = $group.find('.add-officer-select-js');
    var idPrefix = $select.attr('id');
    var id = generateUniqueId(idPrefix);
    $select.attr('id', id);
    var $labelSelect = $group.find('label:eq(0)');
    $labelSelect.attr('for', id);
    var varChosen = $select.chosen({
        width: '100%'
    });
    varChosen.next().addClass('chosen--consapp');

    $group.find('.remove-officer-js').click(function () {
        jQuery(this).closest('.officer-active-js').remove();

        return false;
    });

    return false;
});

jQuery('.remove-officer-js:visible').click(function () {
    jQuery(this).closest('.officer-active-js').remove();

    return false;
});

if (jQuery('#search-results-management-reports').length == 1) {
    var colNoWrapArr = [
        true, true, true, true, true, true, true, true, true, true /*10*/,
        true, true, true, true, true, true, true, true, true, false /*20*/,
        true, true, false, false, false, false, false, false, false, false /*30*/,
        false, false, false, false, false, false, false, false, false, false /*40*/,
        false, false, false, false, false, false, false, false, false, false /*50*/,
        false, false, false, false, false, false, false, false, false, false /*60*/,
        false, false, false, false, false, false, false, false, false, false /*70*/,
        false, false, false, false, false, false, false, false, false, false /*80*/,
        false, false, false, false, false, false, false, true, true, true /*90*/
    ];
    jQuery('#search-results-management-reports').find('thead th').each(function (index, element) {
        if (colNoWrapArr[index] > false) {
            jQuery(element).addClass('text-nowrap');
        }
    });
}

jQuery(document).ready(function ($) {
    /* Get setting error display */
    var errorTimeout = 3000;
    if (typeof configs != 'undefined' && configs.errorFlag > 0) {
        /* Display error message */
        $('#notify-container-top').remove();
        var $notification = jQuery('<div id="notify-container-top" class="notify-container"><div class="notify-message">' + configs.errorMess + '</div></div>');
        var customClass = '';
        if (configs.typeMess == 'success') {
            customClass = 'notify-success';
        } else if (configs.typeMess == 'warning') {
            customClass = 'notify-warning';
        } else {
            customClass = 'notify-error';
        }

        if (customClass != '') {
            $notification.addClass(customClass);
        }

        $('body').prepend($notification);
        $notification.slideDown(function () {
            $notification.click(function () {
                $notification.slideUp(function () {
                    $notification.remove();
                });
            });

            setTimeout(function () {
                $notification.slideUp(function () {
                    $notification.remove();
                });
            }, errorTimeout);
        });
    }

    /* Generate error message */
    generate_error_handle(configs.listOfErrors);
    $('#delete-edit-user').click(function () {
        var id = $('input[name="id_user"]').val();
        var redirect_link = configs.site_url + '/users/delete/' + id;
        var deleteConfirm = confirm('Are you sure to delete this user?');
        if (deleteConfirm) {
            window.location.href = redirect_link;
        }

        return false;
    });

    $('.submit-deleted').click(function () {
        var select_status = $('select[name=nm_status]').val();
        if (select_status == 1) {
            var deleteConfirm = confirm('You want to change Status to Deleted?');
            if (deleteConfirm) {
                $('.form-horizontal').submit();
            } else {
                return false;
            }
        }
    });

    $('#update_submit').click(function () {
        var if_delete = $('select[name=ID_STATUS]').val();
        if (if_delete == 2) {
            var deleteConfirm = confirm('Are you sure to delete this session?');
            if (!deleteConfirm) {
                return false;
            }
        }

        $(".form-horizontal").submit();
    });

    $('.active.stage_6,.completed.stage_6').click(function () {
        // var id_company_info = $(this).attr('company');
        // var redirect_link = configs.site_url + '/survey/close/' + id_company_info;
        var deleteConfirm = confirm('Are you sure to close this survey?');
        if (!deleteConfirm) {
            return false;
        }
        // window.location.href = redirect_link;
    });

    if (typeof (company_list) != 'undefined') {
        $('#home-input-js').autocomplete({
            source: company_list
        });
    }

    // Home - index javascript


    //Participants - filters javascript
    if (typeof page != 'undefined') {
        if (page != '' && page == 'participants-filters') {
            $('.save-btn').click(function () {
                var id = $(this).closest('td').find('[name=participant_id]').val();
                var name = $('.name_' + id).val();
                var email = $('.email_' + id).val();
                var org = $('select[name=org_' + id + ']').val();
                var obj = {NM_PARTICIPANT: name, NM_EMAIL: email, NM_ORGANISATION: org, id: id};
                $('.custom-error-message').hide();
                $.ajax({
                    type: "POST",
                    url: configs.site_url + "/participants/edit",
                    data: obj,
                    dataType: "json",
                    success: function (data) {
                        if (typeof data[0] != 'undefined') {
                            $('.span_' + id).hide();
                            $('.createac-btn-' + id).hide();
                            $('.name_' + id).show();
                            $('.email_' + id).show();
                            $('.edit_' + id).show();
                            $('.save-cancel-' + id).show();
                            $('.edit-btn-' + id).hide();
                            generate_error_participant(id, data);
                        } else {
                            update_field(id, data);
                        }
                    }
                });
            });
            $('#participant-add-js').click(function() {
                $('#participant-add-js').attr('disabled', true);
                $('#form-participants-filters').submit();
                return false;

            });
            $('#remove-selected-list-participants').click(function () {
                var id_string = '';
                $("input:checkbox").each(function () {
                    var $this = $(this);
                    if ($this.is(":checked")) {
                        if (id_string != '') {
                            id_string += ',';
                        }

                        id_string += $this.attr("id");
                    }
                });
                if (id_string == '') {
                    alert('Please select participant to delete!');

                    return false;
                }

                var removeConfirm = confirm('Are you sure to delete this participant?');
                if (removeConfirm) {
                    var after = $.ajax({
                        type: "POST",
                        url: configs.site_url + "/participants/remove",
                        data: {data: id_string},
                        //dataType: "json",
                        success: function (data) {
                            location.reload();
                        }
                    });

                }

                return false;
            });

            function update_field(id, json_data) {
                $('.span').show();
                $('.edit').hide();
                $('.save-cancel').hide();
                $('.edit-btn').show();
                $('.createac-btn').show();
                $('#name_span_' + id).text(json_data.NM_PARTICIPANT);
                $('#org_span_' + id).text(json_data.NM_ORGANISATION);
                $('#email_span_' + id).text(json_data.NM_EMAIL);

                return false;
            }

            $('.edit-btn').click(function () {
                var id = $(this).closest('td').find('[name=participant_id]').val();
                var ten = '#org_span_'+id;
                var selected = $('#org_span_'+id).html();
                $('.org-'+id).val(selected);
                var old_name = $('#name_span_' + id).html();
                var old_email = $('#email_span_' + id).html();
                $('.custom-error-message').hide();
                $('.name_' + id).val(old_name);
                $('.email_' + id).val(old_email);
                $('.span').show();
                $('.createac-btn').show();
                $('.edit-btn').show();
                $('.edit').hide();
                $('.save-cancel').hide();
                $('.span_' + id).hide();
                $('.createac-btn-' + id).hide();
                $('.name_' + id).show();
                $('.email_' + id).show();
                $('.edit_' + id).show();
                $('.save-cancel-' + id).show();
                $('.edit-btn-' + id).hide();

                return false;
            });

            $('.cancel-btn').click(function () {
                $('.custom-error-message').hide();
                $('.add_part').removeAttr('style');
                $('.span').show();
                $('.edit').hide();
                $('.save-cancel').hide();
                $('.edit-btn').show();
                $('.createac-btn').show();

                return false;
            });
        }

        if (page != '' && page == 'company-filter') {
            if (typeof (company_ac) != 'undefined') {
                $('#company-info').autocomplete({
                    source: company_ac
                });
            }

        }
    }

    //$('body').bind('DOMMouseScroll', function(e){
    //    if(e.originalEvent.detail > 0) {
    //        //scroll down
    //        $('.tracking-menu').slideUp();
    //    }else {
    //        //scroll up
    //        $('.tracking-menu').slideDown();
    //    }
    //
    //    //prevent page fom scrolling
    //    //return false;
    //});
    //
    ////IE, Opera, Safari
    //$('body').bind('mousewheel', function(e){
    //    if(e.originalEvent.wheelDelta < 0) {
    //        //scroll down
    //        $('.tracking-menu').slideUp();
    //    }else {
    //        //scroll up
    //        $('.tracking-menu').slideDown();
    //    }
    //
    //    //prevent page fom scrolling
    //    //return false;
    //});
});
