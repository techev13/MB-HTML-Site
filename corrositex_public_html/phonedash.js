var tele = document.getElementById('phone');

/* original function
tele.addEventListener('keyup', function(e){
  if (tele.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)){
  tele.value += '-';
  }
});   */

tele.addEventListener('keyup', entry); 

function entry(e){
    if (tele.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)){
    tele.value += '-';
    } 
};


