//banner, data table, accordion, tabs, date picker, color picker, etc.
$(function () {
    setInterval("slideSwitch()", 7200);

    oTable = $('#cypher-dataTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });

    $("#txtEDate").datepicker({
        minDate: new Date(),
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true
    });

    $('.date-range-fields, .not-recieved-range-fields, #txtVExpiry, #txtUpdateExpiryDate').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'
    });

    $('#article-list, #cypher-vmenu').accordion({
        autoHeight: false
    });

    var cssBg = {'background-color': '#ccc'}
    $('#txtVExpiry').css(cssBg);
    $('#txtVExpiry').attr('disabled', true);

    $('#chkEnableExpiry').click(function(){
        if ($(this).is(':checked')) {
            cssBg = {'background-color':'#fff'}
            $('#txtVExpiry').css(cssBg);
            $('#txtVExpiry').attr('disabled', false);
            $('#expiryOption').val('1');
        } else {
            cssBg = {'background-color': '#ccc'}
            $('#txtVExpiry').css(cssBg);
            $('#txtVExpiry').attr('disabled', true);
            $('#expiryOption').val('0');
        }
    });

    $('#chkUpdateExpiryOption').click(function(){
        if ($(this).is(':checked')) {
            cssBg = {'background-color':'#fff'}
            $('#txtUpdateExpiryDate').css(cssBg);
            $('#txtUpdateExpiryDate').attr('disabled', false);
            $('#txtUpdateExpiryOption').val('1');
        } else {
            cssBg = {
                'background-color': '#ccc',
                'border':'solid 1px #999'
            }
            $('#txtUpdateExpiryDate').css(cssBg);
            $('#txtUpdateExpiryDate').val('');
            $('#txtUpdateExpiryDate').attr('disabled', true);
            $('#txtUpdateExpiryOption').val('0');
        }
    });

    //Voucher Content Format
    var chkSaveFormatAs = $('#chkSaveFormatAs');
    chkSaveFormatAs.click(function(){
        if ($(this).is(':checked')) {
            $('#saveFormatAsSection').show();
        } else {
            $('#saveFormatAsSection').hide();
        }
    });

    //Voucher Number
    var voucherNoAlign = $('#selFormatVoucherNoAlign');
    voucherNoAlign.click(function(){
        if($(this).val() == 'left') {
            $('.voucher-no-section').css({'text-align' : 'left'});
        } else if ($(this).val() == 'center') {
            $('.voucher-no-section').css({'text-align' : 'center'});
        } else if ($(this).val() == 'right') {
            $('.voucher-no-section').css({'text-align' : 'right'});
        }
    });

    var voucherNoVerticalAlign = $('#selFormatVerticalVoucherNoAlign');
    voucherNoVerticalAlign.click(function(){
        if($(this).val() == 'top') {
            $('.voucher-no-section').css({'vertical-align' : 'top'});
        } else if ($(this).val() == 'middle') {
            $('.voucher-no-section').css({'vertical-align' : 'middle'});
        } else if ($(this).val() == 'bottom') {
            $('.voucher-no-section').css({'vertical-align' : 'bottom'});
        }
    });

    var voucherNoHeight = $('#txtFormatVoucherNoHeight');
    voucherNoHeight.keyup(function(){
        var voucherNoSectionHeight = $(this).val();
        $('.voucher-no-section').css({'height' : voucherNoSectionHeight + 'px'});
    });

    //Voucher Content
    var designContentWidth = $('#txtDesignContentWidth');
    designContentWidth.keyup(function(){
        var contentWidth = $(this).val();
        $('#design-content').css({'width' : contentWidth + 'px'});
    });

    var templateSections = '#design-template, #design-template table, #design-template table td';
    var showLayoutVerifier = $('#txtShowTemplateLayout');
    if (showLayoutVerifier.val() == '1') {
        $(templateSections).css({'border':'solid 1px red'});
    } else {
        $(templateSections).css({'border':'none'});
    }

    var showLayout = $('#chkShowTemplateLayout');
    showLayout.click(function(){
        if ($(this).is(':checked')) {
            $(templateSections).css({'border':'solid 1px red'});
            showLayoutVerifier.val('1');
        } else {
            $(templateSections).css({'border':'none'});
            showLayoutVerifier.val('0');
        }
    });

    var messageSection = $('#txtFormatContentHeight');
    messageSection.keyup(function(){
        var messageHeight = $(this).val();
        $('.voucher-content-section').css({'height' : messageHeight + 'px'});
    });

    var padLeft = $('#txtDesignContentPadLeft');
    padLeft.keyup(function(){
        var paddingLeft = $(this).val();
        $('.voucher-content-section').css({'padding-left' : paddingLeft + 'px'});
    });

    var padRight = $('#txtDesignContentPadRight');
    padRight.keyup(function(){
        var paddingRight = $(this).val();
        $('.voucher-content-section').css({'padding-right' : paddingRight + 'px'});
    });

    $('#postVoucherMessage').click(function(){
        $('.voucher-content-section').html($('.nicEdit-main').html());
    });

    //Voucher Expiry
    var expiryAlign = $('#selFormatExpiryAlign');
    expiryAlign.click(function(){
        if($(this).val() == 'left') {
            $('.voucher-expiry-section').css({'text-align' : 'left'});
        } else if ($(this).val() == 'center') {
            $('.voucher-expiry-section').css({'text-align' : 'center'});
        } else if ($(this).val() == 'right') {
            $('.voucher-expiry-section').css({'text-align' : 'right'});
        }
    });

    var expiryVerticalAlign = $('#selFormatVerticalExpiryAlign');
    expiryVerticalAlign.click(function(){
        if($(this).val() == 'top') {
            $('.voucher-expiry-section').css({'vertical-align' : 'top'});
        } else if ($(this).val() == 'middle') {
            $('.voucher-expiry-section').css({'vertical-align' : 'middle'});
        } else if ($(this).val() == 'bottom') {
            $('.voucher-expiry-section').css({'vertical-align' : 'bottom'});
        }
    });

    var expiryHeight = $('#txtFormatExpiryHeight');
    expiryHeight.keyup(function(){
        var expiryDateSection = $(this).val();
        $('.voucher-expiry-section').css({'height' : expiryDateSection + 'px'});
    });

    var saveVoucherFormat = $('#saveFormat');
    saveVoucherFormat.click(function(){

        var voucherFields = {
            name: $('#txtUpdateVoucherName').val(),
            contentLayoutWidth: $('#txtDesignContentWidth').val(),
            messageContainer: $('#txtContentVoucherMessage').val(),
            message: $('.nicEdit-main').html(),
            messageVAlign: $('#selFormatVerticalContentAlign').val(),
            messageSectionHeight: $('#txtFormatContentHeight').val(),
            messagePadLeft: $('#txtDesignContentPadLeft').val(),
            messagePadRight: $('#txtDesignContentPadRight').val(),
            voucherNoHAlign: $('#selFormatVoucherNoAlign').val(),
            voucherNoVAlign: $('#selFormatVerticalVoucherNoAlign').val(),
            voucherNoSectionHeight: $('#txtFormatVoucherNoHeight').val(),
            expiryHAlign: $('#selFormatExpiryAlign').val(),
            expiryVAlign: $('#selFormatVerticalExpiryAlign').val(),
            expirySectionHeight: $('#txtFormatExpiryHeight').val(),
            expiryDateLabel: $('#txtUpdateExpiryLabel').val(),
            expiryDate: $('#txtUpdateExpiryDate').val(),
            expiryOption: $('#txtUpdateExpiryOption').val(),
            Process: $('#Process').val(),
            EntryID: $('#EntryID').val()
        }

        if (voucherFields.txtVName == '') {
            alert('Please provide a voucher name');
            $('#txtUpdateVoucherName').focus();
        } else {
            var urlString = "../admin/common/q_voucher.php";
            submitData( voucherFields, urlString);
        }
    });

    var saveVoucherFormatAs = $('#saveFormatAs');
    saveVoucherFormatAs.click(function(){

        var saveAsFields = {
            name: $('#txtUpdateVoucherName').val(),
            selVOccasion: $('#voucherOccasion').text(),
            DesignFile: $('#templateFile').text(),
            contentLayoutWidth: $('#txtDesignContentWidth').val(),
            messageContainer: $('#txtContentVoucherMessage').val(),
            message: $('.nicEdit-main').html(),
            messageVAlign: $('#selFormatVerticalContentAlign').val(),
            messageSectionHeight: $('#txtFormatContentHeight').val(),
            messagePadLeft: $('#txtDesignContentPadLeft').val(),
            messagePadRight: $('#txtDesignContentPadRight').val(),
            voucherNoHAlign: $('#selFormatVoucherNoAlign').val(),
            voucherNoVAlign: $('#selFormatVerticalVoucherNoAlign').val(),
            voucherNoSectionHeight: $('#txtFormatVoucherNoHeight').val(),
            expiryHAlign: $('#selFormatExpiryAlign').val(),
            expiryVAlign: $('#selFormatVerticalExpiryAlign').val(),
            expirySectionHeight: $('#txtFormatExpiryHeight').val(),
            expiryDateLabel: $('#txtUpdateExpiryLabel').val(),
            expiryDate: $('#txtUpdateExpiryDate').val(),
            expiryOption: $('#txtUpdateExpiryOption').val(),
            Process: "SaveAs",
            EntryID: $('#EntryID').val(),
            saveFormatAs: $('#txtSaveFormatAs').val()
        }

        if (saveAsFields.saveFormatAs == '' && $('#chkSaveFormatAs').is(':checked')) {
            alert('Please provide a new voucher name');
            $('#saveFormatAsSection').show();
            $('#txtSaveFormatAs').focus();

        } else {
            var urlString = "../admin/common/q_voucher.php";
            submitData( saveAsFields, urlString);
        }
    });

    //========================
    $('#cypher-VoucherSubmit').click(function(){
        var newVoucherFields = {
            name: $('#txtVName').val(),
            selVOccasion: $('#selVOccasion').val(),
            selVDesign: $('#selVDesign').val(),
            expiryDateLabel: $('#txtVExpiryLabel').val(),
            expiryOption: $('#expiryOption').val(),
            expiryDate: $('#txtVExpiry').val(),
            Process: $('#Process').val()
        }

        if (newVoucherFields.name == "") {
            alert("Please provide a value for Voucher Name!");
            $('#txtVName').focus();
        } else if (newVoucherFields.selVOccasion == "0") {
            alert("Please select an Occasion!");
            $('#selVOccasion').focus();
        } else if (newVoucherFields.selVDesign == "0") {
            alert("Please select a Template!");
            $('#selVDesign').focus();
        } else if ( $('#chkEnableExpiry').is(':checked') == true && newVoucherFields.expiryDate == "") {
            alert("Please provide an Expiry Date!");
            $('#txtVExpiry').focus();
        } else {
            var urlString = "../admin/common/q_voucher.php";
            submitData( newVoucherFields, urlString);
        }
    });

    //========================

});

//fancybox
$(document).click(function () {
    $(".gallery-image").each(function (i) {
        var linkID = $(this).find("a").attr("id");
        var formLinkID = "#" + linkID;

        $(formLinkID).fancybox({
            'padding': 4,
            'autoScale': false,
            'showCloseButton': true,
            'titlePosition': 'inside',
            'centerOnScroll': true
        });
    });
});
//wysiwyg
bkLib.onDomLoaded(function () {
    nicEditors.allTextAreas({
        maxHeight: 500,
        buttonList: ['bold', 'italic', 'underline', 'left', 'center', 'right', 'image', 'upload', 'link', 'unlink', 'forecolor', 'fontFamily', 'fontSize']
    });
});

function submitData (dataCollection, urlString) {
    $.ajax({
        type: "POST",
        url: urlString,
        data: dataCollection
    }).done(function( result ) {
        var notif = $('.notification').html(result);
        var process = notif.find('div').attr('id');
        if (process == "FormatVoucher") {
            var format = confirm("Voucher created successfully. Do you want to format it now?");
            if (format) {
                var findFormatId = notif.find('a').attr('id');
                if (findFormatId == 'formatYes') {
                    var formatHref = notif.find('a').attr('href');
                    window.location=formatHref;
                }
            } else {
                alert("A Voucher was created but formatting was cancelled. Please format the voucher as soon as possible");
            }
        } else if (process == "SaveAs") {
            findFormatId = notif.find('a').attr('id');
            if (findFormatId == 'newItem') {
                formatHref = notif.find('a').attr('href');
                alert(notif.find('a').text());
                window.location=formatHref;
            }
        } else {
            alert($('.notification').text());
            location.reload();
        }
    });
}