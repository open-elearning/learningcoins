
function addLearningCoins(k,v,lk,obj){

    lk = lk.split('@').join('/');
    var audioLk = lk;
    audioLk = audioLk.replace('.php','.mp3')
    var audioObj = new Audio(audioLk);

    lk = lk + '?k=' + k + '&v=' + v;
    //alert(lk);
    
    obj.style.display = 'none';

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
           if (xmlhttp.status == 200){
              result = xmlhttp.responseText;
              if(result!=''){
                
                audioObj.play();
              }

           }
           else if (xmlhttp.status == 400){
              alert('There was an error 400');
           }
           else {
               alert('something else other than 200 was returned');
           }
        }
    };

    xmlhttp.open("GET",lk, true);
    xmlhttp.send();
    
}
