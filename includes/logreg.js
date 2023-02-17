$('.log').hide(0);   
$(document).ready(function () {




    $('#switchreg span').on('click', function () {
        $('.log').hide(250);
        $('.reg').show(0);
    });
    $('#switchlog span').on('click', function () {
        $('.reg').hide(250);
        $('.log').show(0);
    });
    $('#togglePassword1').on('click', function () {
        console.log('clicked')
        let input = $('#pass1');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
    $('#togglePassword2').on('click', function () {
        console.log('clicked')
        let input = $('#pass2');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
    $('#togglePassword3').on('click', function () {
        console.log('clicked')
        let input = $('#pass3');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
});
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }


let msg=getCookie('msg');
console.log(msg);
let animation="animation: fadeOutAnimation ease 5s;animation-iteration-count: 1;animation-fill-mode: forwards;";
let messageBox=document.getElementById('messages');



switch (msg) {
    case "Invalid+username+or+password":
        let element=document.getElementById('pass1');
        element.setAttribute('style',animation);
        messageBox.innerHTML="Invalid username or password";
        setCookie("msg","",-1);
        setInterval(function(){
            let animation="animation:";
            element.setAttribute('style',animation);
            messageBox.innerHTML="";
        }, 5000);
        break;
    case "Passwords do not match":
        document.getElementsByClassName('log')[0].style.display="initial";
        document.getElementsByClassName('reg')[0].style.display="none";
        let element3=document.getElementById('pass2');
        element3.setAttribute('style',animation);
        messageBox.innerHTML="Passwords do not match";
        setCookie("msg","",-1);
        setInterval(function(){
            let animation="animation:";
            element3.setAttribute('style',animation);
            messageBox.innerHTML="";
        }, 5000);
        break;
    case "Username already exists":
        document.getElementsByClassName('log')[0].style.display="initial";
        document.getElementsByClassName('reg')[0].style.display="none";
        let element5=document.getElementById('username2');
        element5.setAttribute('style',animation);
        messageBox.innerHTML="Username already exists";
        setCookie("msg","",-1);
        setInterval(function(){
            let animation="animation:";
            element5.setAttribute('style',animation);
            messageBox.innerHTML="";
        }, 5000);
        
    default:
        break;
}
