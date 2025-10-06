(function () {
    'use strict';

    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl);
    });
  
    var forms = document.querySelectorAll('.form-validation');
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false);
    });

    $("[name=username], [name=referral]").off().on("keyup", function () {
		if (this.value.match(/[^a-zA-Z0-9 ]/g))
			this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, "");
	});
})();

// $(document).keydown(function(e){ 
//     if(e.which === 123){ 
//        return false; 
//     } 
// });

// $(document).bind("contextmenu",function(e) {
// 	e.preventDefault();
// });

// var _z = console;
// Object.defineProperty( window, "console", {
//     get : function(){
//         if( _z._commandLineAPI ){
//         throw "Sorry, Can't execute scripts!";
//             }
//         return _z; 
//     },
//     set : function(val){
//         _z = val;
//     }
// });

// window.console.log = function() {
//     console.error('Sorry , developers tools are blocked here....');
//     window.console.log = function() {
//         return false;
//     }
// }

const rmCheck = document.getElementById("rememberMe"),
usernameInput = document.getElementById("username");

if (localStorage.checkbox && localStorage.checkbox !== "") {
    rmCheck.setAttribute("checked", "checked");
    usernameInput.value = localStorage.username;
} else {
    rmCheck.removeAttribute("checked");
    usernameInput.value = "";
}

function isRememberMe()
{
    if (rmCheck.checked && usernameInput.value !== "") {
        localStorage.username = usernameInput.value;
        localStorage.checkbox = rmCheck.value;
    } else {
        localStorage.username = "";
        localStorage.checkbox = "";
    }
}

function isJson(str)
{
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function refreshBalance()
{
    $.ajax({
        method: 'GET',
        url: '/user/balance',
        success: function (data,status,xhr) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                var userCreated = document.getElementsByClassName("userCreated");
                if( !!userCreated ) {
                    $('.userCreated').html(obj.userCreated);
                }

                var fullName = document.getElementsByClassName("userFullName");
                if( !!fullName ) {
                    $('.userFullName').html(obj.fullName);
                }
                var accFullName = document.getElementsByName("holder");
                if( !!accFullName ) {
                    $('[name=holder]').val(obj.fullName);
                }

                $('.userBalance').html(parseFloat(obj.balance).toFixed(2));

                var userBalance = document.getElementsByName("userBalance");
                if( !!userBalance ) {
                    $('[name=userBalance]').val(obj.balance);
                }

                var vault = document.getElementsByClassName("vaultBalance");
                if( !!vault ) {
                    $('.vaultBalance').html(obj.vault);
                }

                var cash = document.getElementsByClassName("userCash");
                if( !!cash ) {
                    $('.userCash').html(parseFloat(obj.cash).toFixed(2));
                }

                var chip = document.getElementsByClassName("userChip");
                if( !!chip ) {
                    $('.userChip').html(parseFloat(obj.chip).toFixed(2));
                }

                var cashLotto = document.getElementsByClassName("maxLottoBonus");
                if( !!cashLotto ) {
                    $('.maxLottoBonus').html(obj.lotto);
                }

                var fortuneToken = document.getElementsByClassName("userFortuneToken");
                if( !!fortuneToken ) {
                    $('.userFortuneToken').html(obj.fortuneToken);
                    if( obj.fortuneToken<=0 ) {
                        if( !!document.getElementById("btn-spin") ) {
                            document.getElementById("btn-spin").disabled = true;
                            document.getElementById("btn-spin").removeAttribute("onclick");
                        }
                    }
                }

                if( obj.jackpot==true ) {
                    runningJackpot();
                }
            } else if( obj.code==39 ) {
                forceUserLogout();
            } else {
                
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { location.reload(); });
        },
        beforeSend: function(xhr) {
            $('.userBalance').html('---');
            $('.vaultBalance').html('---');
            $('.userCash').html('---');
            $('.userChip').html('---');
            $('.userFortuneToken').html('0');
        }
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { location.reload(); });
    })
    .done(function(msg) {});
}

function affiliateProfile()
{
    $.get('/affiliate-downline', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 && obj.count!='' ) {
            // const downline = obj.count.filter(item=>item.level>1).length;
            // let totaldownline = 0;
            // for (var i=1; i<=downline; i++) {
            //     totaldownline += obj.count[i+1].countByLevel;
            // }

            // const direct = obj.count.filter(item=>item.level==1).length;
            // let totalDirect = 0;
            // if( direct>1 ) {
            //     for (var d=1; d<=direct; d++) {
            //         totalDirect += obj.count[d+1].countByLevel;
            //     }
            // } else {
            //     totalDirect = 0;
            // }

            // $('.affiliateDirect').html(obj.count[1].countByLevel);
            // $('.affiliateDirect').html(totalDirect);
            // $('.affiliateDownline').html(totaldownline);

            const downline = obj.count.filter(item=>item.level>=1).length;
            let totaldownline = 0;
            for (var i=1; i<=downline; i++) {
                totaldownline += obj.count[i].countByLevel;
            }

            $('.affiliateDirect').html(obj.count[0].countByLevel);
            $('.affiliateDownline').html(totaldownline);
        } else if( obj.code==1 && obj.count=='' ) { 
            $('.affiliateDirect').html('0');
            $('.affiliateDownline').html('0');
        } else {
            // swal.fire("Error!", obj.message + " (Code: "+ obj.code +")", "error").then(() => {  });
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {  });
    });
}

function forceUserLogout()
{
    swal.fire({
        title: 'Your account has logged in other device...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

    $.get('/user/logout', function(data, status) {
        location.reload();
    })
    .done(function(msg) { swal.close(); });
}

function translation(vlang)
{
    const lang = vlang ? vlang : $(".select-lang").children("option:selected").val();

	$.get("/translate/" + lang, function (data, status) {
		const obj = JSON.parse(data);
		obj.code==1 ? location.reload() : '';
	});
}

function showhidepass(el)
{
    const input = document.getElementById(el);
    if (input.type === "password") {
        input.type = "text";
        document.getElementsByClassName('btn-showpass')[0].innerHTML = '<i class="bx bx-show"></i>';
    } else {
        input.type = "password";
        document.getElementsByClassName('btn-showpass')[0].innerHTML = '<i class="bx bx-hide"></i>';
    }
}

function alertToast(option, msg)
{
    var toast = document.getElementById('liveToast');
    toast.classList.remove('bg-primary');
    toast.classList.add(option);
    toast.getElementsByClassName('toast-body')[0].innerHTML = msg;
    var popToast = new bootstrap.Toast(toast);
    popToast.show();
}