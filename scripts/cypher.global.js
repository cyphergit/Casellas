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

$(function () {    
    var title = 'Casellas Wine - Tapas - Grill';    
    var copyrightYear = footerDate( '2012' ); //started 2012;
    var logoUrl = $('#Logo').find('a');
    var postUrlString;

    logoUrl.attr({ href: sitehost, title: title });

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
    var adminCustomerNewsletter = function () {
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
    };
    adminCustomerNewsletter();

    //Enquiry and Reservation Form
    var loadEnquiryAndReservation = function() {
        var reservationFields = {
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
            subscription: $('#txtNewsletter')
        };
        
        var clearFieldValues = function() {
            reservationFields.firstname.val('');
            reservationFields.lastname.val('');
            reservationFields.contactno.val('');
            reservationFields.email.val('');
            reservationFields.date.val('');
            reservationFields.time.val('');
            reservationFields.guest.val('');
            reservationFields.message.val('');
        };
        clearFieldValues();    
        
        var enquirySubmitButton = $('#submitEnquiry');
        enquirySubmitButton.click(function() {
            var enquiryForm = $('#cypherEnquiryForm');

            var enquiryData = {
                firstname: reservationFields.firstname.val(),
                lastname: reservationFields.lastname.val(),
                contactno: reservationFields.contactno.val(),
                email: reservationFields.email.val(),
                date: reservationFields.date.val(),
                time: reservationFields.time.val(),
                guest: reservationFields.guest.val(),
                reason: reservationFields.reason.val(),
                subject: reservationFields.subject.val(),
                message: reservationFields.message.val(),
                subscription: reservationFields.subscription.val()
            };

            if ((enquiryData.firstname == reservationFields.firstname.attr('title')) || (validateField(reservationFields.firstname) == false) ) {
                alert( notifMsg+ ' your First name!' );
                reservationFields.firstname.focus();
                return false;
            }

            if ((enquiryData.lastname == reservationFields.lastname.attr('title')) || (validateField(reservationFields.lastname) == false) ) {
                alert( notifMsg+ ' your Last name!' );
                reservationFields.lastname.focus();
                return false;
            }

            if ((enquiryData.contactno == reservationFields.contactno.attr('title')) || (validateField(reservationFields.contactno) == false) ) {
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

            if ((enquiryData.email == reservationFields.email.attr('title')) || (validateField(reservationFields.email) == false) ) {
                alert( notifMsg+ ' your Email address!' );
                reservationFields.email.focus();
                return false;

            } else if (isEmail( reservationFields.email ) === false) {
                alert( invalidEmailMsg );
                reservationFields.email.focus();
                return false;
            }

            if ((enquiryData.subject == reservationFields.subject.attr('title')) || (validateField(reservationFields.subject) == false) ) {
                alert( notifMsg+ ' your Subject!' );
                reservationFields.subject.focus();
                return false;
            }

            if ((enquiryData.reason == reservationFields.reason.attr('title')) || (validateField(reservationFields.reason) == false) ) {
                alert( notifMsg+ ' your Reason!' );
                reservationFields.reason.focus();
                return false;
            }

            if (reservationFields.reason.val() == 'Reservation') {
                if ((enquiryData.date == reservationFields.date.attr('title')) || (validateField(reservationFields.date) == false) ) {
                    alert( notifMsg+ ' your Reservation date!' );
                    reservationFields.date.focus();
                    return false;
                }

                if ((enquiryData.time == reservationFields.time.attr('title')) || (validateField(reservationFields.time) == false) ) {
                    alert( notifMsg+ ' your Reservation time!' );
                    reservationFields.time.focus();
                    return false;
                }

                if ((enquiryData.guest == reservationFields.guest.attr('title')) || (validateField(reservationFields.guest) == false) ) {
                    alert( notifMsg+ ' your no. of Guest!' );
                    reservationFields.guest.focus();
                    return false;
                }
            }

            if (validateField( reservationFields.message ) === false) {
                alert( notifMsg+ ' your Message or Enquiry!' );
                reservationFields.message.focus();
                return false;
            }
            
            var captcha_response = grecaptcha.getResponse();
            if (captcha_response.length == 0)
            {                
                alert("Recaptcha validation error, please try it again!");
                return false; // Captcha is not Passed
            }      

            postUrlString = "common/f_sendenquiry.php";
            processData( enquiryData, postUrlString );
            resetForm( enquiryForm, true );
        });        
    };
    loadEnquiryAndReservation();
    
    var newsletterSubscription = function () {
        var subscribeToNewsletter = $('#chkNewsletter');
        var subscribeVal = $('#txtNewsletter');

        subscribeToNewsletter.click(function () {
            if (subscribeToNewsletter.is(":checked")) {
                subscribeVal.val('1');
            } else {
                subscribeVal.val('0');
            }
        });
    };
    newsletterSubscription();

    //Unsubscribe Form
    var loadUnsubscribe = function() {
        var unsubscribeButton = $('#unsubscribeButton');
        unsubscribeButton.click(function() {
            var unsubscribeForm = $('#cypherUnsubscribeForm');
            var unsubscribeFields = { email: $('#txtUnsubscribe') };
            var subscriberData = { email: unsubscribeFields.email.val() };

            if ( (subscriberData.email == unsubscribeFields.email.attr('title')) || (validateField(unsubscribeFields.email) == false) ) {
                alert( notifMsg+ " a valid Email address!" );
                unsubscribeFields.email.focus();
                return false;

            } else if (isEmail( unsubscribeFields.email ) === false) {
                alert( invalidEmailMsg );
                unsubscribeFields.email.focus();
                return false;
            }

            postUrlString = "common/f_unsubscribe.php";
            processData ( subscriberData, postUrlString );
            resetForm( unsubscribeForm, true );
        });
    };
    loadUnsubscribe();
    
    //VIP Form
    var loadVip = function() {        
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
        };

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
                reason: vipFields.reason.val()
            };

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

            } else if (isEmail( vipFields.email ) === false) {
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

            if ( (datastr.postal == vipFields.postal.attr('title')) || (validateField(vipFields.postal) == false) ) {
                alert( notifMsg+ " a value for Post code" );
                vipFields.postal.focus();
                return false;
            }

            if ( (datastr.bday == vipFields.birthdate.attr('title')) || (validateField(vipFields.birthdate) == false) ) {
                alert( notifMsg+ " a value for Date of Birth!" );
                vipFields.birthdate.focus();
                return false;
            }

            if ( (validateField(vipFields.dine) === false) ) {
                alert( notifMsg+ " a value for the Question!" );
                vipFields.rate.focus();
                return false;
            }

            if (vipFields.dine.val() == 'Yes') {
                if ( (validateField(vipFields.rate) === false) ) {
                    alert( notifMsg+ " a value for Restaurant experience rate!" );
                    vipFields.rate.focus();
                    return false;
                }

                if ( (validateField(vipFields.recommend) === false) ) {
                    alert( notifMsg+ " a value for Recommendation!" );
                    vipFields.recommend.focus();
                    return false;
                }
            }
            
            var captcha_response = grecaptcha.getResponse();
            if (captcha_response.length == 0)
            {                
                alert("Recaptcha validation error, please try it again!");
                return false; // Captcha is not Passed
            }                 

            postUrlString = "common/f_vip.php";
            processData( datastr, postUrlString );
            resetForm( vipForm, true );
        });
    };
    loadVip();
    
    var initiateFieldLabels = function() {
        var textLabelFields = '#cypherVIPForm input[type="text"], #cypherVIPForm textarea, \n\
            #cypherUnsubscribeForm input[type="text"], #cypherEnquiryForm input[type="text"], \n\
            #cypherEnquiryForm textarea';
        
        $(textLabelFields).each(function(){
            if ($(this).attr('id') != 'txtSubject' && $(this).attr('id') != 'selReason') {
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
            }
        }); 
    };
    initiateFieldLabels();   
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
        //alert(result);
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
    };

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
    };
    
    var fancyboxPoints = $('#fancybox-bg-n, #fancybox-bg-ne, #fancybox-bg-e, #fancybox-bg-se, #fancybox-bg-s, #fancybox-bg-sw, #fancybox-bg-w, #fancybox-bg-nw');
    var noShadow = { 'background-image': 'none' };

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
    var content = $('.result-notif').html();

    $.fancybox(content, {
        'padding': 0,
        'afterClose': function() {
            var currentUrl = window.location.href;
            window.location = currentUrl;
        },
        'autoCenter': true,
        'hideOnOverlayClick': false,
        'enableEscapeButton': false,
        'changeSpeed': 10,
        'centerOnScroll': true,
        'overlayColor': '#fafafa'
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
    };

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
        return csymbol + yc;
    }
}