let mess = document.querySelector('#mess');
if(mess){
    setTimeout(function() {
        mess.remove();
    }, 2000);
}

var element = document.querySelector('.my-pag p.text-sm.text-gray-700.leading-5');
if(element){
    element.remove();
}

var navigation = document.querySelector('.my-pag div.flex.justify-between.flex-1');
if(navigation){
    navigation.style.marginBottom = '20px';
}

