var dir = 'Casellas2';
var host = window.location.hostname;
var page, sitehost;

if (host == 'localhost') {
    //sitehost = 'http://' + host + '/' + dir + '/';
    sitehost = location.href;
} else if (host == '203.59.223.161'){
    sitehost = 'http://' + host + ':83/' + dir + '/';
} else {
    sitehost = 'http://' + host + '/';
}

$(document).ready(function () {
    var title = 'Casellas Wine - Tapas - Grill';
    var copyrightYear = footerDate( '2012' );
    var logoUrl = $('#Logo').find('a');
    var postUrlString;

    logoUrl.attr({
        href: sitehost,
        title: title
    });

    /*Banner Animation*/
    var quoteImg = $("img.quote-img");
    quoteImg.hover(
        function() {
            $(this).stop().animate({
                "opacity": "0"
            }, "slow");
        },
        function() {
            $(this).stop().animate({
                "opacity": "1"
            }, "slow");
        });

    /*Critics Review Links*/
    $(".acc-link a").click(function() {
        var url = $(this).attr('href');
        window.open(url, '_blank');
    });

    /*Copyright Footer Date*/
    $('#footer-date').text( copyrightYear );
    $('#footer-title').text( title );
    
    /*Form Notification Messages*/
    var notifMsg = "Please provide";
    var invalidEmailMsg = "The E-mail Address you have provided is not valid! Try again!";

    /*Admin: Customer Newsletter*/
    var subscription = $("#txtCSubscription");
    var chkboxSubscription = $('#chkCSubscription');

    if (subscription == 1) {
        chkboxSubscription.attr('checked', true);
    } else {
        chkboxSubscription.attr('checked', false);
    }

    chkboxSubscription.click(function () {
        if (chkboxSubscription.is(":checked")) {
            subscription.val('1');
        } else {
            subscription.val('0');
        }
    });

    /*Enquiry and Reservation Form*/
    var reservationFields = {
        hiddenFields: $('.r-field'),
        firstname: $('#txtFirstname'),
        lastname: $('#txtLastname'),
        contactno: $('#txtContact'),
        email: $('#txtEmail'),
        date: $("#txtRDate"),
        time: $('#txtTime'),
        guest: $('#txtGuest'),
        reason: $('#selReason'),
        subject: $('#txtSubject'),
        message: $('#txtMessages'),
        captchacode: $('#6_letters_code')
    }

    var reservationSubjectText = "Casellas Wine - Tapas - Grill - Online Reservation";
    var enquirySubjectText = "Casellas Wine - Tapas - Grill - Online Enquiry";

    reservationFields.hiddenFields.hide();

    reservationFields.date.datepicker({
        minDate: new Date(),
        dateFormat: 'dd/mm/yy'
    });

    var reservationMenuLink = $('#reservation');
    reservationMenuLink.click(function(){
        var $this = $(this);
        if($this.data('clicked', true)) {
            reservationFields.reason.val('Reservation');

            if (reservationFields.reason.val() == 'Reservation') {
                reservationFields.hiddenFields.show();
                reservationFields.subject.val( reservationSubjectText );
            }
        }
    });

    reservationMenuLink.fancybox({
        'padding': 0,
        'autoScale': false,
        'transitionIn': 'none',
        'transitionOut': 'none',
        'showCloseButton': false,
        'centerOnScroll': true
    });

    reservationFields.reason.change(function () {
        if ($(this).val() == 'Reservation') {
            reservationFields.hiddenFields.show();
            reservationFields.subject.val( reservationSubjectText );

        } else {
            reservationFields.subject.val( enquirySubjectText );
            reservationFields.date.val('');
            reservationFields.time.val('');
            reservationFields.guest.val('');
            reservationFields.hiddenFields.hide();
        }
    });

    var subscribeToNewsletter = $('#chkNewsletter');
    var subscribeVal = $('#txtNewsletter');

    subscribeToNewsletter.click(function () {
        if (subscribeToNewsletter.is(":checked")) {
            subscribeVal.val('1');
        } else {
            subscribeVal.val('0');
        }
    });

    $('#cypherEnquiryForm').submit(function(){
        if (validateField( reservationFields.firstname ) == false) {
            alert( notifMsg+ ' your First name!' );
            reservationFields.firstname.focus();
            return false;
        }

        if (validateField( reservationFields.lastname ) == false) {
            alert( notifMsg+ ' your Last name!' );
            reservationFields.lastname.focus();
            return false;
        }
        
        if (validateField( reservationFields.contactno ) == false) {
            alert( notifMsg+ ' your Contact number!' );
            reservationFields.contactno.focus();
            return false;
        } else {
            var phone = reservationFields.contactno.val();
            var validNumbers = "0123456789-";            
            for (var i = 0; i < phone.length; i++) {
                if (validNumbers.indexOf( phone.charAt(i)) == -1) {
                    alert("Invalid contact number");
                    reservationFields.contactno.focus();
                    return false;
                }
            }            
        }

        if (validateField( reservationFields.email ) == false) {
            alert( notifMsg+ ' your Email address!' );
            reservationFields.email.focus();
            return false;

        } else if (isEmail( reservationFields.email ) == false) {
            alert( invalidEmailMsg );
            reservationFields.email.focus();
            return false;
        }

        if (validateField( reservationFields.subject ) == false) {
            alert( notifMsg+ ' your Subject!' );
            reservationFields.subject.focus();
            return false;
        }

        if (validateField( reservationFields.reason ) == false) {
            alert( notifMsg+ ' your Reason!' );
            reservationFields.reason.focus();
            return false;
        }

        if (reservationFields.reason.val() == 'Reservation') {
            if (validateField( reservationFields.date ) == false) {
                alert( notifMsg+ ' your Reservation date!' );
                reservationFields.date.focus();
                return false;
            }

            if (validateField( reservationFields.time ) == false) {
                alert( notifMsg+ ' your Reservation time!' );
                reservationFields.time.focus();
                return false;
            }

            if (validateField( reservationFields.guest ) == false) {
                alert( notifMsg+ ' your no. of Guest!' );
                reservationFields.guest.focus();
                return false;
            }
        }

        if (validateField( reservationFields.message ) == false) {
            alert( notifMsg+ ' your Message or Enquiry!' );
            reservationFields.message.focus();
            return false;
        }
        
        if (validateField( reservationFields.captchacode ) == false) {
            alert( notifMsg+ ' code below!' );
            reservationFields.captchacode.focus();
            return false;
        }
        
        return true;
    });

    $('#closeEnquiry, #cancelEnquiry').click(function(){
        clearFieldValues();
        $.fancybox.close();
    });
    
    $('.b-enquiry').click(function(){
        $('#selReason').val('General Enquiry');
    }); 

    function clearFieldValues(){
        reservationFields.firstname.val('');
        reservationFields.lastname.val('');
        reservationFields.contactno.val('');
        reservationFields.email.val('');
        reservationFields.reason.val('0');
        reservationFields.date.val('');
        reservationFields.time.val('');
        reservationFields.guest.val('');
        reservationFields.message.val('');
        reservationFields.subject.val( enquirySubjectText );
        reservationFields.hiddenFields.hide();
    }

    /*Unsubscribe Form*/
    var unsubscribeButton = $('#unsubscribeButton');
    unsubscribeButton.click(function() {
        var unsubscribeForm = $('#cypherUnsubscribeForm');
        var unsubscribeFields = {
            email: $('#txtUnsubscribe')
        }

        var subscriberData = {
            email: unsubscribeFields.email.val()
        }

        if ( (subscriberData.email == unsubscribeFields.email.attr('title')) || (validateField(unsubscribeFields.email) == false) ) {
            alert( notifMsg+ " a valid Email address!" );
            unsubscribeFields.email.focus();
            return false;

        } else if (isEmail( unsubscribeFields.email ) == false) {
            alert( invalidEmailMsg );
            unsubscribeFields.email.focus();
            return false;
        }

        postUrlString = "common/f_unsubscribe.php";
        processData ( subscriberData, postUrlString );
        resetForm( unsubscribeForm, true );
    });

    /*VIP Form*/
    var vipHiddenRows = $('.table-row-hidden');
    //var vipRecommendReason = $('#taVipRecommend');
    var vipFields = {
        fname: $('#txtVipFname'),
        lname: $('#txtVipLname'),
        email: $('#txtVipEmail'),
        street: $('#txtVipAddStreet'),
        city: $('#txtVipAddCity'),
        state: $('#txtVipAddState'),
        postal: $('#txtVipAddPostal'),
        mobile: $('#txtVipMobile'),
        landline: $('#txtVipLandline'),
        birthdate: $('#txtVipBirthDate'),
        dine: $('#selVipDined'),
        rate: $('#selVipExpRate'),
        recommend: $('#selVipRecommend'),
        reason: $('#taVipRecommend')
    }

    vipHiddenRows.hide();
    vipFields.reason.hide();
    
    vipFields.recommend.change(function(){
        if ($(this).val() == 'No') {
            vipFields.reason.show();
            
        } else {
            vipFields.reason.hide();
        }
    });

    vipFields.birthdate.datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'
    });

    var textLabelFields = '#cypherVIPForm input[type="text"], #cypherVIPForm textarea, #cypherUnsubscribeForm input[type="text"]';
    $(textLabelFields).each(function(){
        this.value = $(this).attr('title');
        $(this).addClass('text-label');

        $(this).focus(function(){
            if(this.value == $(this).attr('title')) {
                this.value = '';
                $(this).removeClass('text-label');
            }
        });

        $(this).blur(function(){
            if(this.value == '') {
                this.value = $(this).attr('title');
                $(this).addClass('text-label');
            }
        });
    });

    vipFields.dine.change(function() {
        if (vipFields.dine.val() == 'Yes') {
            vipHiddenRows.show();
        } else {
            vipHiddenRows.hide();
        };
    });

    var vipSubmitButton = $('#cypherVIPSubmit');
    vipSubmitButton.click(function() {
        var vipForm = $('#cypherVIPForm');

        var datastr = {
            fname: vipFields.fname.val(),
            lname: vipFields.lname.val(),
            email: vipFields.email.val(),
            street: vipFields.street.val(),
            city: vipFields.city.val(),
            state: vipFields.state.val(),
            postal: vipFields.postal.val(),
            mobile: vipFields.mobile.val(),
            landline: vipFields.landline.val(),
            bday: vipFields.birthdate.val(),
            dine: vipFields.dine.val(),
            rate: vipFields.rate.val(),
            recommend: vipFields.recommend.val(),
            reason: vipFields.reason.val(),
            captcha: $('#6_letters_code').val()
        }

        if ( (datastr.fname == vipFields.fname.attr('title')) || (validateField(vipFields.fname) == false) ) {
            alert( notifMsg+ " a valid First name!" );
            vipFields.fname.focus();
            return false;
        }

        if ( (datastr.lname == vipFields.lname.attr('title')) || (validateField(vipFields.lname) == false) ) {
            alert( notifMsg+ " a valid Last name!" );
            vipFields.lname.focus();
            return false;
        }

        if ( (datastr.email == vipFields.email.attr('title')) || (validateField(vipFields.email) == false) ) {
            alert( notifMsg+ " a valid Email address!" );
            vipFields.email.focus();
            return false;

        } else if (isEmail( vipFields.email ) == false) {
            alert( invalidEmailMsg );
            vipFields.email.focus();
            return false;
        }

        if ( (datastr.street == vipFields.street.attr('title')) || (validateField(vipFields.street) == false) ) {
            alert( notifMsg+ " a value for Street!" );
            vipFields.street.focus();
            return false;
        }

        if ( (datastr.city == vipFields.city.attr('title')) || (validateField(vipFields.city) == false) ) {
            alert( notifMsg+ " a value for City!" );
            vipFields.city.focus();
            return false;
        }

        if ( (datastr.state == vipFields.street.attr('title')) || (validateField(vipFields.state) == false) ) {
            alert( notifMsg+ " a value for State!" );
            vipFields.state.focus();
            return false;
        }

        if ( (datastr.state == vipFields.postal.attr('title')) || (validateField(vipFields.postal) == false) ) {
            alert( notifMsg+ " a value for Post code" );
            vipFields.postal.focus();
            return false;
        }
        
        if ( (datastr.bday == vipFields.birthdate.attr('title')) || (validateField(vipFields.birthdate) == false) ) {
            alert( notifMsg+ " a value for Date of Birth!" );
            vipFields.birthdate.focus();
            return false;
        }

        if ( (validateField(vipFields.dine) == false) ) {
            alert( notifMsg+ " a value for the Question!" );
            vipFields.rate.focus();
            return false;
        }

        if (vipFields.dine.val() == 'Yes') {
            if ( (validateField(vipFields.rate) == false) ) {
                alert( notifMsg+ " a value for Restaurant experience rate!" );
                vipFields.rate.focus();
                return false;
            }

            if ( (validateField(vipFields.recommend) == false) ) {
                alert( notifMsg+ " a value for Recommendation!" );
                vipFields.recommend.focus();
                return false;
            }
        }
        
//        if ( ($('#6_letters_code').attr('title')) || (validateField($('#6_letters_code').va()) == false) ) {
//            alert( notifMsg+ " the captcha code below" );
//            $('#6_letters_code').focus();
//            return false;
//        }

        if ( $('#6_letters_code').attr('title') == $('#6_letters_code').val() || $('#6_letters_code').val() == "") {
            alert( notifMsg+ " the captcha code below" );
            $('#6_letters_code').focus();
            return false;
        } 

        postUrlString = "common/f_vip.php";
        processData( datastr, postUrlString );
        resetForm( vipForm, true );
    });

});

//post data via ajax with fancybox notification
function processData  ( dataCollection, urlString ) {
    fancyBoxPreloader();
    //send enquiry via ajax
    $.ajax({
        type: "POST",
        url: urlString,
        data: dataCollection
    }).done(function( result ) {
        $("#result-container").html( result );
        fancyBoxAlert();
    });
}

//reset form by setting labels in fields
function resetForm( formId, labeled ) {
    var fieldTypes = {
        'inputTag': 'input',
        'selectTag': 'select',
        'textareaTag': 'textarea'
    }

    $.each( fieldTypes, function( key, value ) {
        var fieldTag = value;
        if (fieldTag == 'input') {
            formId.find(fieldTag).each(function(){
                if (!labeled) {
                    $(this).val('');
                } else {
                    $(this).val($(this).attr('title'));
                }
            });
        } else if (fieldTag == 'select') {
            formId.find(fieldTag).each(function(){
                $(this).val('0');
            });
        } else if (fieldTag == 'textarea') {
            formId.find(fieldTag).each(function(){
                $(this).val('');
            });
        }
    });
}

//fancybox with preloader image
function fancyBoxPreloader () {
    var loaderImage = "<div class='preloader-box'><img id='preloader-img' src='images/loading3.gif'/></div>";
    $('.preloader').append(loaderImage);

    var content = $('.preloader').html();
    var fancyboxNoSkin = {
        'background-color': 'transparent',
        'background-image': 'none',
        'border': '0px',
        'width': '110px'
    }
    var fancyboxPoints = $('#fancybox-bg-n, #fancybox-bg-ne, #fancybox-bg-e, #fancybox-bg-se, #fancybox-bg-s, #fancybox-bg-sw, #fancybox-bg-w, #fancybox-bg-nw');
    var noShadow = {
        'background-image': 'none'
    }

    $.fancybox(content, {
        'titlePosition' : 'inside',
        'transitionIn' :  'none',
        'transitionOut' : 'none',
        'showCloseButton': false,
        'hideOnOverlayClick': false,
        'enableEscapeButton': false,
        'centerOnScroll': true,
        'overlayColor': '#fafafa',
        'onComplete': function() {
            $('#fancybox-outer, #fancybox-content').css(fancyboxNoSkin);
            fancyboxPoints.css(noShadow);
        }
    });
}

//fancybox alert notification
function fancyBoxAlert () {
    var content = $('.result').html();
    var fancyboxWithSkin = {
        'background-color': '#fff',
        'border': 'none',
        'width': '268px'
    }

    $.fancybox(content, {
        'titlePosition' : 'inside',
        'transitionIn' :  'none',
        'transitionOut' : 'none',
        'autoScale': true,
        'hideOnOverlayClick': false,
        'enableEscapeButton': false,
        'changeSpeed': 10,
        'centerOnScroll': true,
        'overlayColor': '#fafafa',
        'onComplete': function() {
            $('#fancybox-outer, #fancybox-content').css(fancyboxWithSkin);
        }
    });

    $('.preloader-box').remove();
}

//null field validation method
function validateField ( fieldId ) {
    var f = fieldId.val();

    if (f == '' || f == null || f == '0') {
        return false;
    } else {
        return true;
    }
}

//email validation method
function isEmail (email) {
    var x = email.val();
    var at_pos = x.indexOf("@");
    var dot_pos = x.lastIndexOf(".");

    if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
        return false;
    } else {
        return true;
    }
}

//telephone no., postal code validation method
function requiredItemCode ( minLength, maxLength, fieldId ) {
    fieldId = fieldId.val();
    var result = {
        bool: false,
        minchar: minLength,
        maxchar: maxLength
    }

    if (fieldId.length < minLength) {
        return result;
    } else if (fieldId.length > maxLength) {
        return result;
    } else {
        return true;
    }
}

//display copyright date method
function footerDate ( year ) {
    var d = new Date();
    var yc = year;
    var cy = d.getFullYear();
    var csymbol = "\u00A9 ";

    if (yc != cy) {
        return csymbol + yc + " - " +  cy;
    } else {
        return csymbol + yc + " - " +  cy;
    }
}